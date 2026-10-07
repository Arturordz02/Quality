<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Cache: CacheManager Multicapa con Degradación Elegante
 * Soporta Redis, APCu y FileCache con fallback transparente.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

require_once __DIR__ . '/CacheInterface.php';
require_once __DIR__ . '/FileCache.php';

class CacheManager implements CacheInterface {
    private static ?CacheManager $instance = null;
    private CacheInterface $driver;
    private string $activeDriverName = 'file';

    public function __construct(array $config = []) {
        $redisConfig = $config['redis'] ?? [];
        $driverChoice = $config['cache']['driver'] ?? 'auto';

        // 1. Intentar Redis si está configurado y la extensión existe
        if (($driverChoice === 'redis' || $driverChoice === 'auto') && !empty($redisConfig['enabled']) && class_exists('Redis')) {
            try {
                $redis = new \Redis();
                $host = $redisConfig['host'] ?? '127.0.0.1';
                $port = (int)($redisConfig['port'] ?? 6379);
                $timeout = (float)($redisConfig['timeout'] ?? 1.5);
                
                $connected = @$redis->connect($host, $port, $timeout);
                if ($connected) {
                    if (!empty($redisConfig['password'])) {
                        $redis->auth($redisConfig['password']);
                    }
                    if (isset($redisConfig['database'])) {
                        $redis->select((int)$redisConfig['database']);
                    }
                    // Crear wrapper Redis
                    $this->driver = new class($redis) implements CacheInterface {
                        private \Redis $r;
                        public function __construct(\Redis $r) { $this->r = $r; }
                        public function get(string $key, $default = null) {
                            $val = $this->r->get($key);
                            return ($val === false) ? $default : unserialize($val);
                        }
                        public function set(string $key, $value, int $ttlSeconds = 3600): bool {
                            return $this->r->setex($key, $ttlSeconds, serialize($value));
                        }
                        public function has(string $key): bool { return (bool)$this->r->exists($key); }
                        public function delete(string $key): bool { return (bool)$this->r->del($key); }
                        public function clear(): bool { return $this->r->flushDB(); }
                        public function remember(string $key, int $ttlSeconds, callable $callback) {
                            $val = $this->get($key);
                            if ($val !== null) return $val;
                            $val = $callback();
                            $this->set($key, $val, $ttlSeconds);
                            return $val;
                        }
                    };
                    $this->activeDriverName = 'redis';
                    return;
                }
            } catch (\Throwable $e) {
                error_log('[QCS Cache Warning] Fallo conexión a Redis, degradando a FileCache: ' . $e->getMessage());
            }
        }

        // 2. Intentar APCu si está disponible en CLI o Web
        if (($driverChoice === 'apcu' || $driverChoice === 'auto') && extension_loaded('apcu') && ini_get('apc.enabled')) {
            $this->driver = new class implements CacheInterface {
                public function get(string $key, $default = null) {
                    $success = false;
                    $val = apcu_fetch($key, $success);
                    return $success ? $val : $default;
                }
                public function set(string $key, $value, int $ttlSeconds = 3600): bool {
                    return apcu_store($key, $value, $ttlSeconds);
                }
                public function has(string $key): bool { return apcu_exists($key); }
                public function delete(string $key): bool { return apcu_delete($key); }
                public function clear(): bool { return apcu_clear_cache(); }
                public function remember(string $key, int $ttlSeconds, callable $callback) {
                    $val = $this->get($key);
                    if ($val !== null) return $val;
                    $val = $callback();
                    $this->set($key, $val, $ttlSeconds);
                    return $val;
                }
            };
            $this->activeDriverName = 'apcu';
            return;
        }

        // 3. Fallback a FileCache
        $this->driver = new FileCache();
        $this->activeDriverName = 'file';
    }

    public static function getInstance(array $config = []): self {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function getActiveDriverName(): string {
        return $this->activeDriverName;
    }

    public function get(string $key, $default = null) {
        return $this->driver->get($key, $default);
    }

    public function set(string $key, $value, int $ttlSeconds = 3600): bool {
        return $this->driver->set($key, $value, $ttlSeconds);
    }

    public function has(string $key): bool {
        return $this->driver->has($key);
    }

    public function delete(string $key): bool {
        return $this->driver->delete($key);
    }

    public function clear(): bool {
        return $this->driver->clear();
    }

    public function remember(string $key, int $ttlSeconds, callable $callback) {
        return $this->driver->remember($key, $ttlSeconds, $callback);
    }
}

