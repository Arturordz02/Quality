<?php
/**
 * Test Suite: Tarea 4 - Variables de Entorno, Credenciales y .gitignore
 */

declare(strict_types=1);

$testsPassed = 0;
$testsTotal = 0;

function assertTest(string $desc, bool $condition, string $detail = ''): void {
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo "  [PASS] {$desc}\n";
    } else {
        echo "  [FAIL] {$desc} - {$detail}\n";
    }
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 4 - VARIABLES DE ENTORNO Y SEGURIDAD\n";
echo "======================================================\n\n";

$rootDir = dirname(__DIR__, 2);

// 1. Validar .gitignore
$gitignorePath = $rootDir . '/.gitignore';
assertTest(".gitignore existe en la raíz del proyecto", file_exists($gitignorePath));

$gitignoreContent = file_get_contents($gitignorePath);
assertTest(".gitignore excluye .env y variantes", strpos($gitignoreContent, '.env') !== false && strpos($gitignoreContent, '!.env.example') !== false);
assertTest(".gitignore excluye backend/storage/fallback_queue/*", strpos($gitignoreContent, 'backend/storage/fallback_queue/*') !== false);
assertTest(".gitignore excluye backend/storage/logs/*", strpos($gitignoreContent, 'backend/storage/logs/*') !== false);
assertTest(".gitignore excluye backend/storage/cache/*", strpos($gitignoreContent, 'backend/storage/cache/*') !== false);
assertTest(".gitignore excluye backend/storage/rate_limits/*", strpos($gitignoreContent, 'backend/storage/rate_limits/*') !== false);
assertTest(".gitignore excluye temporales y del sistema operativo", strpos($gitignoreContent, '.DS_Store') !== false && strpos($gitignoreContent, '*.tmp') !== false);

// 2. Validar .gitkeep en carpetas de almacenamiento
$gitkeepDirs = ['fallback_queue', 'logs', 'cache', 'rate_limits', 'circuit_breaker'];
foreach ($gitkeepDirs as $dir) {
    $keepFile = $rootDir . "/backend/storage/{$dir}/.gitkeep";
    assertTest(".gitkeep existe en storage/{$dir}", file_exists($keepFile));
}

// 3. Validar .env.example
$envExamplePath = $rootDir . '/.env.example';
assertTest(".env.example existe en la raíz", file_exists($envExamplePath));

$envExampleContent = file_get_contents($envExamplePath);
$requiredEnvVars = [
    'APP_ENV', 'DB_ENABLED', 'DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASSWORD',
    'SMTP_HOST', 'SMTP_PORT', 'SMTP_USER', 'SMTP_PASSWORD', 'SMTP_ENCRYPTION', 'SMTP_FROM_EMAIL', 'SMTP_FROM_NAME'
];
foreach ($requiredEnvVars as $var) {
    assertTest(".env.example contiene la variable {$var}", strpos($envExampleContent, $var) !== false);
}
assertTest(".env.example no contiene contraseñas reales escritas", preg_match('/SMTP_PASSWORD=\s*\r?\n/', $envExampleContent) === 1);

// 4. Validar backend/config.php y backend/config.example.php
$configPath = $rootDir . '/backend/config.php';
$configExamplePath = $rootDir . '/backend/config.example.php';
assertTest("config.php existe", file_exists($configPath));
assertTest("config.example.php existe", file_exists($configExamplePath));

$configContent = file_get_contents($configPath);
assertTest("config.php implementa mecanismo de variables de entorno getenv/.env", strpos($configContent, 'getenv') !== false);
assertTest("config.php no contiene 'TU_CONTRASEÑA_SMTP_AQUI'", strpos($configContent, 'TU_CONTRASEÑA_SMTP_AQUI') === false);
assertTest("config.php utiliza '' como fallback para SMTP_PASSWORD", strpos($configContent, "getenv('SMTP_PASSWORD', '')") !== false || strpos($configContent, "\$env('SMTP_PASSWORD', '')") !== false);

// 5. Carga de configuración activa vía bootstrap
define('QCS_BACKEND_ACCESS', true);
$bootstrap = require $rootDir . '/backend/bootstrap.php';
$config = $bootstrap['config'];

assertTest("bootstrap carga la estructura config correctamente", is_array($config) && isset($config['mail'], $config['database']));
assertTest("config['mail']['password'] no contiene credenciales hardcodeadas", $config['mail']['password'] === '' || getenv('SMTP_PASSWORD') !== false);

// 6. Detección controlada de credenciales faltantes en Database y SmtpMailer
$dummyConfigDb = [
    'database' => [
        'enabled' => true,
        'host' => '', // Host vacío
        'name' => 'test_db',
        'user' => 'root',
        'password' => ''
    ]
];
Database::resetConnection();
$pdoResult = Database::getConnection($dummyConfigDb);
assertTest("Database detecta DB_HOST faltante y rechaza conexión con log controlado", $pdoResult === null && strpos((string)Database::getLastError(), 'faltan DB_HOST') !== false);

require_once $rootDir . '/backend/SmtpMailer.php';
$dummyConfigSmtp = [
    'mail' => [
        'driver' => 'smtp',
        'host' => 'mail.example.com',
        'port' => 465,
        'encryption' => 'ssl',
        'auth' => true,
        'username' => 'user@example.com',
        'password' => '', // Password vacío con auth activado
    ]
];
$mailer = new SmtpMailer($dummyConfigSmtp);
$mailResult = $mailer->send('dest@example.com', 'Test', 'Body');
assertTest("SmtpMailer detecta contraseña faltante con auth=true y emite log/error controlado", $mailResult === false && strpos((string)$mailer->getLastError(), 'SMTP_PASSWORD') !== false);

// 7. Validar que health.php no filtre credenciales
$healthFile = $rootDir . '/backend/health.php';
$healthContent = file_get_contents($healthFile);
assertTest("health.php verifica debug antes de exponer detalles de DB", strpos($healthContent, 'debug') !== false);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE TAREA 4 PASARON EXITOSAMENTE <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS <<<\n";
    exit(1);
}
