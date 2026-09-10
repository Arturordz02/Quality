<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Archivo de Configuración de Ejemplo / Plantilla
 * 
 * Copie este archivo como 'config.php' o defina las variables en un archivo '.env'.
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

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

$envBool = function(string $key, bool $default = false) use ($env): bool {
    $val = $env($key, null);
    if ($val === null) {
        return $default;
    }
    return filter_var($val, FILTER_VALIDATE_BOOLEAN);
};

return [
    'app' => [
        'env' => $env('APP_ENV', 'production'),
    ],
    'mail' => [
        'driver'                => $env('SMTP_DRIVER', 'smtp'),
        'host'                  => $env('SMTP_HOST', 'mail.quality-consulting.org'),
        'port'                  => (int)$env('SMTP_PORT', 465),
        'encryption'            => $env('SMTP_ENCRYPTION', 'ssl'),
        'auth'                  => $envBool('SMTP_AUTH', true),
        'username'              => $env('SMTP_USER', 'contacto@quality-consulting.org'),
        'password'              => $env('SMTP_PASSWORD', ''),
        'from_email'            => $env('SMTP_FROM_EMAIL', 'contacto@quality-consulting.org'),
        'from_name'             => $env('SMTP_FROM_NAME', 'Quality Consulting Solutions'),
        'contact_recipient'     => $env('CONTACT_RECIPIENT', 'contacto@quality-consulting.org'),
        'claim_recipient'       => $env('CLAIM_RECIPIENT', 'contacto@quality-consulting.org'),
        'send_copy_to_claimant' => $envBool('SMTP_SEND_COPY_CLAIMANT', true),
    ],
    'database' => [
        'enabled'  => $envBool('DB_ENABLED', false),
        'host'     => $env('DB_HOST', '127.0.0.1'),
        'port'     => (int)$env('DB_PORT', 3306),
        'name'     => $env('DB_NAME', 'quality_web'),
        'user'     => $env('DB_USER', 'root'),
        'password' => $env('DB_PASSWORD', ''),
        'charset'  => $env('DB_CHARSET', 'utf8mb4'),
    ],
    'company' => [
        'name'                => $env('COMPANY_NAME', 'Quality Consulting Solutions'),
        'address'             => $env('COMPANY_ADDRESS', 'Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17, Perú'),
        'phone'               => $env('COMPANY_PHONE', '+51 993 463 118'),
        'website'             => $env('COMPANY_WEBSITE', 'https://quality-consulting.org'),
        'legal_response_days' => (int)$env('LEGAL_RESPONSE_DAYS', 15),
    ],
    'security' => [
        'honeypot_field'       => $env('HONEYPOT_FIELD', '_qcs_verification_hp'),
        'debug'                => $envBool('APP_DEBUG', false),
        'allowed_origins'      => array_values(array_filter(array_map('trim', explode(',', (string)$env(
            'CORS_ALLOWED_ORIGINS',
            'https://quality-consulting.org,https://www.quality-consulting.org'
        ))))),
        'trust_proxy_headers'  => $envBool('TRUST_PROXY_HEADERS', false),
        'trusted_proxies'      => array_values(array_filter(array_map('trim', explode(',', (string)$env('TRUSTED_PROXIES', '127.0.0.1,::1'))))),
    ]
];
