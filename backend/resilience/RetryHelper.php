<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Resiliencia: Patrón Retry con Exponential Backoff y Full Jitter
 * Previene el efecto de manada (Thundering Herd) y maneja fallos transitorios en red y base de datos.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class RetryHelper {
    /**
     * Ejecuta una operación con reintentos basados en Exponential Backoff y Full Jitter
     *
     * @param callable $operation Operación que puede fallar transitoriamente
     * @param int $maxRetries Número máximo de reintentos (ej: 3)
     * @param int $baseDelayMs Retardo base en milisegundos (ej: 100ms)
     * @param int $maxDelayMs Retardo máximo en milisegundos (ej: 2000ms)
     * @param callable|null $retryIf Función que evalúa si la excepción es reintentable (bool)
     * @return mixed
     * @throws \Throwable
     */
    public static function retry(
        callable $operation,
        int $maxRetries = 3,
        int $baseDelayMs = 100,
        int $maxDelayMs = 2000,
        ?callable $retryIf = null
    ) {
        $attempts = 0;

        while (true) {
            $attempts++;
            try {
                return $operation($attempts);
            } catch (\Throwable $e) {
                if ($attempts > $maxRetries) {
                    throw $e;
                }

                if ($retryIf !== null && !$retryIf($e)) {
                    // La excepción fue identificada como no recuperable (ej: error de sintaxis o autenticación fallida)
                    throw $e;
                }

                // Cálculo de Exponential Backoff: base * 2^(attempts-1)
                $exponential = $baseDelayMs * (2 ** ($attempts - 1));
                $cappedDelay = min($maxDelayMs, $exponential);

                // Aplicar Full Jitter: retardo aleatorio entre 0 y cappedDelay
                $jitterDelayMs = random_int(0, (int)$cappedDelay);

                // Esperar en microsegundos
                usleep($jitterDelayMs * 1000);
            }
        }
    }
}

