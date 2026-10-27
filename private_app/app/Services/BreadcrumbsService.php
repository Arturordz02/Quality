<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Servicio Centralizado de Breadcrumbs Globales y Dinámicos
 * Archivo: app/Services/BreadcrumbsService.php
 *
 * Responsabilidad:
 * - Determinar la jerarquía de navegación dinámica de cualquier página o curso.
 * - Proveer nombres públicos oficiales y legibles para cada nivel.
 * - Soportar rutas de cursos vinculadas a sus categorías oficiales.
 * - Soportar páginas de pago y registro con retención del contexto del curso.
 * - Omitir breadcrumbs en Home y proveer jerarquía exacta para 404.
 * - Generar URLs compatibles con producción (https://quality-consulting.org)
 *   y GitHub Pages (/Quality/).
 */

declare(strict_types=1);

namespace App\Services;

class BreadcrumbsService
{
    /**
     * Mapeo de categorías oficiales de capacitación con su nombre público y ruta.
     */
    private const CATEGORIES = [
        'contratos' => [
            'title' => 'Gestión de Contratos',
            'url'   => '/capacitacion-contratos',
        ],
        'calidad' => [
            'title' => 'Calidad',
            'url'   => '/capacitacion-calidad',
        ],
        'riesgos' => [
            'title' => 'Riesgos',
            'url'   => '/capacitacion-riesgos',
        ],
        'gestion-de-proyectos' => [
            'title' => 'Gestión de Proyectos',
            'url'   => '/capacitacion-gestion-de-proyectos',
        ],
        'oficina-tecnica' => [
            'title' => 'Oficina Técnica',
            'url'   => '/capacitacion-oficina-tecnica',
        ],
    ];

    /**
     * Títulos limpios y oficiales para páginas estáticas e institucionales.
     */
    private const STATIC_PAGES = [
        'capacitacion'             => ['Capacitación'],
        'consultoria'              => ['Consultoría'],
        'medios'                   => ['Medios y Podcasts'],
        'contacto'                 => ['Contacto'],
        'nosotros'                 => ['Nosotros'],
        'clientes'                 => ['Clientes'],
        'press'                    => ['Press'],
        'noticias'                 => ['Noticias'],
        'investigacion'            => ['Investigación'],
        'terminos-y-condiciones'   => ['Términos y Condiciones'],
        'libro-de-reclamaciones'   => ['Libro de Reclamaciones'],
        'evaluacion-habilidades'   => ['Evaluación de Habilidades'],
        'headhunting'              => ['Headhunting'],
        '404'                      => ['Página no encontrada'],
    ];

    /**
     * Títulos limpios en Title Case para cursos conocidos según CoursesCatalog.php.
     */
    private const COURSE_TITLES_OVERRIDE = [
        // Contratos
        'contrato-nec4' => 'Contrato NEC4',
        'contrato-colaborativo-nec-3-4' => 'Contrato Colaborativo NEC 3/4',
        'contratos-colaborativos-nec3-f' => 'Contratos Colaborativos NEC3-F',
        'casos-practicos-contratos-nec3-f' => 'Casos Prácticos de Contratos NEC3-F',
        'contratos-estado' => 'Contrataciones con el Estado y Ley 30225',
        'contratos-fidic-epc-construccion' => 'Contratos FIDIC para Contratos EPC y Construcción',
        'contratos' => 'Administración de Contratos de Construcción',
        'eventos-compensables-alertas-tempranas-nec4' => 'Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
        'gestion-cambios-contratos-estado' => 'Gestión del Cambio en los Contratos con el Estado',
        'gestion-contractual-megaproyectos-mineros' => 'Gestión Contractual en los Megaproyectos de Construcción Mineros',
        'gestion-reclamos-nec-fidic' => 'Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC',
        'junta-resolucion-disputas-dab' => 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras',
        'seminario-valorizacion-obra-contratos-nec' => 'Seminario Valorización de Obra en Contratos NEC',
        'nec' => 'Seminario Valorización de Obra en Contratos NEC',
        'fidic' => 'Contratos FIDIC en Infraestructura y Construcción',

        // Calidad
        'bim-revit-architecture' => 'BIM Revit Architecture',
        'calidad-y-pmi' => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
        'control-de-calidad-en-tuneleria' => 'Control de Calidad en Tunelería',
        'direccion-calidad-enfoque-pmi' => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
        'gerencia-de-calidad' => 'Gerencia de la Calidad en la Construcción',
        'gestion-de-la-calidad' => 'Gestión de la Calidad en Construcción',
        'herramientas' => 'Taller de Herramientas de Gestión de Calidad en la Construcción + Uso de Inteligencia Artificial',
        'indicadores-de-calidad' => 'Seminario Indicadores Avanzados de la Calidad',
        'iso-9001' => 'ISO 9001 para la Construcción usando IA',
        'seminario-diagrama-ishikawa' => 'Casos de Aplicación del Diagrama de Ishikawa',
        'seminario-iso-9001-2026' => 'Seminario ISO 9001:2026',
        'sindrome-del-90' => 'Seminario Completion - Evita el Síndrome del 90%',

        // Riesgos
        'analisis-cuantitativo-riesgos' => 'Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo',
        'gestion-de-riesgos' => 'Gestión de Riesgos, Cambios y Reclamos en la Construcción',
        'riesgo-del-plazo' => 'Gestión del Riesgo del Plazo en Obra',
        'riesgos-cadena-produccion' => 'Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM',
        'riesgos-pmi' => 'Gestión de Riesgos en Proyectos con el Enfoque PMI®',
        'riesgos-tecnicos' => 'Gestión de Riesgos Técnicos en la Construcción con el Nuevo Estándar del PMI® 2024',

        // Oficina Técnica
        'oficina-tecnica-obras-viales' => 'Oficina Técnica en Obras Viales',
        'oficina-tecnica-hospitales-edificaciones' => 'Oficina Técnica en Edificaciones y Hospitales',
        'oficina-tecnica-infraestructura-minera' => 'Oficina Técnica en Infraestructura Minera (PADs, Presas de Relave, Geosintéticos)',
        'oficina-tecnica-edificaciones-panel-control' => 'Oficina Técnica en Edificaciones + Panel de Control 100% Real Time',
        'oficina-tecnica' => 'Gestión Integral de Oficina Técnica en Obras',

        // Gestión de Proyectos
        'gestion-proyectos-pmi' => 'Gestión de Proyectos con el Enfoque PMI',
        'gestion-pmo-vmo' => 'Gestión de la PMO & VMO',
        'brightline-initiative' => 'Brightline Initiative (Enfoque Estratégico del PMI)',
        'gruas-torre' => 'Grúas Torre (Planificación y Productividad)',
        'lean-construction-edificaciones' => 'Lean Construction en Edificaciones',
        'lean-construction-infraestructura' => 'Lean Construction en Infraestructura',
        'lean-last-planner' => 'Lean Construction y Sistema Last Planner',
        'liderazgo-construccion' => 'Liderazgo en la Construcción',
        'resultado-operativo-obra' => 'Resultado Operativo de Obra',
        'valor-ganado-ms-project-power-bi' => 'Valor Ganado con MS Project y Power BI',
        'costos-edificaciones-power-bi' => 'Costos en Edificaciones con Power BI',
        'control-proyectos-bim-power-bi' => 'Control de Proyectos con BIM y Power BI',
        'vdc' => 'Virtual Design & Construction (VDC)',
        'control-proyectos-primavera-p6' => 'Control de Proyectos con Primavera P6',
        'analisis-forense-cronograma-primavera-p6' => 'Análisis Forense del Cronograma con Primavera P6',
        'control-proyectos-construccion' => 'Control de Proyectos de Construcción',
        'cronograma-forense' => 'Cronograma Forense en Construcción',
        'gestion-de-pmo' => 'Gestión e Implementación de PMO en Construcción',
        'pmo' => 'Gestión e Implementación de PMO en Construcción',
        'proyectos-pmi' => 'Gestión de Proyectos bajo el Enfoque PMI / PMBOK',
        'costos' => 'Costos y Presupuestos en Edificaciones',
        'valor-ganado' => 'Gestión del Valor Ganado (EVM) en Construcción',
        'universidad-corporativa' => 'Universidad Corporativa',
    ];

    /**
     * Determina los ítems de navegación según el contexto de la vista.
     *
     * @param array $context Variables pasadas a la vista ($activePage, $title, $pageName, etc.)
     * @return array<int, array{title: string, url: ?string}> Lista de migas o array vacío si es Home.
     */
    public static function getBreadcrumbs(array $context = []): array
    {
        $slug = self::resolveCurrentSlug($context);

        // 1. Omitir breadcrumbs en la página de inicio
        if ($slug === '' || $slug === 'home' || $slug === 'index') {
            return [];
        }

        $items = [
            ['title' => 'Inicio', 'url' => '/'],
        ];

        // 2. Error 404
        if ($slug === '404') {
            $items[] = ['title' => 'Página no encontrada', 'url' => null];
            return $items;
        }

        // 3. Capacitación general
        if ($slug === 'capacitacion') {
            $items[] = ['title' => 'Capacitación', 'url' => null];
            return $items;
        }

        // 4. Categorías directas de capacitación (ej: /capacitacion-contratos)
        $cleanCategorySlug = str_replace('capacitacion-', '', $slug);
        if (str_starts_with($slug, 'capacitacion-') && isset(self::CATEGORIES[$cleanCategorySlug])) {
            $cat = self::CATEGORIES[$cleanCategorySlug];
            $items[] = ['title' => 'Capacitación', 'url' => '/capacitacion'];
            $items[] = ['title' => $cat['title'], 'url' => null];
            return $items;
        }

        // 5. Páginas de Pago y Registro (conservando contexto del curso si es válido)
        if (in_array($slug, ['pagar-primera-clase', 'registro-primera-clase', 'registro-exitoso', 'pago-cancelado'], true)) {
            $courseSlug = self::resolveCourseSlugForPayment($context);
            $actionTitle = match ($slug) {
                'pagar-primera-clase'    => 'Pago de primera clase',
                'registro-primera-clase'  => 'Registro',
                'registro-exitoso'        => 'Registro exitoso',
                'pago-cancelado'          => 'Pago cancelado',
            };

            $items[] = ['title' => 'Capacitación', 'url' => '/capacitacion'];

            if ($courseSlug !== '' && CourseCatalog::isValid($courseSlug)) {
                $categoryInfo = self::findCategoryForCourse($courseSlug);
                if ($categoryInfo !== null) {
                    $items[] = ['title' => $categoryInfo['title'], 'url' => $categoryInfo['url']];
                }
                $courseTitle = self::getCourseTitle($courseSlug);
                $courseUrl = '/' . $courseSlug;
                $items[] = ['title' => $courseTitle, 'url' => $courseUrl];
            }

            $items[] = ['title' => $actionTitle, 'url' => null];
            return $items;
        }

        // 6. Subpáginas de Investigación (ej: /encuestas-proyectos)
        if ($slug === 'encuestas-proyectos') {
            $items[] = ['title' => 'Investigación', 'url' => '/investigacion'];
            $items[] = ['title' => 'Encuestas-Proyectos', 'url' => null];
            return $items;
        }

        // 7. Cursos de Capacitación individuales (identificados por catálogo)
        $categoryInfo = self::findCategoryForCourse($slug);
        if ($categoryInfo !== null) {
            $items[] = ['title' => 'Capacitación', 'url' => '/capacitacion'];
            $items[] = ['title' => $categoryInfo['title'], 'url' => $categoryInfo['url']];
            $items[] = ['title' => self::getCourseTitle($slug), 'url' => null];
            return $items;
        }

        // 8. Páginas estáticas mapeadas
        if (isset(self::STATIC_PAGES[$slug])) {
            $items[] = ['title' => self::STATIC_PAGES[$slug][0], 'url' => null];
            return $items;
        }

        // 9. Fallback seguro para rutas no mapeadas: usar el título de la vista/controlador
        $safeTitle = self::extractSafeTitle($context, $slug);
        $items[] = ['title' => $safeTitle, 'url' => null];

        return $items;
    }

    /**
     * Resuelve el slug de la página actual desde variables de contexto o URI.
     */
    private static function resolveCurrentSlug(array $context): string
    {
        // 1. Si se pasó pageName explícito (ej: en build_static)
        if (!empty($context['pageName'])) {
            return trim((string)$context['pageName'], '/');
        }

        // 2. Si activePage es home, retornar 'home'
        if (($context['activePage'] ?? '') === 'home') {
            return 'home';
        }

        // 3. Extraer desde la URL canónica si fue definida
        $canonical = (string)($context['canonical'] ?? $context['canonicalUrl'] ?? '');
        if ($canonical !== '') {
            $path = parse_url($canonical, PHP_URL_PATH) ?: '';
            $clean = trim($path, '/');
            if ($clean !== '') {
                return $clean;
            }
        }

        // 4. Extraer desde REQUEST_URI (ignorando query string)
        $rawUri = $_SERVER['REQUEST_URI'] ?? '';
        $pathOnly = parse_url($rawUri, PHP_URL_PATH) ?: '';
        $cleanPath = trim($pathOnly, '/');

        // Remover sufijo .html si existe
        if (str_ends_with(strtolower($cleanPath), '.html')) {
            $cleanPath = substr($cleanPath, 0, -5);
        }

        if ($cleanPath !== '') {
            // Si corre en subdirectorio como /Quality/nosotros -> extraer la última parte
            $segments = explode('/', $cleanPath);
            $lastSegment = end($segments);
            if ($lastSegment !== '' && $lastSegment !== 'index' && $lastSegment !== 'Quality') {
                return $lastSegment;
            }
        }

        // 5. Fallback a activePage
        return (string)($context['activePage'] ?? '');
    }

    /**
     * Encuentra la categoría a la que pertenece un curso según CoursesCatalog.
     *
     * @return array{title: string, url: string}|null
     */
    public static function findCategoryForCourse(string $courseSlug): ?array
    {
        $normalizedSlug = trim(strtolower($courseSlug), '/');
        $allCourses = CoursesCatalog::getAll();

        foreach ($allCourses as $c) {
            $route = trim((string)($c['route'] ?? ''), '/');
            if ($route === $normalizedSlug) {
                $catSlug = strtolower(trim((string)($c['category_slug'] ?? '')));
                return self::CATEGORIES[$catSlug] ?? null;
            }
        }

        // Fallback por CourseCatalog si está catalogado allí
        if (CourseCatalog::isValid($normalizedSlug)) {
            // Verificar si contiene palabras clave en el slug para asociar categoría
            if (str_contains($normalizedSlug, 'contrato') || str_contains($normalizedSlug, 'fidic') || str_contains($normalizedSlug, 'nec') || str_contains($normalizedSlug, 'dab')) {
                return self::CATEGORIES['contratos'];
            }
            if (str_contains($normalizedSlug, 'calidad') || str_contains($normalizedSlug, 'iso') || str_contains($normalizedSlug, 'ishikawa')) {
                return self::CATEGORIES['calidad'];
            }
            if (str_contains($normalizedSlug, 'riesgo')) {
                return self::CATEGORIES['riesgos'];
            }
            if (str_contains($normalizedSlug, 'oficina-tecnica')) {
                return self::CATEGORIES['oficina-tecnica'];
            }
            return self::CATEGORIES['gestion-de-proyectos'];
        }

        return null;
    }

    /**
     * Obtiene el título público limpio para un curso.
     * Prioridad:
     * 1. Overrides auditados con acentos y siglas exactas (CoursesCatalog en Title Case).
     * 2. CoursesCatalog.php como fuente principal oficial.
     * 3. CourseCatalog.php como catálogo secundario.
     * 4. Fallback legible generado desde el slug.
     */
    public static function getCourseTitle(string $courseSlug): string
    {
        $clean = trim(strtolower($courseSlug), '/');

        if (isset(self::COURSE_TITLES_OVERRIDE[$clean])) {
            return self::COURSE_TITLES_OVERRIDE[$clean];
        }

        // Fuente principal: CoursesCatalog.php
        foreach (CoursesCatalog::getAll() as $course) {
            $courseRoute = trim((string)($course['route'] ?? ''), '/');
            if ($courseRoute !== '' && strtolower($courseRoute) === $clean) {
                $rawTitle = trim((string)($course['title'] ?? ''));
                if ($rawTitle !== '') {
                    return $rawTitle;
                }
            }
        }

        // Fuente secundaria: CourseCatalog.php
        if (CourseCatalog::isValid($clean)) {
            $title = CourseCatalog::getTitle($clean);
            return trim($title);
        }

        // Fallback: convertir slug a título legible
        return ucwords(str_replace('-', ' ', $clean));
    }

    /**
     * Resuelve el slug del curso asociado en páginas de pago o registro.
     */
    private static function resolveCourseSlugForPayment(array $context): string
    {
        if (!empty($context['courseSlug'])) {
            return trim((string)$context['courseSlug']);
        }

        if (!empty($_GET['curso'])) {
            return trim((string)$_GET['curso']);
        }

        if (isset($_SESSION['paypal_confirmed_payment']['course_slug'])) {
            return trim((string)$_SESSION['paypal_confirmed_payment']['course_slug']);
        }

        return '';
    }

    /**
     * Extrae un título público seguro para rutas no mapeadas.
     */
    private static function extractSafeTitle(array $context, string $slug): string
    {
        $rawTitle = (string)($context['pageTitle'] ?? $context['title'] ?? '');

        if ($rawTitle !== '') {
            // Quitar sufijo institucional " | Quality Consulting Solutions"
            $cleaned = preg_replace('/\s*\|\s*Quality Consulting Solutions.*$/i', '', $rawTitle);
            $cleaned = preg_replace('/\s*–\s*Quality Consulting Solutions.*$/i', '', (string)$cleaned);
            $cleaned = trim((string)$cleaned);
            if ($cleaned !== '') {
                return $cleaned;
            }
        }

        return ucwords(str_replace('-', ' ', $slug));
    }

    /**
     * Adapta una URL para ser compatible tanto con producción como con GitHub Pages estático.
     */
    public static function formatUrl(string $url, bool $isStatic = false): string
    {
        if ($url === '/' || $url === '') {
            return $isStatic ? 'index.html' : '/';
        }

        if ($isStatic) {
            $clean = ltrim($url, '/');
            $parts = explode('?', $clean, 2);
            $file = $parts[0] . '.html';
            return isset($parts[1]) ? $file . '?' . $parts[1] : $file;
        }

        return $url;
    }
}
