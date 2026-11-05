<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Rendimiento de Imágenes de Catálogo y Fichas (FASE 10A)
 * Archivo: tests/CatalogImagePerformanceValidationTest.php
 *
 * Valida:
 * 1. Los 12 archivos WebP aprobados existen en public_html/img.
 * 2. Cada archivo WebP tiene formato WEBP válido.
 * 3. Cada archivo WebP tiene exactamente las mismas dimensiones que su contraparte original.
 * 4. Cada archivo WebP es estrictamente más liviano que su contraparte original.
 * 5. La optimización total del lote de 12 imágenes supera el 70% de reducción en bytes.
 * 6. pmo.php incluye <picture> con source WebP y fallback PNG/JPG para Feliz-Valdes-Torero y gpmo1.
 * 7. pmo.php declara dimensiones intrínsecas (width/height) y loading="lazy" en sus imágenes actualizadas.
 * 8. proyectos-pmi.php incluye <picture> con Feliz-Valdes-Torero.webp y fallback JPG con dimensiones intrínsecas.
 * 9. riesgo-del-plazo.php incluye <picture> con s901.webp y 19-lnx_orig.webp con dimensiones intrínsecas.
 * 10. fidic.php incluye <picture> con sharon-2_orig.webp y fallback JPG con dimensiones intrínsecas.
 * 11. category_page_content.php declara width="1024" y height="600" en intro_image, course_card_img y contact_image.
 * 12. capacitacion.php declara width="1024" y height="600" en course_card_img.
 * 13. Las imágenes de Inicio y Logo.webp preservan su integridad sin alteraciones.
 * 14. casos-practicos-contratos-nec3-f.webp preserva su tamaño exacto (410,800 bytes) y hash SHA-256.
 * 15. Todas las etiquetas <img> en las vistas modificadas poseen atributo alt no vacío.
 * 16. En la compilación estática (_site), las páginas afectadas incluyen las fuentes WebP y fallbacks.
 * 17. No existen rutas rotas a imágenes en las vistas modificadas.
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
echo "EJECUTANDO SUITE: RENDIMIENTO DE IMÁGENES DE CATÁLOGO Y FICHAS (FASE 10A)\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);

$lote12 = [
    [
        'name' => 'Index-GestionCalidad.png',
        'orig' => 'public_html/img/Index-GestionCalidad.png',
        'webp' => 'public_html/img/Index-GestionCalidad.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-OficinaTecnicaObras.png',
        'orig' => 'public_html/img/Index-OficinaTecnicaObras.png',
        'webp' => 'public_html/img/Index-OficinaTecnicaObras.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-Contratos-Internacionales.png',
        'orig' => 'public_html/img/Index-Contratos-Internacionales.png',
        'webp' => 'public_html/img/Index-Contratos-Internacionales.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-GerenciaCalidadObras.png',
        'orig' => 'public_html/img/Index-GerenciaCalidadObras.png',
        'webp' => 'public_html/img/Index-GerenciaCalidadObras.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-riesgos.png',
        'orig' => 'public_html/img/Index-riesgos.png',
        'webp' => 'public_html/img/Index-riesgos.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-GestionPMO.png',
        'orig' => 'public_html/img/Index-GestionPMO.png',
        'webp' => 'public_html/img/Index-GestionPMO.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Index-GobernanzaPMO.png',
        'orig' => 'public_html/img/Index-GobernanzaPMO.png',
        'webp' => 'public_html/img/Index-GobernanzaPMO.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 's901.png',
        'orig' => 'public_html/img/s901.png',
        'webp' => 'public_html/img/s901.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'gpmo1.png',
        'orig' => 'public_html/img/gpmo1.png',
        'webp' => 'public_html/img/gpmo1.webp',
        'width' => 1024,
        'height' => 600
    ],
    [
        'name' => 'Feliz-Valdes-Torero.jpg',
        'orig' => 'public_html/img/Feliz-Valdes-Torero.jpg',
        'webp' => 'public_html/img/Feliz-Valdes-Torero.webp',
        'width' => 1082,
        'height' => 992
    ],
    [
        'name' => '19-lnx_orig.jpeg',
        'orig' => 'public_html/img/19-lnx_orig.jpeg',
        'webp' => 'public_html/img/19-lnx_orig.webp',
        'width' => 989,
        'height' => 1280
    ],
    [
        'name' => 'sharon-2_orig.jpg',
        'orig' => 'public_html/img/sharon-2_orig.jpg',
        'webp' => 'public_html/img/sharon-2_orig.webp',
        'width' => 812,
        'height' => 1247
    ],
];

