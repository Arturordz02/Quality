<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Enrutador del Sistema (Router)
 *
 * Responsabilidad:
 * - Registrar rutas HTTP (GET, POST, etc.) asociadas a Controladores y acciones.
 * - Normalizar la URI solicitada independientemente de si el proyecto corre en la raíz o en un subdirectorio.
 * - Despachar la petición instanciando el controlador correspondiente de forma segura.
 */

declare(strict_types=1);

namespace App\Core;

class Router
{
    /**
     * Tabla de rutas registradas organizadas por método HTTP.
     */
    protected array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    /**
     * Manejador personalizado para errores 404 (Ruta no encontrada).
     */
    protected $notFoundHandler = null;

    /**
     * Configuración del sistema.
     */
    protected array $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Registra una ruta GET.
     *
     * @param string $path Ruta pública (ej: '/', '/terminos-y-condiciones')
     * @param callable|array $handler Acción a ejecutar (ej: [LegalController::class, 'terminos'])
     */
    public function get(string $path, callable|array $handler): self
    {
        return $this->addRoute('GET', $path, $handler);
    }

    /**
     * Registra una ruta POST.
     */
    public function post(string $path, callable|array $handler): self
    {
        return $this->addRoute('POST', $path, $handler);
    }

    /**
     * Registra una ruta con cualquier método HTTP.
     */
    public function addRoute(string $method, string $path, callable|array $handler): self
    {
        $normalizedMethod = strtoupper($method);
        $normalizedPath = $this->normalizePath($path);

        $this->routes[$normalizedMethod][$normalizedPath] = $handler;
        return $this;
    }

    /**
     * Establece una función de retorno personalizada cuando una ruta no es encontrada.
     */
    public function setNotFoundHandler(callable $handler): self
    {
        $this->notFoundHandler = $handler;
        return $this;
    }

    /**
     * Despacha la petición actual según la URI y método HTTP.
     */
    public function dispatch(?string $requestUri = null, ?string $requestMethod = null): mixed
    {
        $method = strtoupper($requestMethod ?? $_SERVER['REQUEST_METHOD'] ?? 'GET');
        $resolvedUri = $this->resolveRequestUri($requestUri);
        $normalizedUri = $this->normalizePath($resolvedUri);

        // 1. Buscar coincidencia exacta
        if (isset($this->routes[$method][$normalizedUri])) {
            return $this->executeHandler($this->routes[$method][$normalizedUri]);
        }

        // 2. Fallback: Manejo de 404 (No Encontrado)
        if ($this->notFoundHandler !== null) {
            return call_user_func($this->notFoundHandler, $normalizedUri);
        }

        return $this->defaultNotFound($normalizedUri);
    }

    /**
     * Determina la ruta solicitada soportando REQUEST_URI, PATH_INFO y ?route=...
     */
    protected function resolveRequestUri(?string $customUri = null): string
    {
        if ($customUri !== null) {
            return $customUri;
        }

        // 1. Soporte para parámetro explícito en query string (útil sin mod_rewrite)
        if (!empty($_GET['route'])) {
            return (string)$_GET['route'];
        }

        // 2. Soporte para PATH_INFO (ej: /public/index.php/mvc-health)
        if (!empty($_SERVER['PATH_INFO'])) {
            return (string)$_SERVER['PATH_INFO'];
        }

        // 3. Extracción de REQUEST_URI limpiando la query string
        $rawUri = $_SERVER['REQUEST_URI'] ?? '/';
        $pathOnly = parse_url($rawUri, PHP_URL_PATH) ?: '/';

        // 4. Remover prefijos comunes de script si se ejecuta desde subdirectorio o public/index.php
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        if ($scriptName !== '' && str_starts_with($pathOnly, $scriptName)) {
            $pathOnly = substr($pathOnly, strlen($scriptName));
        } else {
            $scriptDir = dirname($scriptName);
            if ($scriptDir !== '/' && $scriptDir !== '\\' && $scriptDir !== '.' && str_starts_with($pathOnly, $scriptDir)) {
                $pathOnly = substr($pathOnly, strlen($scriptDir));
            }
        }

        return $pathOnly ?: '/';
    }

    /**
     * Ejecuta el handler registrado (closure o [ControllerClass, 'method']).
     */
    protected function executeHandler(callable|array $handler): mixed
    {
        if (is_callable($handler)) {
            return call_user_func($handler);
        }

        if (is_array($handler) && count($handler) === 2) {
            [$controllerClass, $action] = $handler;

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass(new View(), $this->config);
                if (method_exists($controller, $action)) {
                    return $controller->$action();
                }

                throw new \BadMethodCallException("La acción [{$action}] no existe en el controlador [{$controllerClass}].");
            }

            throw new \RuntimeException("La clase controladora [{$controllerClass}] no existe.");
        }

        throw new \InvalidArgumentException('El manejador de ruta registrado no es válido.');
    }

    /**
     * Normaliza la ruta removiendo slashes redundantes y extensiones estáticas (.html).
     */
    public function normalizePath(string $path): string
    {
        $clean = trim($path, '/');
        // Si termina en .html, permitir coincidencia transparente (ej: terminos.html -> terminos)
        if (str_ends_with(strtolower($clean), '.html')) {
            $clean = substr($clean, 0, -5);
        }
        return '/' . $clean;
    }

    /**
     * Respuesta por defecto en caso de ruta inexistente.
     */
    protected function defaultNotFound(string $uri): void
    {
        http_response_code(404);

        // Si existe un archivo 404.html estático en el proyecto, mostrarlo
        $custom404 = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '404.html';
        if (file_exists($custom404)) {
            include $custom404;
            exit;
        }

        echo "<h1>Error 404 - Página no encontrada</h1><p>La ruta [{$uri}] no fue localizada.</p>";
        exit;
    }
}

