<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Módulo de Seguridad, Sanitización y Validación
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class Security {

    /**
     * Configura los encabezados HTTP para respuestas JSON seguras y CORS
     */
    public static function sendJsonHeaders(array $config = []): void {
        $allowedOrigins = $config['security']['allowed_origins'] ?? ['*'];
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

        if (in_array('*', $allowedOrigins, true)) {
            header('Access-Control-Allow-Origin: *');
        } elseif ($origin && in_array($origin, $allowedOrigins, true)) {
            header("Access-Control-Allow-Origin: $origin");
        }

        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
        header('Content-Type: application/json; charset=UTF-8');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');

        // Responder inmediatamente a peticiones preflight OPTIONS
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }

    /**
     * Sanitiza una cadena de texto de una sola línea
     */
    public static function sanitizeString(?string $str, int $maxLength = 255): string {
        if ($str === null) return '';
        $clean = trim($str);
        $clean = strip_tags($clean);
        // Remover caracteres de control nulos
        $clean = str_replace(chr(0), '', $clean);
        if (mb_strlen($clean, 'UTF-8') > $maxLength) {
            $clean = mb_substr($clean, 0, $maxLength, 'UTF-8');
        }
        return htmlspecialchars($clean, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Sanitiza texto multilínea (ej. consultas o descripciones de reclamos)
     */
    public static function sanitizeMultiline(?string $str, int $maxLength = 4000): string {
        if ($str === null) return '';
        $clean = trim($str);
        $clean = strip_tags($clean);
        $clean = str_replace(chr(0), '', $clean);
        if (mb_strlen($clean, 'UTF-8') > $maxLength) {
            $clean = mb_substr($clean, 0, $maxLength, 'UTF-8');
        }
        return htmlspecialchars($clean, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Sanitiza y valida formato de correo electrónico
     */
    public static function sanitizeEmail(?string $email): string {
        if ($email === null) return '';
        $clean = trim($email);
        $clean = filter_var($clean, FILTER_SANITIZE_EMAIL);
        return $clean ?: '';
    }

    /**
     * Verifica si un correo electrónico es válido
     */
    public static function isValidEmail(string $email): bool {
        if (empty($email) || mb_strlen($email, 'UTF-8') > 150) {
            return false;
        }
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Verifica si un teléfono tiene formato razonable (dígitos, espacios, +, -, ())
     */
    public static function isValidPhone(string $phone): bool {
        $phone = trim($phone);
        if (mb_strlen($phone, 'UTF-8') < 6 || mb_strlen($phone, 'UTF-8') > 30) {
            return false;
        }
        // Permitir dígitos, espacios, signos +, -, (, )
        return (bool) preg_match('/^[0-9\+\-\s\(\)\.]{6,30}$/', $phone);
    }

    /**
     * Verifica que el campo trampa anti-spam (Honeypot) esté vacío
     */
    public static function verifyHoneypot(array $postData, string $fieldName): bool {
        if (isset($postData[$fieldName]) && trim($postData[$fieldName]) !== '') {
            // Un bot llenó el campo oculto
            return false;
        }
        return true;
    }

    /**
     * Obtiene la dirección IP del cliente de forma segura
     */
    public static function getClientIp(): string {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'];
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ips = explode(',', $_SERVER[$key]);
                $cleanIp = trim($ips[0]);
                if (filter_var($cleanIp, FILTER_VALIDATE_IP)) {
                    return $cleanIp;
                }
            }
        }
        return '0.0.0.0';
    }

    /**
     * Obtiene el User-Agent del navegador
     */
    public static function getUserAgent(): string {
        $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido';
        return self::sanitizeString($agent, 250);
    }

    /**
     * Emite una respuesta JSON exitosa
     */
    public static function jsonSuccess(string $message, array $extraData = []): void {
        http_response_code(200);
        $payload = array_merge([
            'success' => true,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ], $extraData);
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * Emite una respuesta JSON de error
     */
    public static function jsonError(string $message, int $httpCode = 400, array $errors = []): void {
        http_response_code($httpCode);
        $payload = [
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}

