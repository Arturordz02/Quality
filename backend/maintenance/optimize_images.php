<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Mantenimiento: Optimización y Conversión de Imágenes a WebP
 * Reduce radicalmente el payload del frontend convirtiendo JPG y PNG a WebP de alta fidelidad.
 */

define('QCS_BACKEND_ACCESS', true);

// Bloquear acceso HTTP directo de forma incondicional (Solo ejecución vía CLI)
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'status'  => 403,
        'message' => 'Acceso denegado. Este script solo puede ser ejecutado mediante línea de comandos (CLI).'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit(1);
}

class ImageOptimizer {
    private string $imgDir;
    private int $quality;

    public function __construct(string $imgDir, int $quality = 82) {
        $this->imgDir = rtrim($imgDir, '/\\');
        $this->quality = $quality;
    }

    public function optimizeAll(): array {
        $results = [
            'converted' => [],
            'skipped'   => [],
            'excluded'  => [],
            'errors'    => [],
            'total_original_bytes' => 0,
            'total_webp_bytes'     => 0,
        ];

        if (!function_exists('imagewebp')) {
            $results['errors'][] = 'La extensión PHP GD no tiene soporte nativo para WebP.';
            return $results;
        }

        $files = glob($this->imgDir . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
        if (!$files) {
            return $results;
        }

        foreach ($files as $file) {
            $baseName = basename($file);

            // Exclusión explícita del logotipo corporativo: Logo.png y Logo.jpg nunca deben generar ni sobrescribir Logo.webp
            if (in_array(strtolower($baseName), ['logo.png', 'logo.jpg', 'logo.jpeg'], true)) {
                $results['excluded'][] = $baseName;
                continue;
            }

            $pathInfo = pathinfo($file);
            $webpTarget = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';

            // Salvaguarda adicional por archivo de destino
            if (strtolower(basename($webpTarget)) === 'logo.webp') {
                $results['excluded'][] = $baseName;
                continue;
            }

            $origSize = filesize($file);
            $results['total_original_bytes'] += $origSize;

            // Si ya existe el WebP y es más reciente, omitir
            if (file_exists($webpTarget) && filemtime($webpTarget) >= filemtime($file)) {
                $webpSize = filesize($webpTarget);
                $results['total_webp_bytes'] += $webpSize;
                $results['skipped'][] = basename($file);
                continue;
            }

            $converted = $this->convertToWebp($file, $webpTarget);
            if ($converted) {
                $webpSize = filesize($webpTarget);
                $results['total_webp_bytes'] += $webpSize;
                $savingsPct = round((1 - ($webpSize / max(1, $origSize))) * 100, 1);
                $results['converted'][] = [
                    'file' => basename($file),
                    'orig_kb' => round($origSize / 1024, 1),
                    'webp_kb' => round($webpSize / 1024, 1),
                    'savings_percent' => $savingsPct . '%',
                ];
            } else {
                $results['errors'][] = basename($file);
                $results['total_webp_bytes'] += $origSize;
            }
        }

        return $results;
    }

    private function convertToWebp(string $source, string $target): bool {
        $raw = @file_get_contents($source);
        if (!$raw) return false;

        $image = @imagecreatefromstring($raw);
        if (!$image) {
            return false;
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        $success = @imagewebp($image, $target, $this->quality);
        imagedestroy($image);
        return (bool)$success;
    }
}

// Ejecución CLI directa
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    $imgDir = __DIR__ . '/../../img';
    $optimizer = new ImageOptimizer($imgDir, 80);
    echo "=== Optimización de Imágenes QCS -> WebP ===\n";
    $report = $optimizer->optimizeAll();

    echo "Imágenes convertidas: " . count($report['converted']) . "\n";
    foreach ($report['converted'] as $c) {
        echo "  - {$c['file']}: {$c['orig_kb']} KB -> {$c['webp_kb']} KB (Ahorro: {$c['savings_percent']})\n";
    }
    echo "Imágenes omitidas (ya optimizadas): " . count($report['skipped']) . "\n";
    if (!empty($report['excluded'])) {
        echo "Imágenes excluidas explícitamente: " . count($report['excluded']) . " (" . implode(', ', $report['excluded']) . ")\n";
    }
    if (!empty($report['errors'])) {
        echo "Errores: " . implode(', ', $report['errors']) . "\n";
    }

    $origMb = round($report['total_original_bytes'] / (1024 * 1024), 2);
    $webpMb = round($report['total_webp_bytes'] / (1024 * 1024), 2);
    $totalSavings = round((1 - ($report['total_webp_bytes'] / max(1, $report['total_original_bytes']))) * 100, 1);
    echo "\nTamaño original: {$origMb} MB | Tamaño WebP estimado: {$webpMb} MB\n";
    echo "Ahorro total de ancho de banda: {$totalSavings}%\n";
}
