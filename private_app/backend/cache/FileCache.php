<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Cache: FileCache Driver con TTL y Almacenamiento Atómico
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

require_once __DIR__ . '/CacheInterface.php';

class FileCache implements CacheInterface {
    private string $cacheDir;

    public function __construct(?string $cacheDir = null) {
        $this->cacheDir = $cacheDir ?: __DIR__ . '/../storage/cache';
        if (!is_dir($this->cacheDir)) {
            @mkdir($this->cacheDir, 0755, true);
        }
    }

    private function getFilePath(string $key): string {
        $safeKey = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $key);
        $hash = hash('sha256', $key);
        return $this->cacheDir . '/' . $safeKey . '_' . substr($hash, 0, 12) . '.cache';
    }

    public function get(string $key, $default = null) {
        $filePath = $this->getFilePath($key);
        if (!file_exists($filePath)) {
            return $default;
        }

        $content = @file_get_contents($filePath);
        if ($content === false) {
            return $default;
        }

        $data = @unserialize($content);
        if (!is_array($data) || !isset($data['expires_at'], $data['payload'])) {
            @unlink($filePath);
            return $default;
        }

        if (time() > $data['expires_at']) {
            @unlink($filePath);
            return $default;
        }

        return $data['payload'];
    }

    public function set(string $key, $value, int $ttlSeconds = 3600): bool {
        $filePath = $this->getFilePath($key);
        $data = [
            'expires_at' => time() + max(1, $ttlSeconds),
            'payload'    => $value,
        ];

        $tmpFile = $filePath . '.' . uniqid('tmp_', true);
        if (@file_put_contents($tmpFile, serialize($data), LOCK_EX) === false) {
            return false;
        }

        return @rename($tmpFile, $filePath);
    }

    public function has(string $key): bool {
        return $this->get($key, '__NOT_FOUND__') !== '__NOT_FOUND__';
    }

    public function delete(string $key): bool {
        $filePath = $this->getFilePath($key);
        if (file_exists($filePath)) {
            return @unlink($filePath);
        }
        return true;
    }

    public function clear(): bool {
        $files = glob($this->cacheDir . '/*.cache');
        if ($files) {
            foreach ($files as $file) {
                @unlink($file);
            }
        }
        return true;
    }

    public function remember(string $key, int $ttlSeconds, callable $callback) {
        $value = $this->get($key);
        if ($value !== null) {
            return $value;
        }

        $value = $callback();
        $this->set($key, $value, $ttlSeconds);
        return $value;
    }
}

