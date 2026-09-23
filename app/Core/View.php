<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Motor de Renderizado de Vistas (View Engine)
 *
 * Responsabilidad:
 * - Localizar y compilar vistas PHP/HTML con aislamiento de variables.
 * - Soporte para Layouts maestros (ej: layouts/main.php) y componentes reutilizables (partials/).
 * - Funciones de escape seguras contra Cross-Site Scripting (XSS).
 */

declare(strict_types=1);

namespace App\Core;

class View
{
    /**
     * Directorio base de las vistas.
     */
    protected string $viewsPath;

    /**
     * Variables globales compartidas en todas las vistas.
     */
    protected array $sharedData = [];

    public function __construct(?string $viewsPath = null)
    {
        $this->viewsPath = $viewsPath ? rtrim($viewsPath, '/\\') : dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views';
    }

    /**
     * Comparte una variable con todas las vistas que se rendericen.
     */
    public function share(string $key, mixed $value): self
    {
        $this->sharedData[$key] = $value;
        return $this;
    }

    /**
     * Renderiza una vista con datos y la envuelve opcionalmente en un Layout.
     *
     * @param string $viewPath Ruta relativa a app/Views (ej: 'pages/terminos-y-condiciones')
     * @param array $data Datos pasados a la vista
     * @param string|null $layout Nombre del layout (ej: 'main') o null para sin layout
     * @return string Contenido HTML resultante
     * @throws \RuntimeException Si el archivo de vista o layout no existe
     */
    public function render(string $viewPath, array $data = [], ?string $layout = 'main'): string
    {
        $viewFile = $this->resolveViewPath($viewPath);
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("La vista solicitada no existe: [{$viewPath}] en [{$viewFile}]");
        }

        // Combinar datos compartidos con los específicos de la vista
        $mergedData = array_merge($this->sharedData, $data);

        // Renderizar el contenido interno de la vista
        $content = $this->renderFile($viewFile, $mergedData);

        // Si se especificó un layout, renderizarlo inyectando $content
        if ($layout !== null) {
            $layoutFile = $this->viewsPath . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $layout . '.php';
            if (!file_exists($layoutFile)) {
                throw new \RuntimeException("El layout maestro solicitado no existe: [{$layout}] en [{$layoutFile}]");
            }

            $layoutData = array_merge($mergedData, ['content' => $content]);
            return $this->renderFile($layoutFile, $layoutData);
        }

        return $content;
    }

    /**
     * Renderiza un componente o partial reutilizable (ej: 'header', 'navbar', 'footer').
     *
     * @param string $partialPath Ruta relativa a app/Views/partials (ej: 'navbar')
     * @param array $data Datos específicos para el componente
     * @return string Contenido HTML del partial
     */
    public function partial(string $partialPath, array $data = []): string
    {
        $partialFile = $this->viewsPath . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . ltrim($partialPath, '/\\') . '.php';
        if (!file_exists($partialFile)) {
            throw new \RuntimeException("El componente parcial no existe: [{$partialPath}] en [{$partialFile}]");
        }

        $mergedData = array_merge($this->sharedData, $data);
        return $this->renderFile($partialFile, $mergedData);
    }

    /**
     * Ejecuta el archivo PHP en un scope cerrado capturando el buffer de salida.
     */
    protected function renderFile(string $filePath, array $data): string
    {
        extract($data, EXTR_SKIP);

        ob_start();
        try {
            include $filePath;
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }

        return ob_get_clean() ?: '';
    }

    /**
     * Resuelve la ruta completa del archivo de vista permitiendo o no la extensión .php
     */
    protected function resolveViewPath(string $viewPath): string
    {
        $normalized = ltrim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $viewPath), DIRECTORY_SEPARATOR);
        if (!str_ends_with($normalized, '.php')) {
            $normalized .= '.php';
        }
        return $this->viewsPath . DIRECTORY_SEPARATOR . $normalized;
    }

    /**
     * Escapa cadenas para prevenir inyecciones XSS en el HTML.
     */
    public static function e(mixed $value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

