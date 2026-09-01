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
     * Obtiene una instancia singleton de conexión PDO
     */
    public static function getConnection(array $config): ?PDO {
        if (self::$initialized) {
            return self::$pdo;
        }

        self::$initialized = true;
        $dbConfig = $config['database'] ?? [];

        if (empty($dbConfig['enabled'])) {
            // Base de datos deshabilitada en la configuración
            return null;
        }

        $host = $dbConfig['host'] ?? '127.0.0.1';
        $port = $dbConfig['port'] ?? 3306;
        $dbName = $dbConfig['name'] ?? 'quality_web';
        $user = $dbConfig['user'] ?? 'root';
        $pass = $dbConfig['password'] ?? '';
        $charset = $dbConfig['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset={$charset}";

        try {
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_TIMEOUT            => 5,
            ];

            self::$pdo = new PDO($dsn, $user, $pass, $options);
            self::ensureTablesExist();
            return self::$pdo;
        } catch (PDOException $e) {
            self::$lastError = $e->getMessage();
            error_log('[QCS DB Error] Fallo al conectar a MySQL: ' . $e->getMessage());
            self::$pdo = null;
            return null;
        }
    }

    /**
     * Garantiza la existencia de las tablas si la base de datos está conectada
     */
    private static function ensureTablesExist(): void {
        if (!self::$pdo) return;

        try {
            $sqlContactos = "CREATE TABLE IF NOT EXISTS `contactos` (
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

            self::$pdo->exec($sqlContactos);
            self::$pdo->exec($sqlLibro);
        } catch (PDOException $e) {
            error_log('[QCS DB Init Table Error] ' . $e->getMessage());
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
            $sql = "INSERT INTO `contactos` 
                    (`nombre`, `telefono`, `empresa`, `email`, `consulta`, `ip_origen`, `user_agent`) 
                    VALUES (:nombre, :telefono, :empresa, :email, :consulta, :ip_origen, :user_agent)";
            
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
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

