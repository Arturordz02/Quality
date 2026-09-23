<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Autoloader PSR-4 Autónomo (Zero Dependencies)
 *
 * Responsabilidad:
 * - Cargar automáticamente clases bajo el namespace App\ sin requerir Composer.
 * - Mapeo directo: App\Core\View -> app/Core/View.php
 *                  App\Controllers\LegalController -> app/Controllers/LegalController.php
 *                  App\Models\Contact -> app/Models/Contact.php
 */

declare(strict_types=1);

namespace App\Core;

class Autoloader
{
    private static bool $registered = false;

    /**
     * Registra la función de autocarga en la pila de SPL.
     */
    public static function register(): void
    {
        if (self::$registered) {
            return;
        }

        spl_autoload_register(function (string $class) {
            $prefix = 'App\\';
            $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;

            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }

            $relativeClass = substr($class, $len);
            $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });

        self::$registered = true;
    }
}

