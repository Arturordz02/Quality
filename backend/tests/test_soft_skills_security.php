<?php
/**
 * Test Suite: Tarea 3 - Seguridad de Evaluaciones y Bloqueo de Listado Público
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

function httpPost(string $url, array $data): array {
    $ctx = stream_context_create([
        'http' => [
            'method' => 'POST',
            'ignore_errors' => true,
            'timeout' => 5,
            'header' => "Content-Type: application/json\r\nAccept: application/json\r\n",
            'content' => json_encode($data)
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
echo "TEST SUITE: TAREA 3 - CIERRE DE LISTADO DE EVALUACIONES\n";
echo "======================================================\n\n";

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

// 1. Validar que action=list devuelva 403 Forbidden
$resList = httpGet("{$baseUrl}/backend/api/soft-skills.php?action=list");
assertTest(
    "Endpoint action=list devuelve HTTP 403 Forbidden",
    $resList['status'] === 403,
    "Código HTTP recibido: " . $resList['status']
);
assertTest(
    "Endpoint action=list devuelve JSON de error con acceso denegado",
    isset($resList['json']['success']) && $resList['json']['success'] === false && strpos($resList['json']['message'], 'denegado') !== false,
    "Respuesta: " . substr($resList['body'], 0, 150)
);
assertTest(
    "Endpoint action=list NO fuga información de candidatos ni evaluaciones",
    strpos($resList['body'], 'candidate_email') === false && strpos($resList['body'], 'candidate_name') === false,
    "Respuesta contenía datos privados."
);

// 2. Validar que action=questions sigue funcionando públicamente
$resQuestions = httpGet("{$baseUrl}/backend/api/soft-skills.php?action=questions");
assertTest(
    "Endpoint público action=questions devuelve HTTP 200 OK",
    $resQuestions['status'] === 200,
    "Código HTTP recibido: " . $resQuestions['status']
);
assertTest(
    "Endpoint público action=questions retorna preguntas situacionales sanitizadas",
    isset($resQuestions['json']['questions']) && count($resQuestions['json']['questions']) > 0,
    "Preguntas no encontradas en respuesta."
);
assertTest(
    "Endpoint público action=questions NO expone puntuaciones psicométricas secretas",
    strpos($resQuestions['body'], 'score_value') === false,
    "Fuga de score_value detectada."
);

// 3. Validar que action=submit sigue funcionando para procesar evaluaciones
$resSubmitInvalid = httpPost("{$baseUrl}/backend/api/soft-skills.php?action=submit", []);
assertTest(
    "Endpoint público action=submit valida payload y devuelve 422 si los datos están vacíos",
    $resSubmitInvalid['status'] === 422,
    "Código HTTP recibido: " . $resSubmitInvalid['status']
);

// 4. Validar que acciones desconocidas devuelvan 400 Bad Request
$resUnknown = httpGet("{$baseUrl}/backend/api/soft-skills.php?action=unknown_action_test");
assertTest(
    "Acción inválida devuelve HTTP 400 Bad Request",
    $resUnknown['status'] === 400,
    "Código HTTP recibido: " . $resUnknown['status']
);

// 5. Validar que otros formularios (send-contact.php y submit-claim.php) rechacen GET (405 Method Not Allowed)
$resContactGet = httpGet("{$baseUrl}/backend/send-contact.php");
assertTest(
    "send-contact.php rechaza peticiones GET con HTTP 405",
    $resContactGet['status'] === 405,
    "Código HTTP recibido: " . $resContactGet['status']
);

$resClaimGet = httpGet("{$baseUrl}/backend/submit-claim.php");
assertTest(
    "submit-claim.php rechaza peticiones GET con HTTP 405",
    $resClaimGet['status'] === 405,
    "Código HTTP recibido: " . $resClaimGet['status']
);

// 6. Validar método interno listEvaluationsInternal en SoftSkillsService
define('QCS_BACKEND_ACCESS', true);
$bootstrap = require __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../services/SoftSkillsService.php';
$service = new SoftSkillsService($bootstrap['config'], $bootstrap['cache'], $bootstrap['dbCircuitBreaker']);

assertTest(
    "SoftSkillsService posee el método interno listEvaluationsInternal",
    method_exists($service, 'listEvaluationsInternal'),
    "Método listEvaluationsInternal no existe en SoftSkillsService"
);

$internalList = $service->listEvaluationsInternal(5, 0);
assertTest(
    "Método interno listEvaluationsInternal responde estructura válida ['items', 'total']",
    is_array($internalList) && isset($internalList['items']) && isset($internalList['total']),
    "Estructura inválida devuelta"
);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS VALIDACIONES DE SEGURIDAD PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS VALIDACIONES <<<\n";
    exit(1);
}
