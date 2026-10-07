<?php
/**
 * QUALITY CONSULTING SOLUTIONS - PREVIEW STATIC GENERATOR
 * Compila las vistas del sistema MVC a archivos estáticos HTML para GitHub Pages.
 * 
 * Este generador permite que el repositorio se previsualice en GitHub Pages
 * sin alterar la estructura MVC de GoDaddy en producción.
 */

declare(strict_types=1);

$baseDir = __DIR__;
$privateAppDir = $baseDir . '/private_app';
$publicHtmlDir = $baseDir . '/public_html';
$outputDir = $baseDir . '/_site';

// Limpiar y preparar directorio de salida
if (is_dir($outputDir)) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($outputDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $fileinfo) {
        $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        $todo($fileinfo->getRealPath());
    }
} else {
    mkdir($outputDir, 0777, true);
}

// 1. Copiar assets estáticos (CSS, JS, Imágenes, Favicon, etc.)
function copyDirectory(string $src, string $dst): void {
    $dir = opendir($src);
    @mkdir($dst, 0777, true);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                if ($file !== 'backend') { // Evitar scripts de backend en estático
                    copyDirectory($src . '/' . $file, $dst . '/' . $file);
                }
            } else {
                if (!str_ends_with($file, '.php') && !str_ends_with($file, '.htaccess')) {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
    }
    closedir($dir);
}

echo "--> Copiando assets estáticos desde public_html...\n";
copyDirectory($publicHtmlDir, $outputDir);

// Crear archivo .nojekyll en el output
file_put_contents($outputDir . '/.nojekyll', '');

// 2. Cargar aplicación MVC
$config = require $privateAppDir . '/config/app.php';
$router = new \App\Core\Router($config);
$routesLoader = require $privateAppDir . '/config/routes.php';
$routesLoader($router, $config);

// Obtener todas las vistas disponibles en pages/
$pagesDir = $privateAppDir . '/app/Views/pages';
$pageFiles = glob($pagesDir . '/*.php');

$viewEngine = new \App\Core\View($privateAppDir . '/app/Views');
$viewEngine->share('siteName', 'Quality Consulting Solutions');
$viewEngine->share('currentYear', date('Y'));

echo "--> Compilando vistas a HTML...\n";

foreach ($pageFiles as $pageFile) {
    $pageName = basename($pageFile, '.php');
    if ($pageName === '.gitkeep') continue;

    $viewPath = 'pages/' . $pageName;
    $targetFile = ($pageName === 'home') ? $outputDir . '/index.html' : $outputDir . '/' . $pageName . '.html';
    
    // Variables por defecto para cada página
    $title = ucwords(str_replace('-', ' ', $pageName)) . ' | Quality Consulting Solutions';
    $data = [
        'title'        => $title,
        'canonicalUrl' => 'https://quality-consulting.org/' . ($pageName === 'home' ? '' : $pageName),
    ];

    try {
        $html = $viewEngine->render($viewPath, $data, 'main');
        
        // Ajustar enlaces relativos si es necesario para GitHub Pages (ej: href="/nosotros" o href="nosotros.html")
        // Reemplazar href="/ruta" por "ruta.html" y href="/" por "index.html" para navegación estática perfecta
        $htmlTransformed = preg_replace_callback('/href="\/([a-zA-Z0-9\-_]+)"/', function($matches) {
            return 'href="' . $matches[1] . '.html"';
        }, $html);
        $htmlTransformed = preg_replace('/href="\/"/', 'href="index.html"', $htmlTransformed);
        
        file_put_contents($targetFile, $htmlTransformed);

        // Si no es home, también crear carpeta con index.html para URLs limpias (ej: /nosotros/)
        if ($pageName !== 'home' && $pageName !== '404') {
            $subDir = $outputDir . '/' . $pageName;
            if (!is_dir($subDir)) {
                mkdir($subDir, 0777, true);
            }
            file_put_contents($subDir . '/index.html', $htmlTransformed);
        }

        echo "  [OK] Generado: {$pageName}\n";
    } catch (\Throwable $e) {
        echo "  [ERROR] Falló {$pageName}: " . $e->getMessage() . "\n";
    }
}

// Asegurar 404.html en la raíz de output
if (file_exists($publicHtmlDir . '/404.html') && !file_exists($outputDir . '/404.html')) {
    copy($publicHtmlDir . '/404.html', $outputDir . '/404.html');
}

echo "\n¡Generación estática completada exitosamente en {$outputDir}!\n";
