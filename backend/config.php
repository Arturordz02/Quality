<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Archivo de Configuración Activa del Backend
 * 
 * Gestiona la configuración mediante variables de entorno (getenv / .env)
 * garantizando que NUNCA queden credenciales ni secretos en el código fuente.
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

// 1. Cargar archivo .env local si existe (Zero-dependency .env loader para Apache/FastCGI/GoDaddy)
(function() {
    $candidates = [
        dirname(__DIR__) . '/.env',
        __DIR__ . '/.env'
    ];

    foreach ($candidates as $envPath) {
        if (file_exists($envPath) && is_readable($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines === false) {
                continue;
            }

            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || str_starts_with($line, '#')) {
                    continue;
                }

                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $val = trim($parts[1]);

                    // Remover comillas externas simples o dobles
                    if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                        (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                        $val = substr($val, 1, -1);
                    }

                    // Registrar en entorno si no está ya definido por el servidor
                    if (getenv($key) === false) {
                        putenv("{$key}={$val}");
                    }
                    if (!isset($_ENV[$key])) {
                        $_ENV[$key] = $val;
                    }
                    if (!isset($_SERVER[$key])) {
                        $_SERVER[$key] = $val;
                    }
                }
            }
            break;
        }
    }
})();

// Helper para leer variable de entorno de forma uniforme
$env = function(string $key, $default = null) {
    $val = getenv($key);
    if ($val !== false && $val !== '') {
        return $val;
    }
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
        return $_ENV[$key];
    }
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
        return $_SERVER[$key];
    }
    return $default;
};

// Helper para variables booleanas
$envBool = function(string $key, bool $default = false) use ($env): bool {
    $val = $env($key, null);
    if ($val === null) {
        return $default;
    }
    return filter_var($val, FILTER_VALIDATE_BOOLEAN);
};

return [
    // --------------------------------------------------------------------------
    // APLICACIÓN Y ENTORNO
    // --------------------------------------------------------------------------
    'app' => [
        'env' => $env('APP_ENV', 'production'),
    ],

    // --------------------------------------------------------------------------
    // 1. CONFIGURACIÓN DE CORREO ELECTRÓNICO (SMTP)
    // --------------------------------------------------------------------------
    'mail' => [
        'driver'                => $env('SMTP_DRIVER', 'smtp'),
        'host'                  => $env('SMTP_HOST', 'mail.quality-consulting.org'),
        'port'                  => (int)$env('SMTP_PORT', 465),
        'encryption'            => $env('SMTP_ENCRYPTION', 'ssl'),
        'auth'                  => $envBool('SMTP_AUTH', true),
        'username'              => $env('SMTP_USER', 'contacto@quality-consulting.org'),
        'password'              => $env('SMTP_PASSWORD', ''), // NUNCA almacenar contraseñas reales como fallback
        'from_email'            => $env('SMTP_FROM_EMAIL', 'contacto@quality-consulting.org'),
        'from_name'             => $env('SMTP_FROM_NAME', 'Quality Consulting Solutions'),
        'contact_recipient'     => $env('CONTACT_RECIPIENT', 'contacto@quality-consulting.org'),
        'claim_recipient'       => $env('CLAIM_RECIPIENT', 'contacto@quality-consulting.org'),
        'send_copy_to_claimant' => $envBool('SMTP_SEND_COPY_CLAIMANT', true),
        'allow_self_signed'     => ($env('APP_ENV', 'production') === 'development') && $envBool('SMTP_ALLOW_SELF_SIGNED', false),
    ],

    // --------------------------------------------------------------------------
    // 2. CONFIGURACIÓN DE BASE DE DATOS (MySQL / MariaDB)
    // --------------------------------------------------------------------------
    'database' => [
        'enabled'  => $envBool('DB_ENABLED', false),
        'host'     => $env('DB_HOST', '127.0.0.1'),
        'port'     => (int)$env('DB_PORT', 3306),
        'name'     => $env('DB_NAME', 'quality_web'),
        'user'     => $env('DB_USER', 'root'),
        'password' => $env('DB_PASSWORD', ''), // NUNCA almacenar contraseñas reales como fallback
        'charset'  => $env('DB_CHARSET', 'utf8mb4'),
    ],

    // --------------------------------------------------------------------------
    // 3. DATOS DE LA EMPRESA (Usados en las plantillas de correo formal)
    // --------------------------------------------------------------------------
    'company' => [
        'name'                => $env('COMPANY_NAME', 'Quality Consulting Solutions'),
        'address'             => $env('COMPANY_ADDRESS', 'Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17, Perú'),
        'phone'               => $env('COMPANY_PHONE', '+51 993 463 118'),
        'website'             => $env('COMPANY_WEBSITE', 'https://quality-consulting.org'),
        'legal_response_days' => (int)$env('LEGAL_RESPONSE_DAYS', 15),
    ],

    // --------------------------------------------------------------------------
    // 4. SEGURIDAD, CORS Y RATE LIMITING
    // --------------------------------------------------------------------------
    'security' => [
        'honeypot_field'       => $env('HONEYPOT_FIELD', '_qcs_verification_hp'),
        'debug'                => $envBool('APP_DEBUG', false),
        'allowed_origins'      => array_values(array_filter(array_map('trim', explode(',', (string)$env(
            'CORS_ALLOWED_ORIGINS',
            ($env('APP_ENV', 'production') === 'development')
                ? 'https://quality-consulting.org,https://www.quality-consulting.org,http://localhost:8089,http://127.0.0.1:8089,http://localhost,http://127.0.0.1'
                : 'https://quality-consulting.org,https://www.quality-consulting.org'
        ))))),
        'trust_proxy_headers'  => $envBool('TRUST_PROXY_HEADERS', false),
        'trusted_proxies'      => array_values(array_filter(array_map('trim', explode(',', (string)$env('TRUSTED_PROXIES', '127.0.0.1,::1'))))),
    ]
];
