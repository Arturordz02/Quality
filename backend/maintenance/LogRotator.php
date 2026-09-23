<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Mantenimiento: Rotación, Compresión y Purga Automatizada de Logs
 * Mantiene el uso de disco óptimo comprimiendo con gzip y eliminando logs antiguos.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class LogRotator {
    private string $logDir;
    private int $maxFileSizeBytes;
    private int $retentionDays;

    /**
     * @param string|null $logDir Directorio de logs
     * @param int $maxFileSizeBytes Tamaño máximo antes de rotar (default: 10MB)
     * @param int $retentionDays Días de retención para logs archivados (default: 30)
     */
    public function __construct(?string $logDir = null, int $maxFileSizeBytes = 10485760, int $retentionDays = 30) {
        $this->logDir = $logDir ?: __DIR__ . '/../storage/logs';
        $this->maxFileSizeBytes = $maxFileSizeBytes;
        $this->retentionDays = $retentionDays;

        if (!is_dir($this->logDir)) {
            @mkdir($this->logDir, 0755, true);
        }
    }

    /**
     * Ejecuta el ciclo completo de rotación, compresión y purga
     */
    public function run(): array {
        $results = [
            'rotated' => [],
            'purged'  => [],
            'bytes_freed' => 0,
        ];

        // 1. Rotar y comprimir archivos activos que superen el límite
        $logFiles = glob($this->logDir . '/*.log');
        if ($logFiles) {
            foreach ($logFiles as $logFile) {
                $size = @filesize($logFile);
                if ($size !== false && $size >= $this->maxFileSizeBytes) {
                    $timestamp = date('Ymd_His');
                    $gzTarget = $logFile . '.' . $timestamp . '.gz';

                    $originalSize = $size;
                    if ($this->compressFile($logFile, $gzTarget)) {
                        // Limpiar el archivo activo
                        @file_put_contents($logFile, "[ROTATED at " . date('Y-m-d H:i:s') . "]\n", LOCK_EX);
                        $compressedSize = filesize($gzTarget);
                        $saved = $originalSize - $compressedSize;
                        $results['rotated'][] = [
                            'file' => basename($logFile),
                            'original_bytes' => $originalSize,
                            'compressed_bytes' => $compressedSize,
                            'saved_bytes' => $saved,
                        ];
                        $results['bytes_freed'] += $saved;
                    }
                }
            }
        }

        // 2. Purgar archivos comprimidos antiguos
        $cutoffTime = time() - ($this->retentionDays * 86400);
        $archivedFiles = glob($this->logDir . '/*.gz');
        if ($archivedFiles) {
            foreach ($archivedFiles as $archive) {
                $mtime = @filemtime($archive);
                if ($mtime !== false && $mtime < $cutoffTime) {
                    $archSize = @filesize($archive);
                    if (@unlink($archive)) {
                        $results['purged'][] = basename($archive);
                        $results['bytes_freed'] += ($archSize ?: 0);
                    }
                }
            }
        }

        return $results;
    }

    /**
     * Comprime un archivo a formato .gz
     */
    private function compressFile(string $source, string $destination): bool {
        $srcHandle = @fopen($source, 'rb');
        if (!$srcHandle) return false;

        $gzHandle = @gzopen($destination, 'wb9');
        if (!$gzHandle) {
            fclose($srcHandle);
            return false;
        }

        while (!feof($srcHandle)) {
            $buffer = fread($srcHandle, 65536);
            if ($buffer !== false && strlen($buffer) > 0) {
                gzwrite($gzHandle, $buffer);
            }
        }

        fclose($srcHandle);
        gzclose($gzHandle);
        return true;
    }
}

