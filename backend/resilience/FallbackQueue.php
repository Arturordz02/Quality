<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Resiliencia: Gestor de Cola de Contingencia en Disco (Fallback Queue)
 * Garantiza persistencia verificada cuando la base de datos principal no está disponible.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class FallbackQueue {
    private static ?string $customQueueDir = null;

    /**
     * Permite sobreescribir el directorio de cola (útil para pruebas y entornos controlados)
     */
    public static function setQueueDir(?string $dir): void {
        self::$customQueueDir = $dir;
    }

    /**
     * Obtiene la ruta del directorio de almacenamiento de contingencia
     */
    public static function getQueueDir(): string {
        return self::$customQueueDir ?: (__DIR__ . '/../storage/fallback_queue');
    }

    /**
     * Guarda un registro en la cola de contingencia y VERIFICA estrictamente que el archivo exista en disco.
     *
     * @param string $type Tipo de registro ('contact', 'claim', 'evaluation')
     * @param array $data Datos del registro
     * @param string|null $identifier Identificador único opcional (ej. código de reclamación)
     * @return array [success => bool, file_path => ?string, bytes => int, error => ?string]
     */
    public static function save(string $type, array $data, ?string $identifier = null): array {
        try {
            $queueDir = self::getQueueDir();

            // 1. Asegurar existencia del directorio
            if (!is_dir($queueDir)) {
                if (!@mkdir($queueDir, 0755, true) && !is_dir($queueDir)) {
                    $err = "No se pudo crear el directorio de contingencia: {$queueDir}";
                    error_log('[QCS FallbackQueue Error] ' . $err);
                    return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
                }
            }

            // 2. Verificar permisos de escritura en el directorio
            if (!is_writable($queueDir)) {
                $err = "El directorio de contingencia no tiene permisos de escritura: {$queueDir}";
                error_log('[QCS FallbackQueue Error] ' . $err);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            // 3. Generar nombre de archivo único y seguro
            $safeType = preg_replace('/[^a-zA-Z0-9_\-]/', '', $type);
            $queueId = $data['queue_id'] ?? ($identifier && str_starts_with($identifier, 'evt_') ? $identifier : ('evt_' . $safeType . '_' . date('Ymd_His') . '_' . bin2hex(random_bytes(8))));
            $data['queue_id'] = $queueId;

            if ($identifier) {
                $safeId = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $identifier);
                $fileName = $safeType . '_' . $safeId . '.json';
            } else {
                $fileName = $safeType . '_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.json';
            }

            $targetFile = $queueDir . '/' . $fileName;

            // 4. Preparar payload estructurado
            $payload = [
                'type'        => $safeType,
                'queue_id'    => $queueId,
                'id'          => $identifier ?: $queueId,
                'queued_at'   => date('Y-m-d H:i:s'),
                'timestamp'   => time(),
                'data'        => $data,
            ];

            $encoded = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            if ($encoded === false) {
                $err = "Error de serialización JSON: " . json_last_error_msg();
                error_log('[QCS FallbackQueue Error] ' . $err);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            // 5. Escritura atómica mediante archivo temporal con bloqueo exclusivo LOCK_EX
            $tmpFile = $targetFile . '.tmp.' . uniqid('', true);
            $written = @file_put_contents($tmpFile, $encoded, LOCK_EX);
            if ($written === false || $written <= 0) {
                @unlink($tmpFile);
                $err = "Fallo al escribir en archivo temporal: {$tmpFile}";
                error_log('[QCS FallbackQueue Error] ' . $err);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            // Renombrar atómicamente al archivo destino
            if (!@rename($tmpFile, $targetFile)) {
                @unlink($tmpFile);
                $err = "Fallo al mover archivo temporal al destino: {$targetFile}";
                error_log('[QCS FallbackQueue Error] ' . $err);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            // 6. Verificación estricta en disco (clearstatcache + file_exists + filesize > 0)
            clearstatcache(true, $targetFile);
            if (!file_exists($targetFile)) {
                $err = "Verificación fallida: el archivo no existe en disco tras escritura: {$targetFile}";
                error_log('[QCS FallbackQueue Error] ' . $err);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            $actualSize = filesize($targetFile);
            if ($actualSize === false || $actualSize <= 0) {
                $err = "Verificación fallida: el archivo se encuentra vacío en disco: {$targetFile}";
                error_log('[QCS FallbackQueue Error] ' . $err);
                @unlink($targetFile);
                return ['success' => false, 'file_path' => null, 'bytes' => 0, 'error' => $err];
            }

            return [
                'success'   => true,
                'file_path' => $targetFile,
                'bytes'     => $actualSize,
                'error'     => null,
            ];
        } catch (\Throwable $e) {
            $err = "Excepción en almacenamiento de contingencia: " . $e->getMessage();
            error_log('[QCS FallbackQueue Exception] ' . $err);
            return [
                'success'   => false,
                'file_path' => null,
                'bytes'     => 0,
                'error'     => $err,
            ];
        }
    }

    /**
     * Verifica si un archivo de registro específico existe y contiene datos válidos
     */
    public static function exists(string $filePath): bool {
        clearstatcache(true, $filePath);
        return file_exists($filePath) && ((int)filesize($filePath) > 0);
    }
}

