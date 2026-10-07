<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Plantilla de Configuración Nativa PHP para cPanel / GoDaddy
 * 
 * Si tu servidor cPanel no lee archivos .env o prefieres evitar parsing en disco,
 * copia este archivo a 'private_app/env.php' y completa tus credenciales reales.
 * NUNCA incluyas contraseñas reales en repositorios o archivos empaquetados.
 */

return [
    // Entorno y Aplicación
    'APP_ENV'                 => 'production',
    'APP_DEBUG'               => 'false',
    'APP_URL'                 => 'https://quality-consulting.org',

    // Base de Datos MySQL
    'DB_ENABLED'              => 'false',
    'DB_HOST'                 => 'localhost',
    'DB_PORT'                 => '3306',
    'DB_NAME'                 => '',
    'DB_USER'                 => '',
    'DB_PASSWORD'             => '',
    'DB_CHARSET'              => 'utf8mb4',

    // Correo Saliente SMTP (Valores de referencia ilustrativos: completar con los del proveedor real)
    'SMTP_DRIVER'             => 'smtp',
    'SMTP_HOST'               => 'mail.quality-consulting.org',
    'SMTP_PORT'               => '465',
    'SMTP_ENCRYPTION'         => 'ssl',
    'SMTP_AUTH'               => 'true',
    'SMTP_USER'               => 'contacto@quality-consulting.org',
    'SMTP_PASSWORD'           => '',
    'SMTP_FROM_EMAIL'         => 'contacto@quality-consulting.org',
    'SMTP_FROM_NAME'          => 'Quality Consulting Solutions',
    'CONTACT_RECIPIENT'       => 'contacto@quality-consulting.org',
    'CLAIM_RECIPIENT'         => 'contacto@quality-consulting.org',
    'SMTP_SEND_COPY_CLAIMANT' => 'true',

    // Seguridad
    'HONEYPOT_FIELD'          => '_qcs_verification_hp',
    'CORS_ALLOWED_ORIGINS'    => 'https://quality-consulting.org,https://www.quality-consulting.org',
];

