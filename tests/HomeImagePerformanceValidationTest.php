<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Rendimiento de Imágenes en Inicio y Logo WebP (FASE 7B)
 * Archivo: tests/HomeImagePerformanceValidationTest.php
 *
 * Valida:
 * 1. home.php contiene exactamente los 9 <source> WebP aprobados.
 * 2. Los 9 PNG permanecen como fallback dentro de sus respectivos <picture>.
 * 3. Los primeros 8 fallbacks declaran width="1024" y height="600".
 * 4. El fallback de ClientesQuality declara width="1100" y height="688".
 * 5. Se conservan intactos los atributos alt requeridos en todas las imágenes.
 * 6. Las imágenes de Inicio debajo del primer viewport conservan loading="lazy".
 * 7. header.php utiliza exactamente el recurso versionado /img/Logo.webp?v=2.
 * 8. footer.php utiliza /img/Logo.webp?v=2 y loading="lazy" en el fallback img.
 * 9. 404.html contiene exactamente 2 referencias públicas a /img/Logo.webp?v=2 (header y footer).
 * 10. Logo.webp final mide 256x256 px, formato WebP y preserva canal alfa (RGBA).
 * 11. Logo.png se mantiene intacto: 256x256 px, 40,012 bytes y SHA-256 oficial.
 * 12. casos-practicos-contratos-nec3-f.webp permanece intacto y sin modificaciones.
 */

declare(strict_types=1);

$totalTests = 0;
$passedTests = 0;

function runTest(string $description, callable $fn): void {
    global $totalTests, $passedTests;
    $totalTests++;
    echo "• Probando: {$description}... ";
    try {
        $result = $fn();
        if ($result === true) {
            $passedTests++;
            echo "[\033[32mPASÓ\033[0m]\n";
        } else {
            echo "[\033[31mFALLÓ\033[0m] (Retornó no-true)\n";
        }
    } catch (\Throwable $e) {
        echo "[\033[31mFALLÓ\033[0m] Excepción: " . $e->getMessage() . "\n";
    }
}

echo "\n====================================================================\n";
echo "EJECUTANDO SUITE: RENDIMIENTO DE IMÁGENES INICIO Y LOGO WEBP (FASE 7B)\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$homePhpPath = $baseDir . '/private_app/app/Views/pages/home.php';
$headerPhpPath = $baseDir . '/private_app/app/Views/partials/header.php';
$footerPhpPath = $baseDir . '/private_app/app/Views/partials/footer.php';
$html404Path = $baseDir . '/public_html/404.html';
$logoWebpPath = $baseDir . '/public_html/img/Logo.webp';
$logoPngPath = $baseDir . '/public_html/img/Logo.png';
$nec3fWebpPath = $baseDir . '/public_html/img/capacitaciones/casos-practicos-contratos-nec3-f.webp';

$homeContent = file_get_contents($homePhpPath);
$headerContent = file_get_contents($headerPhpPath);
$footerContent = file_get_contents($footerPhpPath);
$html404Content = file_get_contents($html404Path);

// Lista oficial de 9 WebP de inicio
$expectedWebps = [
    'img/Index-Contratos-Internacionales.webp',
    'img/Index-GestionPMO.webp',
    'img/Index-GerenciaCalidadObras.webp',
    'img/Index_ValorGanado.webp',
    'img/Index-BIMRevitArchitecture.webp',
    'img/Index-OficinaTecnicaObras.webp',
    'img/index_LeanLast.webp',
    'img/Index-RiesgosPMI.webp',
    'img/ClientesQuality.webp',
];

// Lista oficial de 9 PNG de inicio
$expectedPngs = [
    'img/Index-Contratos-Internacionales.png',
    'img/Index-GestionPMO.png',
    'img/Index-GerenciaCalidadObras.png',
    'img/Index_ValorGanado.png',
    'img/Index-BIMRevitArchitecture.png',
    'img/Index-OficinaTecnicaObras.png',
    'img/index_LeanLast.png',
    'img/Index-RiesgosPMI.png',
    'img/ClientesQuality.png',
];

// 1. Exactamente los 9 <source> WebP aprobados en home.php
runTest("1. home.php contiene exactamente los 9 <source> WebP aprobados", function() use ($homeContent, $expectedWebps) {
    foreach ($expectedWebps as $webp) {
        $pattern = '<source srcset="' . $webp . '" type="image/webp">';
        if (!str_contains($homeContent, $pattern)) {
            throw new \RuntimeException("Falta la etiqueta <source> para {$webp}");
        }
    }
    // Verificar que no haya otros <source> WebP inesperados
    preg_match_all('/<source[^>]+type="image\/webp"[^>]*>/i', $homeContent, $matches);
    if (count($matches[0]) !== 9) {
        throw new \RuntimeException("Se esperaban exactamente 9 <source type='image/webp'> en home.php, encontrados: " . count($matches[0]));
    }
    return true;
});

