<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Suite de Verificación de Persistencia y Contingencia
 * Casos Obligatorios A, B, C, D, E, F
 * 
 * Ejecución: php backend/tests/test_persistence_cases.php
 */

declare(strict_types=1);

define('QCS_BACKEND_ACCESS', true);

require_once __DIR__ . '/../bootstrap.php';

// Helper para interceptar salidas JSON de Security::jsonSuccess y Security::jsonError
class TestResponseCatcher {
    public static ?int $lastHttpCode = null;
    public static ?array $lastJson = null;

    public static function capture(callable $callback): array {
        self::$lastHttpCode = 200;
        self::$lastJson = null;

        ob_start();
        try {
            $callback();
        } catch (\Throwable $e) {
            // Excepción no capturada
            self::$lastHttpCode = 500;
            self::$lastJson = ['success' => false, 'exception' => $e->getMessage()];
        }
        $output = ob_get_clean();

        if (self::$lastJson === null && !empty($output)) {
            $decoded = json_decode($output, true);
            if (is_array($decoded)) {
                self::$lastJson = $decoded;
            }
        }

        return [
            'http_code' => http_response_code() ?: 200,
            'json'      => self::$lastJson ?: ['raw' => $output],
        ];
    }
}

class PersistenceTester {
    private string $originalFallbackDir;
    private string $testFallbackDir;

    public function __construct() {
        $this->originalFallbackDir = __DIR__ . '/../storage/fallback_queue';
        $this->testFallbackDir = __DIR__ . '/../storage/test_cases_queue';
        if (!is_dir($this->testFallbackDir)) {
            @mkdir($this->testFallbackDir, 0775, true);
        }
        FallbackQueue::setQueueDir($this->testFallbackDir);
    }

    public function __destruct() {
        $this->cleanTestQueue();
        @rmdir($this->testFallbackDir);
        FallbackQueue::setQueueDir(null);
    }

    public function cleanTestQueue(): void {
        $files = glob($this->testFallbackDir . '/*');
        if ($files) {
            foreach ($files as $f) {
                if (is_file($f)) {
                    @chmod($f, 0777);
                    @unlink($f);
                }
            }
        }
        @chmod($this->testFallbackDir, 0775);
    }

    /**
     * Simula el flujo completo de persistencia de send-contact
     */
    public function processContact(array $config, array $cleanData, CircuitBreaker $dbCircuit): array {
        $dbSaved = false;
        $fallbackSaved = false;

        if (!empty($config['database']['enabled'])) {
            try {
                $dbSaved = (bool)$dbCircuit->execute(
                    function () use ($config, $cleanData) {
                        $pdo = Database::getConnection($config);
                        if (!$pdo) {
                            throw new \RuntimeException('No se pudo establecer conexión con MySQL: ' . (Database::getLastError() ?: 'Conexión nula'));
                        }
                        $saved = Database::saveContact($config, $cleanData);
                        if (!$saved) {
                            throw new \RuntimeException('No se pudo insertar el contacto en MySQL: ' . (Database::getLastError() ?: 'Error en consulta'));
                        }
                        return true;
                    },
                    function (\Throwable $e) use ($cleanData, &$fallbackSaved) {
                        $res = FallbackQueue::save('contact', $cleanData);
                        $fallbackSaved = $res['success'];
                        return false;
                    }
                );
            } catch (\Throwable $e) {
                if (!$fallbackSaved) {
                    $res = FallbackQueue::save('contact', $cleanData);
                    $fallbackSaved = $res['success'];
                }
            }
        } else {
            $res = FallbackQueue::save('contact', $cleanData);
            $fallbackSaved = $res['success'];
        }

        $isPersisted = ($dbSaved || $fallbackSaved);

        if (!$isPersisted) {
            return [
                'http_code' => 503,
                'json' => [
                    'success' => false,
                    'message' => 'No fue posible registrar su consulta debido a un problema técnico temporal en almacenamiento.'
                ],
                'db_saved' => false,
                'fallback_saved' => false,
                'mail_sent' => false
            ];
        }

        // Intento de envío SMTP (simulado con el driver configurado)
        $mailSent = false;
        if (!empty($config['mail']['enabled_simulation'])) {
            try {
                $mailer = new SmtpMailer($config);
                $mailSent = $mailer->send('test@dest.com', 'Subj', 'Body', 'from@test.com');
            } catch (\Throwable $e) {
                $mailSent = false;
            }
        }

        return [
            'http_code' => 200,
            'json' => [
                'success' => true,
                'message' => '¡Consulta registrada con éxito!',
                'db_saved' => $dbSaved,
                'fallback_saved' => $fallbackSaved,
                'mail_sent' => $mailSent
            ],
            'db_saved' => $dbSaved,
            'fallback_saved' => $fallbackSaved,
            'mail_sent' => $mailSent
        ];
    }

