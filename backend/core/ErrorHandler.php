<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Core: Manejador Global de Errores y Degradación Elegante (Graceful Degradation)
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class ErrorHandler {
    private static bool $registered = false;
    private static string $logDir = __DIR__ . '/../storage/logs';

    /**
     * Registra los manejadores globales de PHP
     */
    public static function register(bool $debug = false): void {
        if (self::$registered) {
            return;
        }
        self::$registered = true;

        if (!is_dir(self::$logDir)) {
            @mkdir(self::$logDir, 0755, true);
        }

        // Configurar reporte de errores según entorno
        if ($debug) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        } else {
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
            ini_set('display_errors', '0');
        }

        // Manejador de errores estándar (convertir a ErrorException)
        set_error_handler(function (int $severity, string $message, string $file, int $line) {
            if (!(error_reporting() & $severity)) {
                return false;
            }
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });

        // Manejador de excepciones no capturadas
        set_exception_handler(function (\Throwable $exception) use ($debug) {
            self::handleException($exception, $debug);
        });

        // Manejador de apagado (Shutdown) para capturar errores fatales
        register_shutdown_function(function () use ($debug) {
            $lastError = error_get_last();
            if ($lastError && in_array($lastError['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
                $fatalException = new \ErrorException(
                    $lastError['message'],
                    0,
                    $lastError['type'],
                    $lastError['file'],
                    $lastError['line']
                );
                self::handleException($fatalException, $debug);
            }
        });
    }

    /**
     * Procesa y registra la excepción, aplicando degradación elegante
     */
    public static function handleException(\Throwable $e, bool $debug = false): void {
        $logEntry = sprintf(
            "[%s] [ERROR_FATAL] %s en %s:%d | Trace: %s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            str_replace("\n", " -> ", $e->getTraceAsString())
        );

        self::writeLog('error.log', $logEntry);

        // Si los headers ya se enviaron, terminar silenciosamente
        if (!headers_sent()) {
            http_response_code(500);
            header('Content-Type: application/json; charset=UTF-8');
            header('Cache-Control: no-store, no-cache, must-revalidate');
        }

        $response = [
            'success' => false,
            'status'  => 'error',
            'message' => 'El sistema está experimentando una alta demanda o mantenimiento momentáneo. Su solicitud está protegida.',
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        if ($debug) {
            $response['debug'] = [
                'type'    => get_class($e),
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ];
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Escribe un mensaje en el archivo de log correspondiente
     */
    public static function writeLog(string $fileName, string $message): void {
        $filePath = self::$logDir . '/' . $fileName;
        @file_put_contents($filePath, $message, FILE_APPEND | LOCK_EX);
    }
}

