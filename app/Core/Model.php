<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Modelo Base (Base Model)
 *
 * Responsabilidad:
 * - Proporcionar una interfaz limpia y segura para la interacción con la base de datos MySQL (PDO).
 * - Reutilizar la infraestructura de conexión resiliente existente en backend/Database.php.
 * - Soportar consultas preparadas obligatorias para prevenir inyecciones SQL.
 */

declare(strict_types=1);

namespace App\Core;

abstract class Model
{
    /**
     * Instancia compartida de conexión PDO.
     */
    protected ?\PDO $db = null;

    /**
     * Configuración del sistema.
     */
    protected array $config = [];

    public function __construct(?\PDO $db = null, array $config = [])
    {
        $this->config = $config;

        if ($db !== null) {
            $this->db = $db;
        } else {
            $this->initDefaultConnection();
        }
    }

    /**
     * Inicializa la conexión PDO utilizando la infraestructura ya existente.
     */
    protected function initDefaultConnection(): void
    {
        // Reutilizar la clase Database existente si está disponible
        if (class_exists('\\Database')) {
            $effectiveConfig = !empty($this->config) ? $this->config : (function() {
                $appConfig = dirname(__DIR__, 2) . '/config/app.php';
                return file_exists($appConfig) ? require $appConfig : [];
            })();

            $this->db = \Database::getConnection($effectiveConfig);
        }
    }

    /**
     * Retorna la instancia de conexión PDO actual o null si la BD está deshabilitada/offline.
     */
    public function getDb(): ?\PDO
    {
        return $this->db;
    }

    /**
     * Ejecuta una consulta preparada con parámetros enlazados de forma segura.
     *
     * @param string $sql Consulta SQL con placeholders (?) o (:named)
     * @param array $params Valores a enlazar
     * @return \PDOStatement
     * @throws \RuntimeException Si la base de datos no está disponible o la consulta falla
     */
    public function query(string $sql, array $params = []): \PDOStatement
    {
        if ($this->db === null) {
            throw new \RuntimeException('No se puede ejecutar la consulta: la conexión a la base de datos no está disponible.');
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Obtiene un único registro asociativo.
     */
    public function fetchOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Obtiene todos los registros resultantes como un arreglo asociativo.
     */
    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }

    /**
     * Inserta un registro en una tabla a partir de un arreglo asociativo y retorna el ID generado.
     */
    public function insert(string $table, array $data): int|string
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('No se proporcionaron datos para insertar.');
        }

        $columns = array_keys($data);
        $fields = implode('`, `', $columns);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));

        $sql = "INSERT INTO `{$table}` (`{$fields}`) VALUES ({$placeholders})";
        $this->query($sql, array_values($data));

        return $this->db->lastInsertId();
    }
}