    /**
     * Simula el flujo completo de persistencia de submit-claim
     */
    public function processClaim(array $config, array $cleanData, CircuitBreaker $dbCircuit): array {
        $dbSaved = false;
        $fallbackSaved = false;
        $codigoReclamacion = $cleanData['codigo_reclamacion'];

        if (!empty($config['database']['enabled'])) {
            try {
                $dbSaved = (bool)$dbCircuit->execute(
                    function () use ($config, $cleanData) {
                        $pdo = Database::getConnection($config);
                        if (!$pdo) {
                            throw new \RuntimeException('No se pudo establecer conexión con MySQL: ' . (Database::getLastError() ?: 'Conexión nula'));
                        }
                        $saved = Database::saveClaim($config, $cleanData);
                        if (!$saved) {
                            throw new \RuntimeException('No se pudo insertar la reclamación en MySQL: ' . (Database::getLastError() ?: 'Error en consulta'));
                        }
                        return true;
                    },
                    function (\Throwable $e) use ($cleanData, $codigoReclamacion, &$fallbackSaved) {
                        $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
                        $fallbackSaved = $res['success'];
                        return false;
                    }
                );
            } catch (\Throwable $e) {
                if (!$fallbackSaved) {
                    $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
                    $fallbackSaved = $res['success'];
                }
            }
        } else {
            $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
            $fallbackSaved = $res['success'];
        }

        $isPersisted = ($dbSaved || $fallbackSaved);

        if (!$isPersisted) {
            return [
                'http_code' => 503,
                'json' => [
                    'success' => false,
                    'message' => 'No fue posible registrar su hoja de reclamación.'
                ],
                'db_saved' => false,
                'fallback_saved' => false,
                'mail_sent' => false
            ];
        }

        return [
            'http_code' => 200,
            'json' => [
                'success' => true,
                'claim_code' => $codigoReclamacion,
                'db_saved' => $dbSaved,
                'fallback_saved' => $fallbackSaved,
            ],
            'db_saved' => $dbSaved,
            'fallback_saved' => $fallbackSaved,
        ];
    }