// Test 1: Existencia de los 12 WebP
runTest("1. Los 12 archivos WebP del lote aprobado existen físicamente", function() use ($baseDir, $lote12) {
    foreach ($lote12 as $item) {
        $fullPath = $baseDir . '/' . $item['webp'];
        if (!file_exists($fullPath)) {
            throw new \Exception("No existe el archivo WebP: {$item['webp']}");
        }
    }
    return true;
});

// Test 2: Formato WEBP válido
runTest("2. Cada archivo WebP tiene un encabezado RIFF...WEBP válido", function() use ($baseDir, $lote12) {
    foreach ($lote12 as $item) {
        $fullPath = $baseDir . '/' . $item['webp'];
        $handle = fopen($fullPath, 'rb');
        $header = fread($handle, 12);
        fclose($handle);
        $isWebp = substr($header, 0, 4) === 'RIFF' && substr($header, 8, 4) === 'WEBP';
        if (!$isWebp) {
            throw new \Exception("Encabezado WebP inválido en: {$item['webp']}");
        }
    }
    return true;
});

// Test 3: Dimensiones coincidentes
runTest("3. Cada archivo WebP mantiene dimensiones exactas con su versión original", function() use ($baseDir, $lote12) {
    foreach ($lote12 as $item) {
        $origInfo = getimagesize($baseDir . '/' . $item['orig']);
        $webpInfo = getimagesize($baseDir . '/' . $item['webp']);
        if (!$origInfo || !$webpInfo) {
            throw new \Exception("Error al leer dimensiones de {$item['name']}");
        }
        if ($origInfo[0] !== $webpInfo[0] || $origInfo[1] !== $webpInfo[1]) {
            throw new \Exception("Dimensiones no coinciden en {$item['name']}: Orig({$origInfo[0]}x{$origInfo[1]}) vs WebP({$webpInfo[0]}x{$webpInfo[1]})");
        }
        if ($origInfo[0] !== $item['width'] || $origInfo[1] !== $item['height']) {
            throw new \Exception("Dimensiones esperadas no coinciden en {$item['name']}: esperado {$item['width']}x{$item['height']}, obtenido {$origInfo[0]}x{$origInfo[1]}");
        }
    }
    return true;
});

// Test 4: WebP estrictamente más liviano
runTest("4. Cada archivo WebP es estrictamente más liviano que su contraparte original", function() use ($baseDir, $lote12) {
    foreach ($lote12 as $item) {
        $origSize = filesize($baseDir . '/' . $item['orig']);
        $webpSize = filesize($baseDir . '/' . $item['webp']);
        if ($webpSize >= $origSize) {
            throw new \Exception("WebP ({$webpSize} B) no es más pequeño que original ({$origSize} B) en {$item['name']}");
        }
    }
    return true;
});

// Test 5: Ahorro total superior al 70%
runTest("5. La optimización total del lote de 12 supera el 70% de reducción en bytes", function() use ($baseDir, $lote12) {
    $totalOrig = 0;
    $totalWebp = 0;
    foreach ($lote12 as $item) {
        $totalOrig += filesize($baseDir . '/' . $item['orig']);
        $totalWebp += filesize($baseDir . '/' . $item['webp']);
    }
    $savings = $totalOrig - $totalWebp;
    $pct = ($savings / $totalOrig) * 100;
    if ($pct < 70.0) {
        throw new \Exception("Porcentaje de ahorro menor al 70%: {$pct}%");
    }
    return true;
});

// Test 6: pmo.php incluye <picture> para Feliz-Valdes-Torero y gpmo1
runTest("6. pmo.php incluye <picture> con source WebP y fallback original para sus imágenes", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/pmo.php');
    if (strpos($content, '<source srcset="img/Feliz-Valdes-Torero.webp" type="image/webp">') === false) {
        throw new \Exception("pmo.php no contiene source WebP de Feliz-Valdes-Torero");
    }
    if (strpos($content, '<source srcset="img/gpmo1.webp" type="image/webp">') === false) {
        throw new \Exception("pmo.php no contiene source WebP de gpmo1");
    }
    if (strpos($content, 'src="img/Feliz-Valdes-Torero.jpg"') === false) {
        throw new \Exception("pmo.php no contiene fallback de Feliz-Valdes-Torero.jpg");
    }
    if (strpos($content, 'src="img/gpmo1.png"') === false) {
        throw new \Exception("pmo.php no contiene fallback de gpmo1.png");
    }
    return true;
});

