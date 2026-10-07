<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Cache: Interfaz estándar de Caché (PSR-16 Lightweight Compatible)
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

interface CacheInterface {
    public function get(string $key, $default = null);
    public function set(string $key, $value, int $ttlSeconds = 3600): bool;
    public function has(string $key): bool;
    public function delete(string $key): bool;
    public function clear(): bool;
    public function remember(string $key, int $ttlSeconds, callable $callback);
}