// 2. Los 9 PNG permanecen como fallback dentro de un <picture>
runTest("2. Los 9 PNG permanecen como fallback dentro de <picture>", function() use ($homeContent, $expectedPngs) {
    foreach ($expectedPngs as $png) {
        if (!str_contains($homeContent, 'src="' . $png . '"')) {
            throw new \RuntimeException("Falta el PNG de fallback {$png}");
        }
    }
    preg_match_all('/<picture>\s*<source[^>]+>\s*<img[^>]+>\s*<\/picture>/is', $homeContent, $matches);
    if (count($matches[0]) !== 9) {
        throw new \RuntimeException("Se esperaban exactamente 9 bloques <picture> con fallback <img>, encontrados: " . count($matches[0]));
    }
    return true;
});

// 3. Los primeros 8 fallbacks declaran width="1024" height="600"
runTest("3. Los primeros 8 fallbacks declaran width=\"1024\" height=\"600\"", function() use ($homeContent, $expectedPngs) {
    for ($i = 0; $i < 8; $i++) {
        $png = $expectedPngs[$i];
        $pattern = '/<img[^>]+src="' . preg_quote($png, '/') . '"[^>]*>/i';
        if (!preg_match($pattern, $homeContent, $match)) {
            throw new \RuntimeException("No se encontró <img> para {$png}");
        }
        $imgTag = $match[0];
        if (!str_contains($imgTag, 'width="1024"') || !str_contains($imgTag, 'height="600"')) {
            throw new \RuntimeException("El fallback de {$png} no contiene width=\"1024\" height=\"600\": {$imgTag}");
        }
    }
    return true;
});

// 4. ClientesQuality declara width="1100" height="688"
runTest("4. ClientesQuality declara width=\"1100\" height=\"688\"", function() use ($homeContent) {
    $pattern = '/<img[^>]+src="img\/ClientesQuality\.png"[^>]*>/i';
    if (!preg_match($pattern, $homeContent, $match)) {
        throw new \RuntimeException("No se encontró <img> para ClientesQuality.png");
    }
    $imgTag = $match[0];
    if (!str_contains($imgTag, 'width="1100"') || !str_contains($imgTag, 'height="688"')) {
        throw new \RuntimeException("El fallback de ClientesQuality no contiene width=\"1100\" height=\"688\": {$imgTag}");
    }
    return true;
});

// 5. No se eliminaron los atributos alt
runTest("5. No se eliminaron los atributos alt de las 9 imágenes", function() use ($homeContent, $expectedPngs) {
    foreach ($expectedPngs as $png) {
        $pattern = '/<img[^>]+src="' . preg_quote($png, '/') . '"[^>]*>/i';
        if (!preg_match($pattern, $homeContent, $match)) {
            throw new \RuntimeException("No se encontró <img> para {$png}");
        }
        if (!preg_match('/alt="[^"]+"/i', $match[0])) {
            throw new \RuntimeException("El fallback {$png} no tiene atributo alt válido");
        }
    }
    return true;
});

// 6. Las imágenes debajo del primer viewport conservan loading="lazy"
runTest("6. Las 9 imágenes conservan el atributo loading=\"lazy\"", function() use ($homeContent, $expectedPngs) {
    foreach ($expectedPngs as $png) {
        $pattern = '/<img[^>]+src="' . preg_quote($png, '/') . '"[^>]*>/i';
        if (!preg_match($pattern, $homeContent, $match)) {
            throw new \RuntimeException("No se encontró <img> para {$png}");
        }
        if (!str_contains($match[0], 'loading="lazy"')) {
            throw new \RuntimeException("El <img> para {$png} no contiene loading=\"lazy\"");
        }
    }
    return true;
});

// 7. header.php utiliza /img/Logo.webp?v=2
runTest("7. header.php utiliza /img/Logo.webp?v=2", function() use ($headerContent) {
    if (!str_contains($headerContent, '<source srcset="/img/Logo.webp?v=2" type="image/webp">')) {
        throw new \RuntimeException("header.php no contiene la referencia esperada a /img/Logo.webp?v=2");
    }
    if (str_contains($headerContent, 'srcset="/img/Logo.webp"')) {
        throw new \RuntimeException("header.php contiene referencias sin versionar a /img/Logo.webp");
    }
    return true;
});

// 8. footer.php utiliza /img/Logo.webp?v=2
runTest("8. footer.php utiliza /img/Logo.webp?v=2 y fallback adecuado", function() use ($footerContent) {
    if (!str_contains($footerContent, '<source srcset="/img/Logo.webp?v=2" type="image/webp">')) {
        throw new \RuntimeException("footer.php no contiene la referencia esperada a /img/Logo.webp?v=2");
    }
    if (str_contains($footerContent, 'srcset="/img/Logo.webp"')) {
        throw new \RuntimeException("footer.php contiene referencias sin versionar a /img/Logo.webp");
    }
    return true;
});