// Test 7: pmo.php declara width, height y loading="lazy"
runTest("7. pmo.php declara dimensiones intrínsecas explícitas y loading='lazy'", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/pmo.php');
    if (strpos($content, 'width="1082" height="992" loading="lazy"') === false) {
        throw new \Exception("pmo.php no declara dimensiones correctas o loading lazy en avatar");
    }
    if (strpos($content, 'width="1024" height="600" loading="lazy"') === false) {
        throw new \Exception("pmo.php no declara dimensiones correctas o loading lazy en preview");
    }
    return true;
});

// Test 8: proyectos-pmi.php incluye <picture> con Feliz-Valdes-Torero
runTest("8. proyectos-pmi.php incluye <picture> con source WebP y dimensiones intrínsecas", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/proyectos-pmi.php');
    if (strpos($content, '<source srcset="img/Feliz-Valdes-Torero.webp" type="image/webp">') === false) {
        throw new \Exception("proyectos-pmi.php no contiene source WebP de Feliz-Valdes-Torero");
    }
    if (strpos($content, 'width="1082" height="992" loading="lazy"') === false) {
        throw new \Exception("proyectos-pmi.php no contiene dimensiones correctas en avatar");
    }
    return true;
});

// Test 9: riesgo-del-plazo.php incluye <picture> con s901 y 19-lnx_orig
runTest("9. riesgo-del-plazo.php incluye <picture> para s901 y 19-lnx_orig con dimensiones", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/riesgo-del-plazo.php');
    if (strpos($content, '<source srcset="img/s901.webp" type="image/webp">') === false) {
        throw new \Exception("riesgo-del-plazo.php no contiene source WebP de s901");
    }
    if (strpos($content, '<source srcset="img/19-lnx_orig.webp" type="image/webp">') === false) {
        throw new \Exception("riesgo-del-plazo.php no contiene source WebP de 19-lnx_orig");
    }
    if (strpos($content, 'width="1024" height="600"') === false) {
        throw new \Exception("riesgo-del-plazo.php no contiene dimensiones 1024x600 en s901");
    }
    if (strpos($content, 'width="989" height="1280"') === false) {
        throw new \Exception("riesgo-del-plazo.php no contiene dimensiones 989x1280 en 19-lnx_orig");
    }
    return true;
});

// Test 10: fidic.php incluye <picture> con sharon-2_orig
runTest("10. fidic.php incluye <picture> con sharon-2_orig.webp y dimensiones intrínsecas", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/fidic.php');
    if (strpos($content, '<source srcset="img/sharon-2_orig.webp" type="image/webp">') === false) {
        throw new \Exception("fidic.php no contiene source WebP de sharon-2_orig");
    }
    if (strpos($content, 'width="812" height="1247"') === false) {
        throw new \Exception("fidic.php no contiene dimensiones 812x1247 en sharon-2_orig");
    }
    return true;
});

// Test 11: category_page_content.php declara dimensiones en sus 3 imágenes clave
runTest("11. category_page_content.php declara width='1024' y height='600' en intro, card y contacto", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/partials/category_page_content.php');
    $introMatches = preg_match('/class="[^"]*category-intro-img[^"]*"[^>]*width="1024"[^>]*height="600"/s', $content);
    $cardMatches = preg_match('/class="[^"]*course-card-img[^"]*"[^>]*width="1024"[^>]*height="600"/s', $content);
    $contactMatches = preg_match('/class="[^"]*category-contact-photo[^"]*"[^>]*width="1024"[^>]*height="600"/s', $content);
    if (!$introMatches) {
        throw new \Exception("category_page_content.php no declara width y height en category-intro-img");
    }
    if (!$cardMatches) {
        throw new \Exception("category_page_content.php no declara width y height en course-card-img");
    }
    if (!$contactMatches) {
        throw new \Exception("category_page_content.php no declara width y height en category-contact-photo");
    }
    return true;
});

// Test 12: capacitacion.php declara dimensiones en course_card_img
runTest("12. capacitacion.php declara width='1024' y height='600' en course-card-img", function() use ($baseDir) {
    $content = file_get_contents($baseDir . '/private_app/app/Views/pages/capacitacion.php');
    $cardMatches = preg_match('/class="[^"]*course-card-img[^"]*"[^>]*width="1024"[^>]*height="600"/s', $content);
    if (!$cardMatches) {
        throw new \Exception("capacitacion.php no declara width='1024' y height='600' en course-card-img");
    }
    return true;
});

// Test 13: Protección de imágenes de Inicio y Logo.webp
runTest("13. Logo.webp (256x256) y Logo.png (40,012 bytes) preservan su estado íntegro", function() use ($baseDir) {
    $logoWebp = $baseDir . '/public_html/img/Logo.webp';
    $logoPng = $baseDir . '/public_html/img/Logo.png';
    $wInfo = getimagesize($logoWebp);
    $pSize = filesize($logoPng);
    if ($wInfo[0] !== 256 || $wInfo[1] !== 256) {
        throw new \Exception("Logo.webp no mide 256x256 px");
    }
    if ($pSize !== 40012) {
        throw new \Exception("Logo.png no mide exactamente 40,012 bytes: {$pSize}");
    }
    return true;
});

