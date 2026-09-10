<?php
/**
 * Test Suite: Tarea 7 - Procesador Real de Cola de Contingencia (Cron)
 */

declare(strict_types=1);

$baseUrl = 'http://127.0.0.1:8089';
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

function httpGet(string $url): array {
    $ctx = stream_context_create([
        'http' => [
            'method' => 'GET',
            'ignore_errors' => true,
            'timeout' => 5,
            'header' => "Accept: application/json\r\n"
        ]
    ]);
    $body = @file_get_contents($url, false, $ctx);
    $status = 0;
    if (isset($http_response_header) && preg_match('#HTTP/\S+\s+(\d+)#', $http_response_header[0], $m)) {
        $status = (int)$m[1];
    }
    return ['status' => $status, 'body' => $body ?: '', 'json' => json_decode($body ?: '', true)];
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 7 - PROCESADOR DE FALLBACK QUEUE    \n";
echo "======================================================\n\n";

define('QCS_BACKEND_ACCESS', true);
$bootstrap = require __DIR__ . '/../bootstrap.php';
$config = $bootstrap['config'];
$pdo = Database::getConnection($config);

// Iniciar servidor local de pruebas si no está activo
$socket = @fsockopen('127.0.0.1', 8089, $errCode, $errStr, 1);
if (!$socket) {
    echo "Iniciando servidor PHP de prueba en puerto 8089...\n";
    $cmd = 'start /B C:\xampp\php\php.exe -S 127.0.0.1:8089 -t "c:\Users\User\Desktop\Quality-main\Quality-main"';
    pclose(popen($cmd, 'r'));
    sleep(2);
} else {
    fclose($socket);
}

// 1. Validar protección contra ejecución HTTP (siempre 403, sin excepciones ni tokens)
$cronWeb = httpGet("{$baseUrl}/backend/cron/process-fallback-queue.php");
assertTest("process-fallback-queue.php rechaza peticiones HTTP sin token con HTTP 403", $cronWeb['status'] === 403);

$cronWebToken = httpGet("{$baseUrl}/backend/cron/process-fallback-queue.php?token=random_secret_token_123");
assertTest("process-fallback-queue.php rechaza peticiones HTTP incluso si envían parámetro token (HTTP 403 SIEMPRE)", $cronWebToken['status'] === 403);

$cronIndex = httpGet("{$baseUrl}/backend/cron/index.php");
assertTest("backend/cron/index.php devuelve HTTP 403 Forbidden", $cronIndex['status'] === 403);
assertTest("backend/cron/.htaccess existe", file_exists(__DIR__ . '/../cron/.htaccess'));

// 2. Probar procesamiento de Contacto en cola
$queueDir = __DIR__ . '/../storage/fallback_queue';
$uniqueSuffix = bin2hex(random_bytes(4));

$testContactData = [
    'nombre'     => 'Contacto Test Queue ' . $uniqueSuffix,
    'telefono'   => '+51 988 111 222',
    'empresa'    => 'Constructora Alfa',
    'email'      => 'alfa_' . $uniqueSuffix . '@test.com',
    'consulta'   => 'Consulta de prueba de cola sincronizada ' . $uniqueSuffix,
    'ip_origen'  => '127.0.0.1',
    'user_agent' => 'PHPUnit Test',
];
$contactRes = FallbackQueue::save('contact', $testContactData);
assertTest("FallbackQueue genera archivo de contacto en disco", $contactRes['success'] && file_exists($contactRes['file_path']));

// Verificar que el payload contiene queue_id
$savedPayload = json_decode((string)file_get_contents($contactRes['file_path']), true);
$contactQueueId = $savedPayload['queue_id'] ?? '';
assertTest("FallbackQueue inyecta queue_id único en payload y datos", !empty($contactQueueId) && str_starts_with($contactQueueId, 'evt_contact_'));

// Ejecutar cron en CLI
$cronCmd = 'C:\xampp\php\php.exe ' . escapeshellarg(__DIR__ . '/../cron/process-fallback-queue.php');
$cronOutput = shell_exec($cronCmd);

assertTest("Cron procesó y eliminó el archivo de contacto de la cola", !file_exists($contactRes['file_path']));

if ($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `contactos` WHERE `queue_id` = :qid");
    $stmt->execute([':qid' => $contactQueueId]);
    $count = (int)$stmt->fetchColumn();
    assertTest("Contacto fue persistido exitosamente en tabla MySQL 'contactos' con su queue_id", $count === 1);
}

// 3. Probar Idempotencia basada en queue_id (Mismo queue_id reenviado)
// Re-encolamos intencionalmente el MISMO evento con el MISMO queue_id
$contactWithSameQueueId = $testContactData;
$contactWithSameQueueId['queue_id'] = $contactQueueId;
$resSameQueueId = FallbackQueue::save('contact', $contactWithSameQueueId);
assertTest("Se re-encola evento con el MISMO queue_id para probar idempotencia", $resSameQueueId['success'] && file_exists($resSameQueueId['file_path']));

$cronOutputDup = shell_exec($cronCmd);
assertTest("Cron detecta duplicado por queue_id y retira el archivo de disco", !file_exists($resSameQueueId['file_path']));

if ($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `contactos` WHERE `queue_id` = :qid");
    $stmt->execute([':qid' => $contactQueueId]);
    $countDup = (int)$stmt->fetchColumn();
    assertTest("Tabla 'contactos' no duplica el registro (mantiene exactamente 1)", $countDup === 1);
}

// 4. Probar Contactos legítimos idénticos con DIFERENTE queue_id
// Un cliente envía exactamente la misma consulta en dos momentos distintos
$repeatSuffix = bin2hex(random_bytes(4));
$repeatedContactA = [
    'nombre'     => 'Cliente Frecuente ' . $repeatSuffix,
    'telefono'   => '+51 977 333 444',
    'empresa'    => 'Minera del Sur SAC',
    'email'      => 'frecuente_' . $repeatSuffix . '@minera.com',
    'consulta'   => 'Solicito cotización de consultoría ambiental urgente.',
    'ip_origen'  => '127.0.0.1',
    'user_agent' => 'PHPUnit Test',
];
$resContactA = FallbackQueue::save('contact', $repeatedContactA);

// Segundo envío idéntico con unos segundos o milisegundos de diferencia (genera diferente queue_id)
$repeatedContactB = $repeatedContactA;
$resContactB = FallbackQueue::save('contact', $repeatedContactB);

assertTest("Se generan dos eventos de cola para el mismo cliente con diferente queue_id", 
    $resContactA['success'] && $resContactB['success'] && ($resContactA['file_path'] !== $resContactB['file_path']));

$cronOutputRepeat = shell_exec($cronCmd);

if ($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `contactos` WHERE `email` = :email");
    $stmt->execute([':email' => $repeatedContactA['email']]);
    $countRepeat = (int)$stmt->fetchColumn();
    assertTest("Ambos contactos legítimos independientes fueron persistidos en MySQL (count = 2)", $countRepeat === 2);
}

// 5. Probar procesamiento de Reclamación en cola
$claimCode = 'QCS-LR-CRON-' . strtoupper($uniqueSuffix);
$testClaimData = [
    'codigo_reclamacion'  => $claimCode,
    'nombre'              => 'Consumidor Test ' . $uniqueSuffix,
    'documento'           => '88776655',
    'email'               => 'consumidor_' . $uniqueSuffix . '@test.com',
    'telefono'            => '+51 999 888 777',
    'tipo'                => 'reclamo',
    'servicio'            => 'Supervisión de Obras Civiles',
    'detalle'             => 'Detalle formal del reclamo para prueba de sincronización.',
    'ip_origen'           => '127.0.0.1',
    'user_agent'          => 'PHPUnit Test',
];
$claimRes = FallbackQueue::save('claim', $testClaimData, $claimCode);
assertTest("FallbackQueue genera archivo de reclamación en disco", $claimRes['success'] && file_exists($claimRes['file_path']));

$cronOutputClaim = shell_exec($cronCmd);
assertTest("Cron procesó y eliminó el archivo de reclamación de la cola", !file_exists($claimRes['file_path']));

if ($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `libro_reclamaciones` WHERE `codigo_reclamacion` = :code");
    $stmt->execute([':code' => $claimCode]);
    $countClaim = (int)$stmt->fetchColumn();
    assertTest("Reclamación fue persistida exitosamente en tabla MySQL 'libro_reclamaciones'", $countClaim === 1);
}

// 6. Probar Recuperación Segura de Archivos Huérfanos (.processing)
// Simulamos una caída abrupta del cron dejando un archivo .processing con mtime en el pasado
$orphanSuffix = bin2hex(random_bytes(4));
$orphanContactData = [
    'nombre'     => 'Contacto Huerfano ' . $orphanSuffix,
    'telefono'   => '+51 911 000 999',
    'empresa'    => 'Rescate Corp',
    'email'      => 'huerfano_' . $orphanSuffix . '@rescate.com',
    'consulta'   => 'Consulta que quedó interrumpida en archivo .processing',
    'ip_origen'  => '127.0.0.1',
    'user_agent' => 'Crash Simulator',
];
$orphanRes = FallbackQueue::save('contact', $orphanContactData);
$orphanJsonPath = $orphanRes['file_path'];
$orphanProcPath = $orphanJsonPath . '.processing';

// Renombrar a .processing y simular antigüedad (> 300 segundos en el pasado)
rename($orphanJsonPath, $orphanProcPath);
touch($orphanProcPath, time() - 350);

assertTest("Se simuló archivo huérfano .processing de caída abrupta anterior", file_exists($orphanProcPath) && !file_exists($orphanJsonPath));

// Ejecutar cron
$cronOutputOrphan = shell_exec($cronCmd);

assertTest("Cron recuperó y procesó el archivo huérfano .processing", !file_exists($orphanProcPath) && !file_exists($orphanJsonPath));

if ($pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `contactos` WHERE `email` = :email");
    $stmt->execute([':email' => $orphanContactData['email']]);
    $countOrphan = (int)$stmt->fetchColumn();
    assertTest("Datos del archivo huérfano fueron persistidos en MySQL tras recuperación", $countOrphan === 1);
}

// 7. Verificar que la salida del cron no contenga secretos
assertTest("Salida del script cron no contiene contraseñas", 
    strpos((string)$cronOutput, 'password') === false && 
    strpos((string)$cronOutput, 'SMTP_') === false &&
    strpos((string)$cronOutputRepeat, 'password') === false);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE LA TAREA 7 PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS <<<\n";
    exit(1);
}