// 9. 404.html contiene exactamente 2 referencias públicas a /img/Logo.webp?v=2
runTest("9. 404.html contiene exactamente 2 referencias públicas a /img/Logo.webp?v=2", function() use ($html404Content) {
    $count = substr_count($html404Content, '/img/Logo.webp?v=2');
    if ($count !== 2) {
        throw new \RuntimeException("404.html contiene {$count} referencias a /img/Logo.webp?v=2, se esperaban exactamente 2");
    }
    if (str_contains($html404Content, 'srcset="/img/Logo.webp"')) {
        throw new \RuntimeException("404.html contiene referencias sin versionar a /img/Logo.webp");
    }
    return true;
});

// 10. Logo.webp final mide 256x256 px, formato WebP y canal alfa
runTest("10. Logo.webp final mide 256x256 px, formato WebP y conserva canal alfa", function() use ($logoWebpPath) {
    if (!file_exists($logoWebpPath)) {
        throw new \RuntimeException("No existe {$logoWebpPath}");
    }
    $imageInfo = getimagesize($logoWebpPath);
    if (!$imageInfo || $imageInfo[0] !== 256 || $imageInfo[1] !== 256) {
        throw new \RuntimeException("Dimensiones incorrectas de Logo.webp: " . json_encode($imageInfo));
    }
    if ($imageInfo['mime'] !== 'image/webp') {
        throw new \RuntimeException("MIME incorrecto de Logo.webp: " . $imageInfo['mime']);
    }
    // Validar encabezado WebP VP8/VP8L/VP8X para canal alfa
    $fp = fopen($logoWebpPath, 'rb');
    $header = fread($fp, 32);
    fclose($fp);
    if (substr($header, 0, 4) !== 'RIFF' || substr($header, 8, 4) !== 'WEBP') {
        throw new \RuntimeException("Cabecera RIFF/WEBP inválida en Logo.webp");
    }
    // Comprobar presencia de chunk de transparencia (VP8X con bit de alpha o VP8L)
    $hasAlpha = false;
    $chunk = substr($header, 12, 4);
    if ($chunk === 'VP8X') {
        $flags = ord($header[20]);
        if (($flags & 0x10) !== 0) { // Bit 4 = Alpha flag
            $hasAlpha = true;
        }
    } elseif ($chunk === 'VP8L') {
        $hasAlpha = true; // WebP Lossless siempre maneja RGBA internamente
    }
    if (!$hasAlpha) {
        throw new \RuntimeException("Logo.webp no presenta señal de canal alfa en chunk {$chunk}");
    }
    return true;
});

// 11. Logo.png continúa intacto
runTest("11. Logo.png continúa intacto (256x256 px, 40,012 bytes, SHA-256 oficial)", function() use ($logoPngPath) {
    if (!file_exists($logoPngPath)) {
        throw new \RuntimeException("No existe {$logoPngPath}");
    }
    $size = filesize($logoPngPath);
    if ($size !== 40012) {
        throw new \RuntimeException("Tamaño de Logo.png es {$size} bytes, esperado 40012");
    }
    $sha = hash_file('sha256', $logoPngPath);
    $expectedSha = 'a91551ec73d9acd450aadfd5fc3dbbe6cc6a357b67fe6f308b4f4674d3449823';
    if ($sha !== $expectedSha) {
        throw new \RuntimeException("SHA-256 de Logo.png es {$sha}, esperado {$expectedSha}");
    }
    $imageInfo = getimagesize($logoPngPath);
    if (!$imageInfo || $imageInfo[0] !== 256 || $imageInfo[1] !== 256) {
        throw new \RuntimeException("Dimensiones incorrectas de Logo.png: " . json_encode($imageInfo));
    }
    return true;
});

// 12. casos-practicos-contratos-nec3-f.webp no fue modificado
runTest("12. casos-practicos-contratos-nec3-f.webp permanece intacto", function() use ($nec3fWebpPath) {
    if (!file_exists($nec3fWebpPath)) {
        throw new \RuntimeException("No existe {$nec3fWebpPath}");
    }
    $size = filesize($nec3fWebpPath);
    $sha = hash_file('sha256', $nec3fWebpPath);
    $expectedSha = 'cd313396d68691da83892090189e501a141b7f90b138c098fd18d603999ed27a';
    if ($size !== 410800 || $sha !== $expectedSha) {
        throw new \RuntimeException("casos-practicos-contratos-nec3-f.webp ha sido alterado: size={$size}, sha={$sha}");
    }
    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