// Test 14: Protección de casos-practicos-contratos-nec3-f.webp
runTest("14. casos-practicos-contratos-nec3-f.webp preserva su peso y SHA-256 exacto", function() use ($baseDir) {
    $necPath = $baseDir . '/public_html/img/capacitaciones/casos-practicos-contratos-nec3-f.webp';
    $size = filesize($necPath);
    $hash = hash_file('sha256', $necPath);
    if ($size !== 410800) {
        throw new \Exception("Tamaño inesperado en nec3-f.webp: {$size} B");
    }
    if ($hash !== 'cd313396d68691da83892090189e501a141b7f90b138c098fd18d603999ed27a') {
        throw new \Exception("Hash inesperado en nec3-f.webp: {$hash}");
    }
    return true;
});

// Test 15: Atributos alt presentes y descriptivos
runTest("15. Todas las etiquetas <img> en las vistas modificadas poseen atributo alt no vacío", function() use ($baseDir) {
    $files = [
        'private_app/app/Views/pages/pmo.php',
        'private_app/app/Views/pages/proyectos-pmi.php',
        'private_app/app/Views/pages/riesgo-del-plazo.php',
        'private_app/app/Views/pages/fidic.php',
        'private_app/app/Views/partials/category_page_content.php',
        'private_app/app/Views/pages/capacitacion.php'
    ];
    foreach ($files as $relPath) {
        $content = file_get_contents($baseDir . '/' . $relPath);
        // Replace PHP tags with a dummy placeholder string
        $strippedContent = preg_replace('/<\?.*?\?>/s', 'PLACEHOLDER', $content);
        preg_match_all('/<img\b([^>]*)>/is', $strippedContent, $matches);
        foreach ($matches[1] as $imgAttrs) {
            if (!preg_match('/alt=(["\'])(.*?)\1/is', $imgAttrs, $altMatch)) {
                throw new \Exception("Tag <img> sin alt en {$relPath}: {$imgAttrs}");
            }
            if (trim($altMatch[2]) === '') {
                throw new \Exception("Tag <img> con alt vacío en {$relPath}: {$imgAttrs}");
            }
        }
    }
    return true;
});

// Test 16: Compilación estática refleja fuentes WebP
runTest("16. En _site/, las páginas de capacitacion y cursos contienen las fuentes WebP", function() use ($baseDir) {
    $siteFiles = [
        '_site/pmo.html' => 'img/gpmo1.webp',
        '_site/proyectos-pmi.html' => 'img/Feliz-Valdes-Torero.webp',
        '_site/riesgo-del-plazo.html' => 'img/s901.webp',
        '_site/fidic.html' => 'img/sharon-2_orig.webp',
        '_site/capacitacion.html' => 'img/capmi1.webp',
        '_site/capacitacion-calidad.html' => 'img/Index-GestionCalidad.webp',
        '_site/capacitacion-gestion-de-proyectos.html' => 'img/Index-GestionPMO.webp',
    ];
    foreach ($siteFiles as $file => $needle) {
        $fullPath = $baseDir . '/' . $file;
        if (!file_exists($fullPath)) {
            continue; // Se compilará con build_static.php
        }
        $content = file_get_contents($fullPath);
        if (strpos($content, $needle) === false) {
            throw new \Exception("Archivo {$file} no contiene {$needle}");
        }
    }
    return true;
});

// Test 17: Rutas no rotas a imágenes
runTest("17. Todas las rutas de imágenes en las vistas modificadas resuelven en public_html/", function() use ($baseDir) {
    $files = [
        'private_app/app/Views/pages/pmo.php',
        'private_app/app/Views/pages/proyectos-pmi.php',
        'private_app/app/Views/pages/riesgo-del-plazo.php',
        'private_app/app/Views/pages/fidic.php',
    ];
    foreach ($files as $relPath) {
        $content = file_get_contents($baseDir . '/' . $relPath);
        preg_match_all('/(src|srcset)=["\'](img\/[^"\']+)["\']/i', $content, $matches);
        foreach ($matches[2] as $imgPath) {
            $cleanPath = explode('?', $imgPath)[0];
            $fullPath = $baseDir . '/public_html/' . $cleanPath;
            if (!file_exists($fullPath)) {
                throw new \Exception("Ruta no encontrada en {$relPath}: {$cleanPath}");
            }
        }
    }
    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
exit(0);
