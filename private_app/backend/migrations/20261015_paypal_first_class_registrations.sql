CREATE TABLE IF NOT EXISTS `paypal_first_class_registrations` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `paypal_order_id` VARCHAR(127) NOT NULL,
    `paypal_capture_id` VARCHAR(127) NOT NULL,
    `nombres` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `telefono` VARCHAR(50) NOT NULL,
    `curso_slug` VARCHAR(190) NOT NULL,
    `curso_titulo` VARCHAR(255) NOT NULL,
    `concepto` VARCHAR(255) NOT NULL,
    `monto` DECIMAL(10,2) NOT NULL,
    `moneda` CHAR(3) NOT NULL,
    `fecha_registro` DATETIME NOT NULL,
    `ip_origen` VARCHAR(45) NULL,
    `user_agent` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `uq_paypal_first_class_order` (`paypal_order_id`),
    UNIQUE KEY `uq_paypal_first_class_capture` (`paypal_capture_id`),
    INDEX `idx_paypal_first_class_email` (`email`),
    INDEX `idx_paypal_first_class_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

