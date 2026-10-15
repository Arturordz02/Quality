<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Módulo de Conexión y Persistencia MySQL con PDO y Consultas Preparadas
 */

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class Database {
    private static ?PDO $pdo = null;
    private static ?string $lastError = null;
    private static bool $initialized = false;

    /**
     * Restablece el estado estático de la conexión (vital para reintentos y pruebas controladas)
     */
    public static function resetConnection(): void {
        self::$pdo = null;
        self::$initialized = false;
        self::$lastError = null;
    }

    /** Inyecta una conexión controlada exclusivamente para pruebas. */
    public static function setConnectionForTesting(?PDO $pdo): void {
        self::$pdo = $pdo;
        self::$initialized = $pdo !== null;
        self::$lastError = null;
    }

    /**
     * Obtiene una instancia singleton de conexión PDO
     */
    public static function getConnection(array $config): ?PDO {
        if (self::$initialized && self::$pdo !== null) {
            return self::$pdo;
        }

        self::$initialized = true;
        $dbConfig = $config['database'] ?? [];

        if (empty($dbConfig['enabled'])) {
            // Base de datos deshabilitada en la configuración
            self::$pdo = null;
            return null;
        }

        $host = $dbConfig['host'] ?? '';
        $port = $dbConfig['port'] ?? 3306;
        $dbName = $dbConfig['name'] ?? '';
        $user = $dbConfig['user'] ?? '';
        $pass = $dbConfig['password'] ?? '';
        $charset = $dbConfig['charset'] ?? 'utf8mb4';

        if (empty($host) || empty($dbName) || empty($user)) {
            self::$lastError = 'Configuración incompleta de base de datos: faltan DB_HOST, DB_NAME o DB_USER en variables de entorno (.env).';
            error_log('[QCS DB Warning] ' . self::$lastError);
            self::$pdo = null;
            return null;
        }

        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset={$charset}";

        try {
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_TIMEOUT            => 5,
            ];

            self::$pdo = new PDO($dsn, $user, $pass, $options);
            return self::$pdo;
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB Error] Fallo al conectar a MySQL: ' . $e->getMessage());
            self::$pdo = null;
            return null;
        }
    }

    /**
     * Utilidad para crear tablas si no existen (Uso exclusivo en instalación inicial o tests)
     * NOTA: Nunca se ejecuta automáticamente durante las peticiones web normales para evitar overhead DDL.
     */
    public static function ensureTablesExist(): void {
        if (!self::$pdo) return;

        try {
            $sqlContactos = "CREATE TABLE IF NOT EXISTS `contactos` (
                `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `queue_id` VARCHAR(64) NULL,
                `nombre` VARCHAR(150) NOT NULL,
                `telefono` VARCHAR(50) NOT NULL,
                `empresa` VARCHAR(150) NOT NULL,
                `email` VARCHAR(150) NOT NULL,
                `consulta` TEXT NOT NULL,
                `ip_origen` VARCHAR(45) NULL,
                `user_agent` TEXT NULL,
                `estado` ENUM('pendiente', 'atendido', 'archivado') DEFAULT 'pendiente',
                `creado_el` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY `uq_contactos_queue_id` (`queue_id`),
                INDEX `idx_queue_id` (`queue_id`),
                INDEX `idx_email` (`email`),
                INDEX `idx_creado_el` (`creado_el`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            $sqlLibro = "CREATE TABLE IF NOT EXISTS `libro_reclamaciones` (
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
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            $sqlPayPal = "CREATE TABLE IF NOT EXISTS `paypal_first_class_registrations` (
                `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `nombres` VARCHAR(150) NOT NULL,
                `email` VARCHAR(150) NOT NULL,
                `telefono` VARCHAR(30) NOT NULL,
                `curso_slug` VARCHAR(190) NOT NULL,
                `curso_titulo` VARCHAR(255) NOT NULL,
                `paypal_order_id` VARCHAR(127) NOT NULL,
                `paypal_capture_id` VARCHAR(127) NOT NULL,
                `concepto` VARCHAR(255) NOT NULL,
                `monto` DECIMAL(10,2) NOT NULL,
                `moneda` CHAR(3) NOT NULL,
                `fecha_registro` DATETIME NOT NULL,
                `ip_origen` VARCHAR(45) NULL,
                `user_agent` VARCHAR(255) NULL,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE KEY `uq_paypal_first_class_order` (`paypal_order_id`),
                UNIQUE KEY `uq_paypal_first_class_capture` (`paypal_capture_id`),
                INDEX `idx_paypal_first_class_email` (`email`),
                INDEX `idx_paypal_first_class_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

            self::$pdo->exec($sqlContactos);
            self::$pdo->exec($sqlLibro);
            self::$pdo->exec($sqlPayPal);
        } catch (PDOException $e) {
            error_log('[QCS DB Init Table Error] ' . $e->getMessage());
        }
    }

    /** Guarda directamente una inscripción PayPal validada. */
    public static function savePayPalFirstClassRegistration(array $config, array $data): bool {
        $pdo = self::getConnection($config);
        if (!$pdo) return false;

        try {
            $sql = "INSERT INTO `paypal_first_class_registrations`
                (`nombres`, `email`, `telefono`, `curso_slug`, `curso_titulo`, `paypal_order_id`,
                 `paypal_capture_id`, `concepto`, `monto`, `moneda`, `fecha_registro`, `ip_origen`, `user_agent`)
                VALUES (:nombres, :email, :telefono, :curso_slug, :curso_titulo, :order_id,
                        :capture_id, :concepto, :monto, :moneda, :fecha_registro, :ip_origen, :user_agent)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':nombres' => $data['nombres'], ':email' => $data['email'], ':telefono' => $data['telefono'],
                ':curso_slug' => $data['curso_slug'], ':curso_titulo' => $data['curso_titulo'],
                ':order_id' => $data['paypal_order_id'], ':capture_id' => $data['paypal_capture_id'],
                ':concepto' => $data['concepto'] ?? 'Primera clase del curso (no incluye el curso completo)',
                ':monto' => $data['monto'], ':moneda' => $data['moneda'],
                ':fecha_registro' => $data['fecha_registro'] ?? date('Y-m-d H:i:s'),
                ':ip_origen' => $data['ip_origen'] ?? null, ':user_agent' => $data['user_agent'] ?? null,
            ]);
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB Insert PayPal Registration Error] ' . $e->getMessage());
            return false;
        }
    }

    public static function isPayPalTransactionUsed(array $config, string $identifier): bool {
        $pdo = self::getConnection($config);
        if (!$pdo) return false;
        try {
            $stmt = $pdo->prepare("SELECT `id` FROM `paypal_first_class_registrations`
                WHERE `paypal_order_id` = :order_id OR `paypal_capture_id` = :capture_id LIMIT 1");
            $stmt->execute([':order_id' => $identifier, ':capture_id' => $identifier]);
            return (bool)$stmt->fetch();
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB PayPal Duplicate Check Error] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Guarda una consulta de contacto usando consulta preparada
     */
    public static function saveContact(array $config, array $data): bool {
        $pdo = self::getConnection($config);
        if (!$pdo) {
            return false;
        }

        try {
            $queueId = $data['queue_id'] ?? null;
            $sql = "INSERT INTO `contactos` 
                    (`queue_id`, `nombre`, `telefono`, `empresa`, `email`, `consulta`, `ip_origen`, `user_agent`) 
                    VALUES (:queue_id, :nombre, :telefono, :empresa, :email, :consulta, :ip_origen, :user_agent)";
            
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':queue_id'   => $queueId,
                ':nombre'     => $data['nombre'],
                ':telefono'   => $data['telefono'],
                ':empresa'    => $data['empresa'],
                ':email'      => $data['email'],
                ':consulta'   => $data['consulta'],
                ':ip_origen'  => $data['ip_origen'] ?? null,
                ':user_agent' => $data['user_agent'] ?? null,
            ]);
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB Insert Contact Error] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Guarda un registro del Libro de Reclamaciones usando consulta preparada
     */
    public static function saveClaim(array $config, array $data): bool {
        $pdo = self::getConnection($config);
        if (!$pdo) {
            return false;
        }

        try {
            $sql = "INSERT INTO `libro_reclamaciones` 
                    (`codigo_reclamacion`, `nombre_consumidor`, `documento_identidad`, `email`, `telefono`, `tipo_registro`, `servicio_contratado`, `detalle_reclamacion`, `ip_origen`, `user_agent`) 
                    VALUES (:codigo, :nombre, :documento, :email, :telefono, :tipo, :servicio, :detalle, :ip_origen, :user_agent)";
            
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':codigo'    => $data['codigo_reclamacion'],
                ':nombre'    => $data['nombre'],
                ':documento' => $data['documento'],
                ':email'     => $data['email'],
                ':telefono'  => $data['telefono'],
                ':tipo'      => $data['tipo'],
                ':servicio'  => $data['servicio'],
                ':detalle'   => $data['detalle'],
                ':ip_origen' => $data['ip_origen'] ?? null,
                ':user_agent'=> $data['user_agent'] ?? null,
            ]);
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB Insert Claim Error] ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene el último error registrado
     */
    public static function getLastError(): ?string {
        return self::$lastError;
    }
}

