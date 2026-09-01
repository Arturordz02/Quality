-- ==============================================================================
-- Quality Consulting Solutions - Base de Datos MySQL
-- Esquema de Tablas para Formulario de Contacto y Libro de Reclamaciones
-- ==============================================================================

-- ------------------------------------------------------------------------------
-- 1. TABLA: contactos
-- Almacena las consultas enviadas a través del formulario "ENVÍANOS TU CONSULTA"
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contactos` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(150) NOT NULL,
    `telefono` VARCHAR(30) NOT NULL,
    `empresa` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `consulta` TEXT NOT NULL,
    `ip_origen` VARCHAR(45) NULL,
    `user_agent` VARCHAR(255) NULL,
    `estado` ENUM('pendiente', 'atendido', 'archivado') DEFAULT 'pendiente',
    `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_email` (`email`),
    INDEX `idx_creado_el` (`creado_el`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Consultas recibidas desde el formulario web de contacto';

-- ------------------------------------------------------------------------------
-- 2. TABLA: libro_reclamaciones
-- Almacena las hojas de reclamación conforme a la Ley N° 29571 (Indecopi - Perú)
-- ------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `libro_reclamaciones` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `codigo_reclamacion` VARCHAR(35) NOT NULL UNIQUE,
    `nombre_consumidor` VARCHAR(150) NOT NULL,
    `documento_identidad` VARCHAR(30) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `telefono` VARCHAR(30) NOT NULL,
    `tipo_registro` ENUM('queja', 'reclamo') NOT NULL,
    `servicio_contratado` VARCHAR(200) NOT NULL,
    `detalle_reclamacion` TEXT NOT NULL,
    `ip_origen` VARCHAR(45) NULL,
    `user_agent` VARCHAR(255) NULL,
    `estado` ENUM('pendiente', 'en_proceso', 'respondido', 'cerrado') DEFAULT 'pendiente',
    `observaciones_internas` TEXT NULL,
    `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_codigo` (`codigo_reclamacion`),
    INDEX `idx_documento` (`documento_identidad`),
    INDEX `idx_email_reclamacion` (`email`),
    INDEX `idx_creado_el` (`creado_el`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Registros formales del Libro de Reclamaciones Virtual';