    public function runAllCases(): array {
        $reports = [];
        $baseConfig = require __DIR__ . '/../config.php';
        $circuit = new CircuitBreaker('test_persistence_cb', 3, 10, 1);

        // =========================================================================
        // CASO A: BD activa + BD funcionando
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        $configA = $baseConfig;
        $configA['database']['enabled'] = true;
        $configA['database']['host'] = '127.0.0.1';
        $configA['database']['port'] = 3306;
        $configA['database']['user'] = 'root';
        $configA['database']['password'] = '';
        $configA['database']['name'] = 'quality_web';

        $dataA = [
            'nombre'     => 'Caso A Test Contact',
            'telefono'   => '+51 999 000 001',
            'empresa'    => 'Constructora Caso A SAC',
            'email'      => 'casoa@test.com',
            'consulta'   => 'Consulta de prueba Caso A con BD activa',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $pdoA = @Database::getConnection($configA);
        if (!$pdoA) {
            $reports['CASO_A'] = [
                'titulo' => 'Caso A: BD activa + BD funcionando',
                'esperado' => 'success=true, HTTP 200, guardado en MySQL (db_saved=true, fallback_saved=false)',
                'obtenido' => 'OMITIDO: Servidor MySQL inactivo en entorno local',
                'http_status' => 'SKIP',
                'registro_creado' => 'OMITIDO (Requiere MySQL activo)',
                'skip' => true,
                'exito' => true,
            ];
        } else {
            $resA = $this->processContact($configA, $dataA, $circuit);
            
            // Verificar en BD MySQL
            $stmtA = $pdoA->prepare("SELECT COUNT(*) FROM `contactos` WHERE `email` = :email");
            $stmtA->execute([':email' => $dataA['email']]);
            $countA = (int)$stmtA->fetchColumn();

            $reports['CASO_A'] = [
                'titulo' => 'Caso A: BD activa + BD funcionando',
                'esperado' => 'success=true, HTTP 200, guardado en MySQL (db_saved=true, fallback_saved=false)',
                'obtenido' => sprintf(
                    'success=%s, db_saved=%s, fallback_saved=%s',
                    $resA['json']['success'] ? 'true' : 'false',
                    $resA['db_saved'] ? 'true' : 'false',
                    $resA['fallback_saved'] ? 'true' : 'false'
                ),
                'http_status' => $resA['http_code'],
                'registro_creado' => ($countA > 0) ? "SÍ (Verificado en tabla MySQL 'contactos', total: {$countA})" : 'NO',
                'exito' => ($resA['http_code'] === 200 && $resA['json']['success'] === true && $countA > 0 && $resA['db_saved'] === true),
            ];
        }

        // =========================================================================
        // CASO B: BD desactivada + fallback funcionando
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        $configB = $baseConfig;
        $configB['database']['enabled'] = false; // BD DESACTIVADA

        $dataB = [
            'nombre'     => 'Caso B Test Contact',
            'telefono'   => '+51 999 000 002',
            'empresa'    => 'Constructora Caso B SAC',
            'email'      => 'casob@test.com',
            'consulta'   => 'Consulta de prueba Caso B con BD desactivada',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $resB = $this->processContact($configB, $dataB, $circuit);

        // Verificar en cola de contingencia (archivos en disco)
        $filesB = glob($this->testFallbackDir . '/contact_*.json');
        $fileCreatedB = !empty($filesB) && file_exists($filesB[0]) && (filesize($filesB[0]) > 0);

        $reports['CASO_B'] = [
            'titulo' => 'Caso B: BD desactivada + fallback funcionando',
            'esperado' => 'success=true, HTTP 200, guardado en fallback_queue (db_saved=false, fallback_saved=true)',
            'obtenido' => sprintf(
                'success=%s, db_saved=%s, fallback_saved=%s',
                $resB['json']['success'] ? 'true' : 'false',
                $resB['db_saved'] ? 'true' : 'false',
                $resB['fallback_saved'] ? 'true' : 'false'
            ),
            'http_status' => $resB['http_code'],
            'registro_creado' => $fileCreatedB ? "SÍ (Archivo verificado: " . basename($filesB[0]) . ", " . filesize($filesB[0]) . " bytes)" : 'NO',
            'exito' => ($resB['http_code'] === 200 && $resB['json']['success'] === true && $fileCreatedB && $resB['fallback_saved'] === true),
        ];

        // =========================================================================
        // CASO C: BD caída + fallback funcionando
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        $configC = $baseConfig;
        $configC['database']['enabled'] = true;
        $configC['database']['port'] = 9999; // PUERTO INVÁLIDO (Simula BD caída)

        $dataC = [
            'nombre'     => 'Caso C Test Contact',
            'telefono'   => '+51 999 000 003',
            'empresa'    => 'Constructora Caso C SAC',
            'email'      => 'casoc@test.com',
            'consulta'   => 'Consulta de prueba Caso C con BD caída por timeout',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $resC = $this->processContact($configC, $dataC, $circuit);

        $filesC = glob($this->testFallbackDir . '/contact_*.json');
        $fileCreatedC = !empty($filesC) && file_exists($filesC[0]) && (filesize($filesC[0]) > 0);

        $reports['CASO_C'] = [
            'titulo' => 'Caso C: BD caída + fallback funcionando',
            'esperado' => 'Circuit Breaker captura fallo, ejecuta fallback, success=true, HTTP 200, guardado en fallback_queue',
            'obtenido' => sprintf(
                'success=%s, db_saved=%s, fallback_saved=%s',
                $resC['json']['success'] ? 'true' : 'false',
                $resC['db_saved'] ? 'true' : 'false',
                $resC['fallback_saved'] ? 'true' : 'false'
            ),
            'http_status' => $resC['http_code'],
            'registro_creado' => $fileCreatedC ? "SÍ (Archivo verificado: " . basename($filesC[0]) . ", " . filesize($filesC[0]) . " bytes)" : 'NO',
            'exito' => ($resC['http_code'] === 200 && $resC['json']['success'] === true && $fileCreatedC && $resC['fallback_saved'] === true),
        ];

        // =========================================================================
        // CASO D: BD caída + fallback sin permisos de escritura
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        // Simular directorio sin permisos de escritura usando ruta inválida no creable
        $invalidDir = 'Z:/directorio_inexistente_sin_permisos_' . uniqid();
        FallbackQueue::setQueueDir($invalidDir);

        $configD = $baseConfig;
        $configD['database']['enabled'] = true;
        $configD['database']['port'] = 9999; // BD CAÍDA

        $dataD = [
            'nombre'     => 'Caso D Test Contact',
            'telefono'   => '+51 999 000 004',
            'empresa'    => 'Constructora Caso D SAC',
            'email'      => 'casod@test.com',
            'consulta'   => 'Consulta Caso D con falla en BD y sin permisos en disco',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $resD = $this->processContact($configD, $dataD, $circuit);

        // Restaurar ruta de prueba
        FallbackQueue::setQueueDir($this->testFallbackDir);

        $reports['CASO_D'] = [
            'titulo' => 'Caso D: BD caída + fallback sin permisos de escritura',
            'esperado' => 'success=false, HTTP 503, NO se afirma registro exitoso, error controlado',
            'obtenido' => sprintf(
                'success=%s, mensaje="%s"',
                $resD['json']['success'] ? 'true' : 'false',
                $resD['json']['message'] ?? ''
            ),
            'http_status' => $resD['http_code'],
            'registro_creado' => 'NO (Imposible escribir en disco y BD no disponible)',
            'exito' => ($resD['http_code'] === 503 && $resD['json']['success'] === false),
        ];

        // =========================================================================
        // CASO E: SMTP caído + almacenamiento funcionando
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        $configE = $baseConfig;
        $configE['database']['enabled'] = true;
        $configE['database']['host'] = '127.0.0.1';
        $configE['database']['port'] = 3306;
        $configE['database']['user'] = 'root';
        $configE['database']['password'] = '';
        $configE['database']['name'] = 'quality_web';

        // Configurar SMTP inválido para forzar caída de correo
        $configE['mail']['enabled_simulation'] = true;
        $configE['mail']['host'] = '127.0.0.1';
        $configE['mail']['port'] = 9925; // PUERTO SMTP INEXISTENTE

        $dataE = [
            'nombre'     => 'Caso E Test Contact',
            'telefono'   => '+51 999 000 005',
            'empresa'    => 'Constructora Caso E SAC',
            'email'      => 'casoe@test.com',
            'consulta'   => 'Consulta Caso E con SMTP caído pero BD activa',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $pdoE = @Database::getConnection($configE);
        if (!$pdoE) {
            $reports['CASO_E'] = [
                'titulo' => 'Caso E: SMTP caído + almacenamiento funcionando',
                'esperado' => 'success=true, HTTP 200, guardado en BD, mail_sent=false (SMTP no bloquea persistencia)',
                'obtenido' => 'OMITIDO: Servidor MySQL inactivo en entorno local',
                'http_status' => 'SKIP',
                'registro_creado' => 'OMITIDO (Requiere MySQL activo)',
                'skip' => true,
                'exito' => true,
            ];
        } else {
            $resE = $this->processContact($configE, $dataE, $circuit);

            // Verificar en BD
            $stmtE = $pdoE->prepare("SELECT COUNT(*) FROM `contactos` WHERE `email` = :email");
            $stmtE->execute([':email' => $dataE['email']]);
            $countE = (int)$stmtE->fetchColumn();

            $reports['CASO_E'] = [
                'titulo' => 'Caso E: SMTP caído + almacenamiento funcionando',
                'esperado' => 'success=true, HTTP 200, guardado en BD, mail_sent=false (SMTP no bloquea persistencia)',
                'obtenido' => sprintf(
                    'success=%s, db_saved=%s, mail_sent=%s',
                    $resE['json']['success'] ? 'true' : 'false',
                    $resE['db_saved'] ? 'true' : 'false',
                    $resE['mail_sent'] ? 'true' : 'false'
                ),
                'http_status' => $resE['http_code'],
                'registro_creado' => ($countE > 0) ? "SÍ (Verificado en tabla MySQL 'contactos', total: {$countE})" : 'NO',
                'exito' => ($resE['http_code'] === 200 && $resE['json']['success'] === true && $countE > 0 && $resE['mail_sent'] === false),
            ];
        }

        // =========================================================================
        // CASO F: BD + fallback fallando
        // =========================================================================
        $this->cleanTestQueue();
        Database::resetConnection();
        $circuit->reset();

        // Ruta de cola inválida
        FallbackQueue::setQueueDir('X:/directorio_invalido_caso_f_' . uniqid());

        $configF = $baseConfig;
        $configF['database']['enabled'] = true;
        $configF['database']['port'] = 9998; // BD CAÍDA

        // Simular que email sí saldría si no estuviera protegido
        $configF['mail']['enabled_simulation'] = false;

        $dataF = [
            'nombre'     => 'Caso F Test Contact',
            'telefono'   => '+51 999 000 006',
            'empresa'    => 'Constructora Caso F SAC',
            'email'      => 'casof@test.com',
            'consulta'   => 'Consulta Caso F con falla total de almacenamiento',
            'ip_origen'  => '127.0.0.1',
            'user_agent' => 'TestRunner',
        ];

        $resF = $this->processContact($configF, $dataF, $circuit);

        // Restaurar ruta
        FallbackQueue::setQueueDir($this->testFallbackDir);

        $reports['CASO_F'] = [
            'titulo' => 'Caso F: BD + fallback fallando (Falla total de almacenamiento)',
            'esperado' => 'success=false, HTTP 503, respuesta de error controlado (Requisitos 1, 3, 4 y 6)',
            'obtenido' => sprintf(
                'success=%s, HTTP %d, mensaje="%s"',
                $resF['json']['success'] ? 'true' : 'false',
                $resF['http_code'],
                $resF['json']['message'] ?? ''
            ),
            'http_status' => $resF['http_code'],
            'registro_creado' => 'NO (Ambos medios de persistencia fallaron)',
            'exito' => ($resF['http_code'] === 503 && $resF['json']['success'] === false),
        ];

        // =========================================================================
        // PRUEBA ADICIONAL DE RECLAMACIÓN (submit-claim.php) - CASO B (BD Desactivada)
        // =========================================================================
        $this->cleanTestQueue();
        $claimCode = 'QCS-LR-' . date('Ym') . '-TST01';
        $claimData = [
            'codigo_reclamacion' => $claimCode,
            'nombre'             => 'Consumidor Reclamante Test',
            'documento'          => '44556677',
            'email'              => 'reclamante@test.com',
            'telefono'           => '+51 999 111 222',
            'tipo'               => 'reclamo',
            'servicio'           => 'Curso Gestión PMO',
            'detalle'            => 'Detalle de prueba para verificación de persistencia en libro de reclamaciones.',
            'ip_origen'          => '127.0.0.1',
            'user_agent'         => 'TestRunner',
        ];

        $resClaim = $this->processClaim($configB, $claimData, $circuit);
        $claimFile = $this->testFallbackDir . '/claim_' . $claimCode . '.json';
        $claimCreated = file_exists($claimFile) && (filesize($claimFile) > 0);

        $reports['RECLAMO_FALLBACK'] = [
            'titulo' => 'Reclamación: BD desactivada + persistencia en fallback_queue',
            'esperado' => 'claim_code presente, success=true, HTTP 200, archivo JSON en disco',
            'obtenido' => sprintf('success=%s, claim_code=%s', $resClaim['json']['success'] ? 'true' : 'false', $resClaim['json']['claim_code'] ?? 'none'),
            'http_status' => $resClaim['http_code'],
            'registro_creado' => $claimCreated ? "SÍ (Archivo: " . basename($claimFile) . ", " . filesize($claimFile) . " bytes)" : 'NO',
            'exito' => ($resClaim['http_code'] === 200 && $claimCreated),
        ];

        return $reports;
    }
}

// Ejecución
echo "======================================================================\n";
echo "   EJECUTANDO PRUEBAS OBLIGATORIAS DE PERSISTENCIA Y CONTINGENCIA     \n";
echo "======================================================================\n\n";

$tester = new PersistenceTester();
$results = $tester->runAllCases();

$allPassed = true;
$passedCount = 0;
$skippedCount = 0;
$failedCount = 0;

foreach ($results as $key => $r) {
    if (!empty($r['skip'])) {
        $statusText = '[OMITIDO/SKIP]';
        $skippedCount++;
    } elseif ($r['exito']) {
        $statusText = '[PASÓ]';
        $passedCount++;
    } else {
        $statusText = '[FALLÓ]';
        $failedCount++;
        $allPassed = false;
    }
    echo "----------------------------------------------------------------------\n";
    echo "{$statusText} {$r['titulo']}\n";
    echo "  - Resultado Esperado : {$r['esperado']}\n";
    echo "  - Resultado Obtenido : {$r['obtenido']}\n";
    echo "  - HTTP Status        : {$r['http_status']}\n";
    echo "  - Registro Creado    : {$r['registro_creado']}\n";
}

echo "\n======================================================================\n";
echo "RESULTADOS: {$passedCount} pasadas, {$skippedCount} omitidas, {$failedCount} fallidas.\n";
if ($allPassed && $failedCount === 0) {
    echo "   ¡TODOS LOS CASOS EVALUABLES PASARON AL 100%!  \n";
} else {
    echo "   ATENCIÓN: Se detectaron fallos en la prueba de persistencia.       \n";
}
echo "======================================================================\n";

exit(($allPassed && $failedCount === 0) ? 0 : 1);

