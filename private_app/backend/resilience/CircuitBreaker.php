<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Resiliencia: Patrón Circuit Breaker
 * Estados: CLOSED (Operación normal), OPEN (Circuito abierto/bloqueo), HALF-OPEN (Prueba de recuperación)
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class CircuitBreakerException extends \RuntimeException {}

class CircuitBreaker {
    public const STATE_CLOSED = 'CLOSED';
    public const STATE_OPEN = 'OPEN';
    public const STATE_HALF_OPEN = 'HALF_OPEN';

    private string $serviceName;
    private int $failureThreshold;
    private int $recoveryTimeoutSeconds;
    private int $halfOpenSuccessThreshold;
    private string $storageFile;

    /**
     * @param string $serviceName Nombre del servicio protegido (ej: 'database', 'smtp', 'api_ext')
     * @param int $failureThreshold Fallos consecutivos para abrir el circuito (ej: 5)
     * @param int $recoveryTimeoutSeconds Tiempo en segundos antes de intentar HALF_OPEN (ej: 30)
     * @param int $halfOpenSuccessThreshold Éxitos requeridos en HALF_OPEN para cerrar el circuito (ej: 2)
     */
    public function __construct(
        string $serviceName,
        int $failureThreshold = 5,
        int $recoveryTimeoutSeconds = 30,
        int $halfOpenSuccessThreshold = 2
    ) {
        $this->serviceName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $serviceName);
        $this->failureThreshold = max(1, $failureThreshold);
        $this->recoveryTimeoutSeconds = max(1, $recoveryTimeoutSeconds);
        $this->halfOpenSuccessThreshold = max(1, $halfOpenSuccessThreshold);

        $storageDir = __DIR__ . '/../storage/circuit_breaker';
        if (!is_dir($storageDir)) {
            @mkdir($storageDir, 0755, true);
        }
        $this->storageFile = $storageDir . '/' . $this->serviceName . '.json';
    }

    /**
     * Carga el estado actual del circuito
     */
    public function getState(): array {
        if (!file_exists($this->storageFile)) {
            return [
                'state' => self::STATE_CLOSED,
                'failure_count' => 0,
                'success_count' => 0,
                'last_failure_time' => 0,
                'opened_at' => 0,
            ];
        }

        $content = @file_get_contents($this->storageFile);
        if (!$content) {
            return [
                'state' => self::STATE_CLOSED,
                'failure_count' => 0,
                'success_count' => 0,
                'last_failure_time' => 0,
                'opened_at' => 0,
            ];
        }

        $data = json_decode($content, true);
        if (!is_array($data)) {
            return [
                'state' => self::STATE_CLOSED,
                'failure_count' => 0,
                'success_count' => 0,
                'last_failure_time' => 0,
                'opened_at' => 0,
            ];
        }

        // Evaluar transición de OPEN a HALF_OPEN por expiración de tiempo
        $now = time();
        if ($data['state'] === self::STATE_OPEN) {
            $elapsed = $now - ($data['opened_at'] ?? 0);
            if ($elapsed >= $this->recoveryTimeoutSeconds) {
                $data['state'] = self::STATE_HALF_OPEN;
                $data['success_count'] = 0;
                $this->saveState($data);
            }
        }

        return $data;
    }

    /**
     * Guarda el estado del circuito de forma atómica
     */
    private function saveState(array $data): void {
        $encoded = json_encode($data, JSON_PRETTY_PRINT);
        @file_put_contents($this->storageFile, $encoded, LOCK_EX);
    }

    /**
     * Ejecuta una acción dentro de la protección del Circuit Breaker
     *
     * @param callable $action Operación principal
     * @param callable|null $fallback Función alternativa si el circuito está OPEN o falla
     * @return mixed
     */
    public function execute(callable $action, ?callable $fallback = null) {
        $stateData = $this->getState();
        $currentState = $stateData['state'];

        if ($currentState === self::STATE_OPEN) {
            if ($fallback !== null) {
                return $fallback(new CircuitBreakerException("Circuit breaker is OPEN for {$this->serviceName}"));
            }
            throw new CircuitBreakerException("El servicio '{$this->serviceName}' está temporalmente inaccesible para proteger la estabilidad del sistema (Circuit Breaker OPEN).");
        }

        try {
            $result = $action();
            $this->recordSuccess($stateData);
            return $result;
        } catch (\Throwable $e) {
            $this->recordFailure($stateData, $e);
            if ($fallback !== null) {
                return $fallback($e);
            }
            throw $e;
        }
    }

    /**
     * Registra un éxito en la llamada
     */
    private function recordSuccess(array $stateData): void {
        if ($stateData['state'] === self::STATE_HALF_OPEN) {
            $stateData['success_count'] = ($stateData['success_count'] ?? 0) + 1;
            if ($stateData['success_count'] >= $this->halfOpenSuccessThreshold) {
                // Recuperación confirmada: Volver a CLOSED
                $stateData['state'] = self::STATE_CLOSED;
                $stateData['failure_count'] = 0;
                $stateData['success_count'] = 0;
                $stateData['opened_at'] = 0;
            }
            $this->saveState($stateData);
        } elseif ($stateData['state'] === self::STATE_CLOSED && $stateData['failure_count'] > 0) {
            // Limpiar fallos intermitentes tras llamada exitosa
            $stateData['failure_count'] = 0;
            $this->saveState($stateData);
        }
    }

    /**
     * Registra un fallo en la llamada
     */
    private function recordFailure(array $stateData, \Throwable $e): void {
        $now = time();
        $stateData['last_failure_time'] = $now;

        if ($stateData['state'] === self::STATE_HALF_OPEN) {
            // Falló en prueba de recuperación: Volver a abrir inmediatamente
            $stateData['state'] = self::STATE_OPEN;
            $stateData['opened_at'] = $now;
            $stateData['success_count'] = 0;
        } else {
            $stateData['failure_count'] = ($stateData['failure_count'] ?? 0) + 1;
            if ($stateData['failure_count'] >= $this->failureThreshold) {
                $stateData['state'] = self::STATE_OPEN;
                $stateData['opened_at'] = $now;
            }
        }

        $this->saveState($stateData);
    }

    /**
     * Restablece manualmente el circuito a estado CLOSED
     */
    public function reset(): void {
        $this->saveState([
            'state' => self::STATE_CLOSED,
            'failure_count' => 0,
            'success_count' => 0,
            'last_failure_time' => 0,
            'opened_at' => 0,
        ]);
    }
}

