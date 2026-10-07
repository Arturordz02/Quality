<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Resiliencia: Rate Limiter con Algoritmo Sliding Window
 * Protección contra ataques DoS, fuerza bruta y abusos de API.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class RateLimiter {
    private string $storageDir;

    public function __construct(?string $storageDir = null) {
        $this->storageDir = $storageDir ?: __DIR__ . '/../storage/rate_limits';
        if (!is_dir($this->storageDir)) {
            @mkdir($this->storageDir, 0755, true);
        }
    }

    /**
     * Verifica y aplica el límite de peticiones para una clave (IP o identificador de cliente)
     *
     * @param string $key Identificador único (ej: IP del cliente o hash de usuario)
     * @param int $maxRequests Número máximo de peticiones permitidas en la ventana
     * @param int $windowSeconds Duración de la ventana en segundos (ej: 60)
     * @param bool $autoSendHeaders Si es true, envía los encabezados X-RateLimit-* automáticamente
     * @return array [allowed => bool, limit => int, remaining => int, reset => int]
     */
    public function check(string $key, int $maxRequests = 60, int $windowSeconds = 60, bool $autoSendHeaders = true): array {
        $hashKey = hash('sha256', $key);
        $filePath = $this->storageDir . '/' . $hashKey . '.json';
        $now = time();
        $cutoff = $now - $windowSeconds;

        $fp = @fopen($filePath, 'c+');
        if (!$fp) {
            // Si el archivo no se puede abrir, permitir el tráfico por resiliencia
            return [
                'allowed' => true,
                'limit' => $maxRequests,
                'remaining' => $maxRequests - 1,
                'reset' => $now + $windowSeconds,
            ];
        }

        flock($fp, LOCK_EX);
        rewind($fp);
        $content = stream_get_contents($fp);
        $timestamps = [];
        if (!empty($content)) {
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                $timestamps = $decoded;
            }
        }

        // Filtrar marcas de tiempo fuera de la ventana deslizante
        $validTimestamps = array_values(array_filter($timestamps, function ($ts) use ($cutoff) {
            return $ts > $cutoff;
        }));

        $currentCount = count($validTimestamps);
        $allowed = $currentCount < $maxRequests;

        if ($allowed) {
            $validTimestamps[] = $now;
            $currentCount++;
        }

        // Escribir de vuelta
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($validTimestamps));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        $remaining = max(0, $maxRequests - $currentCount);
        $oldest = !empty($validTimestamps) ? min($validTimestamps) : $now;
        $resetTime = $oldest + $windowSeconds;
        $retryAfter = max(1, $resetTime - $now);

        if ($autoSendHeaders && !headers_sent()) {
            header("X-RateLimit-Limit: {$maxRequests}");
            header("X-RateLimit-Remaining: {$remaining}");
            header("X-RateLimit-Reset: {$resetTime}");

            if (!$allowed) {
                header("Retry-After: {$retryAfter}");
            }
        }

        return [
            'allowed' => $allowed,
            'limit' => $maxRequests,
            'remaining' => $remaining,
            'reset' => $resetTime,
            'retry_after' => $retryAfter,
        ];
    }

    /**
     * Valida la petición y detiene la ejecución con HTTP 429 si se excede el límite
     */
    public function enforceOrBlock(string $key, int $maxRequests = 60, int $windowSeconds = 60): void {
        $result = $this->check($key, $maxRequests, $windowSeconds, true);
        if (!$result['allowed']) {
            http_response_code(429);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'success' => false,
                'status'  => 429,
                'message' => 'Límite de peticiones excedido. Por favor espere unos momentos antes de reintentar.',
                'retry_after_seconds' => $result['retry_after'],
                'reset_timestamp' => $result['reset'],
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    }
}
