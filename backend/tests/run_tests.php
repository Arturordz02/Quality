<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Suite de Pruebas Automatizadas (Unit & Integration Tests)
 * Ejecución: php backend/tests/run_tests.php
 */

declare(strict_types=1);

define('QCS_BACKEND_ACCESS', true);

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../services/SoftSkillsService.php';
require_once __DIR__ . '/../maintenance/LogRotator.php';

class TestRunner {
    private int $passed = 0;
    private int $failed = 0;
    private array $failures = [];

    public function assert(string $description, bool $condition, ?string $details = null): void {
        if ($condition) {
            $this->passed++;
            echo "  [PASS] {$description}\n";
        } else {
            $this->failed++;
            $msg = "  [FAIL] {$description}" . ($details ? " -> {$details}" : "");
            echo "{$msg}\n";
            $this->failures[] = $msg;
        }
    }

    public function summary(): bool {
        echo "\n==========================================\n";
        echo "RESULTADOS DE LA SUITE DE PRUEBAS QCS QA\n";
        echo "==========================================\n";
        echo "Pruebas pasadas : {$this->passed}\n";
        echo "Pruebas fallidas: {$this->failed}\n";
        if ($this->failed > 0) {
            echo "\nDetalle de Fallos:\n" . implode("\n", $this->failures) . "\n";
            return false;
        }
        echo "\n¡TODAS LAS PRUEBAS PASARON EXITOSAMENTE! (100% OK)\n";
        return true;
    }
}

$runner = new TestRunner();
echo "Iniciando Suite de Pruebas de Arquitectura y Calidad...\n\n";

// ==============================================================================
// 1. PRUEBAS DE RESILIENCIA: CIRCUIT BREAKER
// ==============================================================================
echo "1. Validando Patrón Circuit Breaker...\n";
$testStorage = __DIR__ . '/../storage/circuit_breaker';
$cb = new CircuitBreaker('test_service_qa', 3, 2, 1);
$cb->reset();

$runner->assert("Estado inicial debe ser CLOSED", $cb->getState()['state'] === CircuitBreaker::STATE_CLOSED);

// Simular 3 fallos consecutivos
for ($i = 1; $i <= 3; $i++) {
    try {
        $cb->execute(function () {
            throw new \RuntimeException("Fallo simulado");
        });
    } catch (\Throwable $e) {}
}

$runner->assert("Tras 3 fallos el circuito debe abrirse (OPEN)", $cb->getState()['state'] === CircuitBreaker::STATE_OPEN);

// Probar que llamadas sucesivas en OPEN invocan fallback de inmediato sin saturar
$fallbackCalled = false;
$result = $cb->execute(function () {
    return "Llamada directa";
}, function (\Throwable $e) use (&$fallbackCalled) {
    $fallbackCalled = true;
    return "Respuesta de contingencia";
});

$runner->assert("Fallback se ejecuta de inmediato cuando OPEN", $fallbackCalled && $result === "Respuesta de contingencia");

// Probar restablecimiento
$cb->reset();
$runner->assert("Reset manual restaura a CLOSED", $cb->getState()['state'] === CircuitBreaker::STATE_CLOSED);


// ==============================================================================
// 2. PRUEBAS DE RESILIENCIA: RATE LIMITER (SLIDING WINDOW)
// ==============================================================================
echo "\n2. Validando Rate Limiter...\n";
$rateLimiter = new RateLimiter(__DIR__ . '/../storage/rate_limits_test');
$testKey = 'client_test_qa_' . uniqid();

// Permitir 3 peticiones por 5 segundos
$res1 = $rateLimiter->check($testKey, 3, 5, false);
$res2 = $rateLimiter->check($testKey, 3, 5, false);
$res3 = $rateLimiter->check($testKey, 3, 5, false);
$res4 = $rateLimiter->check($testKey, 3, 5, false);

$runner->assert("Primera petición permitida", $res1['allowed'] === true && $res1['remaining'] === 2);
$runner->assert("Segunda petición permitida", $res2['allowed'] === true && $res2['remaining'] === 1);
$runner->assert("Tercera petición permitida", $res3['allowed'] === true && $res3['remaining'] === 0);
$runner->assert("Cuarta petición bloqueada con 429", $res4['allowed'] === false && $res4['retry_after'] > 0);


// ==============================================================================
// 3. PRUEBAS DEL MOTOR DE HABILIDADES BLANDAS (SCORING Y REPORTE)
// ==============================================================================
echo "\n3. Validando Motor de Habilidades Blandas...\n";
$config = require __DIR__ . '/../config.php';
$cache = CacheManager::getInstance($config);
$service = new SoftSkillsService($config, $cache, $cb);

$questions = $service->getQuestions();
$runner->assert("Se cargan al menos 4 preguntas situacionales", count($questions) >= 4);

$dimensionsFound = array_unique(array_column($questions, 'dimension'));
$runner->assert("Contiene las 4 dimensiones requeridas", count($dimensionsFound) === 4);

// Caso A: Candidato Sobresaliente (selecciona todas las mejores opciones con score 5)
$perfectAnswers = [];
foreach ($questions as $q) {
    // Buscar la opción con mayor puntuación
    usort($q['options'], fn($a, $b) => $b['score_value'] <=> $a['score_value']);
    $perfectAnswers[$q['id']] = $q['options'][0]['id'];
}

