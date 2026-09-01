<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Archivo de Configuración de Ejemplo / Plantilla
 * 
 * Copie este archivo como 'config.php' y configure sus credenciales reales de SMTP y MySQL.
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

return [
    // --------------------------------------------------------------------------
    // 1. CONFIGURACIÓN DE CORREO ELECTRÓNICO (SMTP)
    // --------------------------------------------------------------------------
    'mail' => [
        // 'smtp' para envío por servidor SMTP corporativo (Recomendado), o 'mail' para función mail() de PHP
        'driver' => 'smtp',

        // Servidor SMTP (ej: smtp.hostinger.com, smtp.gmail.com, mail.quality-consulting.org)
        'host' => 'mail.quality-consulting.org',

        // Puerto SMTP: 465 (SSL) o 587 (TLS/STARTTLS) o 25
        'port' => 465,

        // Tipo de cifrado: 'ssl' (para puerto 465) o 'tls' (para puerto 587)
        'encryption' => 'ssl',

        // Requiere autenticación SMTP con usuario y contraseña (true/false)
        'auth' => true,

        // Usuario SMTP (correo corporativo)
        'username' => 'contacto@quality-consulting.org',

        // Contraseña de la cuenta de correo o contraseña de aplicación
        'password' => 'TU_CONTRASEÑA_SMTP_AQUI',

        // Remitente que verán los receptores del correo
        'from_email' => 'contacto@quality-consulting.org',
        'from_name' => 'Quality Consulting Solutions',

        // Buzón de destino para el Formulario de Contacto ("ENVÍANOS TU CONSULTA")
        'contact_recipient' => 'contacto@quality-consulting.org',

        // Buzón de destino para el Libro de Reclamaciones Virtual
        'claim_recipient' => 'contacto@quality-consulting.org',

        // Enviar copia digital de la Hoja de Reclamación al correo del reclamante (true/false)
        'send_copy_to_claimant' => true,
    ],

    // --------------------------------------------------------------------------
    // 2. CONFIGURACIÓN DE BASE DE DATOS (MySQL / MariaDB)
    // --------------------------------------------------------------------------
    'database' => [
        // Cambiar a true cuando haya creado la base de datos importando backend/schema.sql
        'enabled' => false,

        'host' => '127.0.0.1',
        'port' => 3306,
        'name' => 'quality_web',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
    ],

    // --------------------------------------------------------------------------
    // 3. DATOS DE LA EMPRESA (Usados en las plantillas formales de correo)
    // --------------------------------------------------------------------------
    'company' => [
        'name' => 'Quality Consulting Solutions',
        'address' => 'Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17, Perú',
        'phone' => '+51 993 463 118',
        'website' => 'https://quality-consulting.org',
        'legal_response_days' => 15, // Plazo legal máximo de respuesta en días hábiles (Ley 29571)
    ],

    // --------------------------------------------------------------------------
    // 4. SEGURIDAD Y DEPURACIÓN
    // --------------------------------------------------------------------------
    'security' => [
        // Nombre del campo invisible trampa para bots (Honeypot)
        'honeypot_field' => '_qcs_verification_hp',

        // Modo depuración: 'true' devuelve detalles del error en la respuesta JSON; 'false' para producción
        'debug' => false,

        // Dominios autorizados para peticiones CORS
        'allowed_origins' => ['*'],
    ]
];

