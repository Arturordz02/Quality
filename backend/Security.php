<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Módulo de Seguridad, Sanitización y Validación
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class Security {
    private static array $config = [];

    /**
     * Inicializa la configuración estática de seguridad
     */
    public static function init(array $config): void {
        self::$config = $config;
    }

    /**
     * Configura los encabezados HTTP para respuestas JSON seguras y CORS restringido.
     * 
     * Reglas de CORS:
     * 1. No se utiliza el comodín '*' en endpoints que gestionan datos personales.
     * 2. Si se recibe encabezado Origin, se valida contra la lista de orígenes autorizados.
     * 3. Si el origen es legítimo, se envía Access-Control-Allow-Origin: <origin> y Vary: Origin.
     * 4. Si el origen no está en la lista blanca, NO se envía Access-Control-Allow-Origin.
     * 5. Las solicitudes preflight OPTIONS de orígenes desconocidos son rechazadas con 403.
     */
    public static function sendJsonHeaders(array $config = []): void {
        $cfg = !empty($config) ? $config : self::$config;
        $allowedOrigins = $cfg['security']['allowed_origins'] ?? [
            'https://quality-consulting.org',
            'https://www.quality-consulting.org',
        ];

        // Protección defensiva: Prohibir expresamente '*' en la lista de orígenes autorizados
        $allowedOrigins = array_values(array_filter($allowedOrigins, static function ($origin) {
            return $origin !== '*' && $origin !== '';
        }));

        $requestOrigin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $isOriginAllowed = false;

        if ($requestOrigin !== '') {
            $parsed = parse_url($requestOrigin);
            $normalizedOrigin = ($parsed && isset($parsed['scheme'], $parsed['host']))
                ? $parsed['scheme'] . '://' . $parsed['host'] . (isset($parsed['port']) ? ':' . $parsed['port'] : '')
                : $requestOrigin;

            if (in_array($requestOrigin, $allowedOrigins, true) || in_array($normalizedOrigin, $allowedOrigins, true)) {
                $isOriginAllowed = true;
                header("Access-Control-Allow-Origin: {$requestOrigin}");
                header('Access-Control-Allow-Credentials: true');
            }
            header('Vary: Origin');
        }

        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, Accept, Authorization');
        header('Content-Type: application/json; charset=UTF-8');
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');

        // Manejo estricto de peticiones preflight OPTIONS
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            if ($requestOrigin !== '' && !$isOriginAllowed) {
                http_response_code(403);
                header('Content-Type: application/json; charset=UTF-8');
                echo json_encode([
                    'success' => false,
                    'status'  => 403,
                    'message' => 'CORS: Origen no autorizado.'
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
            header('Access-Control-Max-Age: 86400');
            http_response_code(204);
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
     * Obtiene la dirección IP del cliente de forma segura y confiable contra spoofing.
     *
     * Reglas de Rate Limiting y red:
     * 1. No confía ciegamente en cabeceras enviadas por el cliente (X-Forwarded-For, etc.).
     * 2. Por defecto utiliza estrictamente REMOTE_ADDR (adecuado para Apache/GoDaddy).
     * 3. Solo evalúa cabeceras proxy cuando TRUST_PROXY_HEADERS=true y REMOTE_ADDR proviene
     *    de un proxy confiable especificado en TRUSTED_PROXIES.
     * 4. En caso contrario, se ignora cualquier cabecera de reenvío y se utiliza REMOTE_ADDR.
     */
    public static function getClientIp(?array $config = null): string {
        $cfg = $config ?? self::$config;
        $trustProxy = !empty($cfg['security']['trust_proxy_headers']);
        $trustedProxies = $cfg['security']['trusted_proxies'] ?? ['127.0.0.1', '::1'];

        $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
        $cleanRemoteAddr = filter_var($remoteAddr, FILTER_VALIDATE_IP) ? $remoteAddr : '127.0.0.1';

        // Por defecto (GoDaddy / Apache directo): nunca confiar en cabeceras proxy enviadas por clientes
        if (!$trustProxy) {
            return $cleanRemoteAddr;
        }

        // Si se activó trust_proxy_headers, comprobar si el socket directo es un proxy confiable
        $isFromTrustedProxy = in_array($cleanRemoteAddr, $trustedProxies, true);
        if (!$isFromTrustedProxy) {
            return $cleanRemoteAddr;
        }

        // Conexión legítima desde proxy confiable: extraer IP real del cliente
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $cfIp = trim($_SERVER['HTTP_CF_CONNECTING_IP']);
            if (filter_var($cfIp, FILTER_VALIDATE_IP)) {
                return $cfIp;
            }
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ips as $ip) {
                $clean = trim($ip);
                if (filter_var($clean, FILTER_VALIDATE_IP)) {
                    return $clean;
                }
            }
        }

        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $realIp = trim($_SERVER['HTTP_X_REAL_IP']);
            if (filter_var($realIp, FILTER_VALIDATE_IP)) {
                return $realIp;
            }
        }

        return $cleanRemoteAddr;
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

