<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador Base (Base Controller)
 *
 * Responsabilidad:
 * - Coordinar el flujo entre las peticiones HTTP del usuario, los Modelos y las Vistas.
 * - Proveer métodos auxiliares para renderizar HTML y responder en formato JSON para AJAX/fetch.
 * - Facilitar la lectura de datos POST, GET y cabeceras de petición de forma segura.
 */

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    /**
     * Motor de vistas.
     */
    protected View $view;

    /**
     * Configuración del sistema.
     */
    protected array $config = [];

    public function __construct(?View $view = null, array $config = [])
    {
        $this->view = $view ?? new View();
        $this->config = $config;

        // Compartir variables globales comunes en las vistas (ej. configuración y año actual)
        $this->view->share('config', $this->config);
        $this->view->share('currentYear', date('Y'));
    }

    /**
     * Renderiza una vista y emite la respuesta HTTP correspondiente.
     *
     * @param string $viewPath Ruta de la vista (ej: 'pages/terminos-y-condiciones')
     * @param array $data Variables disponibles en la vista
     * @param string|null $layout Nombre del layout maestro (default: 'main')
     */
    protected function render(string $viewPath, array $data = [], ?string $layout = 'main'): void
    {
        $output = $this->view->render($viewPath, $data, $layout);
        echo $output;
    }

    /**
     * Emite una respuesta estructurada en formato JSON para peticiones asíncronas (fetch / AJAX).
     *
     * @param array $data Datos a serializar
     * @param int $statusCode Código de estado HTTP (200, 400, 404, 422, 500, etc.)
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * Redirige al navegador a una URL específica.
     */
    protected function redirect(string $url, int $statusCode = 302): void
    {
        http_response_code($statusCode);
        header("Location: {$url}");
        exit;
    }

    /**
     * Retorna el método HTTP de la petición actual (GET, POST, etc.).
     */
    protected function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    /**
     * Determina si la petición actual fue realizada vía AJAX / fetch.
     */
    protected function isAjax(): bool
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
               (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json'));
    }

    /**
     * Obtiene y sanitiza un parámetro de la petición POST o de entrada JSON.
     */
    protected function getPost(?string $key = null, mixed $default = null): mixed
    {
        static $input = null;

        if ($input === null) {
            $input = $_POST;
            $rawBody = file_get_contents('php://input');
            if (!empty($rawBody)) {
                $jsonData = json_decode($rawBody, true);
                if (is_array($jsonData)) {
                    $input = array_merge($input, $jsonData);
                }
            }
        }

        if ($key === null) {
            return $input;
        }

        return $input[$key] ?? $default;
    }

    /**
     * Obtiene un parámetro de la query string (GET).
     */
    protected function getQuery(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key] ?? $default;
    }
}