$candidateA = [
    'name' => 'Ing. María Alejandra Ramos',
    'email' => 'mramos@constructora.com',
    'phone' => '+51 988 777 666',
    'role' => 'Directora de PMO',
];

$reportA = $service->evaluateAndProcess($candidateA, $perfectAnswers);

$runner->assert("Candidato sobresaliente alcanza 100%", $reportA['summary']['percentage'] === 100.0);
$runner->assert("Clasificación general es 'sobresaliente'", $reportA['summary']['performance_level'] === 'sobresaliente');
$runner->assert("Genera fortalezas y recomendaciones no vacías", !empty($reportA['dimensions']['comunicacion']['strengths']));
$runner->assert("Genera plan de acción integrado", isset($reportA['action_plan']['priority_area'], $reportA['action_plan']['key_asset']));

// Caso B: Candidato con puntuación baja (score 1)
$lowAnswers = [];
foreach ($questions as $q) {
    usort($q['options'], fn($a, $b) => $a['score_value'] <=> $b['score_value']);
    $lowAnswers[$q['id']] = $q['options'][0]['id'];
}
$candidateB = [
    'name' => 'Practicante Inicial',
    'email' => 'practicante@test.com',
    'phone' => '+51 900 000 000',
    'role' => 'Asistente de Oficina Técnica',
];
$reportB = $service->evaluateAndProcess($candidateB, $lowAnswers);
$runner->assert("Puntuación mínima es menor al 60%", $reportB['summary']['percentage'] < 60.0);
$runner->assert("Clasificación general es 'inicial'", $reportB['summary']['performance_level'] === 'inicial');


// ==============================================================================
// 4. PRUEBAS DE CACHÉ MULTICAPA Y PATRÓN REMEMBER
// ==============================================================================
echo "\n4. Validando Caché Multicapa...\n";
$cacheKey = 'qa_test_cache_' . uniqid();
$cache->set($cacheKey, ['status' => 'active', 'timestamp' => time()], 60);

$runner->assert("Caché almacena estructuras complejas", $cache->has($cacheKey));
$cachedData = $cache->get($cacheKey);
$runner->assert("Caché recupera valor serializado intacto", is_array($cachedData) && $cachedData['status'] === 'active');

$rememberCount = 0;
$remVal1 = $cache->remember('qa_remember_key', 60, function () use (&$rememberCount) {
    $rememberCount++;
    return 'computed_first_time';
});
$remVal2 = $cache->remember('qa_remember_key', 60, function () use (&$rememberCount) {
    $rememberCount++;
    return 'computed_second_time';
});

$runner->assert("Patrón remember solo evalúa la clausura una vez", $rememberCount === 1 && $remVal1 === 'computed_first_time' && $remVal2 === 'computed_first_time');
$cache->delete($cacheKey);
$cache->delete('qa_remember_key');


// ==============================================================================
// 5. PRUEBAS DE PAGINACIÓN OBLIGATORIA (ANTI-DOS)
// ==============================================================================
echo "\n5. Validando Paginador Obligatorio...\n";
$params = Paginator::extractParams(['page' => '2', 'limit' => '1000'], 15, 50);
$runner->assert("Paginador limita automáticamente el máximo a 50 (Anti-DoS)", $params['per_page'] === 50);
$runner->assert("Paginador calcula offset correctamente: (2-1)*50 = 50", $params['offset'] === 50);

$pagedResponse = Paginator::formatResponse([['id' => 1], ['id' => 2]], 120, 2, 50);
$runner->assert("Metadatos de paginación calculan total_pages = 3", $pagedResponse['pagination']['total_pages'] === 3);
$runner->assert("Metadatos indican has_next = true", $pagedResponse['pagination']['has_next'] === true);
$runner->assert("Metadatos indican has_prev = true", $pagedResponse['pagination']['has_prev'] === true);


// ==============================================================================
// 6. PRUEBAS DE MANTENIMIENTO: ROTACIÓN Y COMPRESIÓN DE LOGS (.LOG.GZ)
// ==============================================================================
echo "\n6. Validando Rotador y Compresor Gzip de Logs...\n";
$testLogDir = __DIR__ . '/../storage/test_logs';
if (!is_dir($testLogDir)) @mkdir($testLogDir, 0775, true);

// Crear log de prueba que supere el umbral
$dummyLog = $testLogDir . '/test_audit.log';
$content = str_repeat("2026-09-08 14:00:00 [INFO] Operación de prueba en Quality Consulting Solutions.\n", 200);
file_put_contents($dummyLog, $content);
$dummySize = filesize($dummyLog);

// Configurar rotador con umbral bajo para forzar rotación
$rotator = new LogRotator($testLogDir, 1024, 30);
$rotResult = $rotator->run();

$runner->assert("Rotador detecta y procesa el archivo de log", count($rotResult['rotated']) > 0);

$gzFiles = glob($testLogDir . '/*.gz');
$runner->assert("Se generó archivo archivado con extensión .gz", count($gzFiles) > 0);

if (!empty($gzFiles)) {
    $gzHandle = gzopen($gzFiles[0], 'rb');
    $readDecompressed = gzread($gzHandle, 100);
    gzclose($gzHandle);
    $runner->assert("El archivo comprimido .gz es íntegro y legible por zlib", strpos($readDecompressed, 'Quality Consulting Solutions') !== false);
}

// Limpiar archivos de prueba
array_map('unlink', glob($testLogDir . '/*.*'));
@rmdir($testLogDir);


// Salida final
$success = $runner->summary();
exit($success ? 0 : 1);

