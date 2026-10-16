<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * CLI / Cron Task: Procesador de Cola de Contingencia (Fallback Queue Processor)
 *
 * Sincroniza y persiste de manera idempotente los registros guardados en disco
 * (contactos, reclamaciones y evaluaciones) cuando la base de datos MySQL está operativa.
 *
 * Uso CLI (Recomendado para Cron de cPanel / GoDaddy):
 *   /usr/local/bin/php /home/usuario/public_html/backend/cron/process-fallback-queue.php
 *
 * Uso Web Seguro (Solo si se requiere ejecución por webhook/URL externa con token):
 *   https://tudominio.com/backend/cron/process-fallback-queue.php?token=TU_TOKEN_SECRETO
 */

declare(strict_types=1);

define('QCS_BACKEND_ACCESS', true);

$bootstrap = require dirname(__DIR__) . '/bootstrap.php';
$config = $bootstrap['config'];

// 1. Verificación de Seguridad y Protección de Acceso
// El script SOLO puede ser ejecutado vía CLI (cron de cPanel / GoDaddy).
// Cualquier petición vía HTTP es rechazada de manera inmediata e incondicional con HTTP 403 Forbidden.
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'status'  => 403,
        'message' => 'Acceso denegado. Este script solo puede ser ejecutado mediante línea de comandos (CLI).'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit(1);
}

// 2. Comprobar Disponibilidad de Base de Datos
$dbConfig = $config['database'] ?? [];
if (empty($dbConfig['enabled'])) {
    echo "[INFO] Base de datos deshabilitada en la configuración (DB_ENABLED=false). No se procesó la cola.\n";
    exit(0);
}

$pdo = Database::getConnection($config);
if (!$pdo) {
    $err = 'Base de datos no disponible temporalmente (' . (Database::getLastError() ?: 'Conexión nula') . '). Reintento pospuesto.';
    error_log('[QCS FallbackQueue Processor] ' . $err);
    echo "[SKIP] {$err}\n";
    exit(0);
}

// 3. Prevenir Ejecución Concurrente Múltiple Mediante Lock File Exclusivo
$queueDir = dirname(__DIR__) . '/storage/fallback_queue';
if (!is_dir($queueDir)) {
    echo "[INFO] Directorio de cola no existe o está vacío.\n";
    exit(0);
}

$lockFilePath = $queueDir . '/.cron.lock';
$lockHandle = fopen($lockFilePath, 'c+');
if (!$lockHandle || !flock($lockHandle, LOCK_EX | LOCK_NB)) {
    echo "[LOCKED] Otra instancia del procesador de cola de contingencia se encuentra en ejecución activa. Omitiendo corrida.\n";
    exit(0);
}

// 4. Recuperación Segura de Archivos Huérfanos (.processing)
// Si una ejecución previa murió abruptamente (ej. timeout, kill del sistema),
// los archivos que quedaron en .processing se restauran a .json si superaron
// el umbral de antigüedad y no están bloqueados por ningún descriptor abierto.
$staleThreshold = (int)(getenv('CRON_STALE_PROCESSING_SECONDS') ?: 300); // 5 minutos por defecto
$orphanFiles = glob($queueDir . '/*.processing');
$recoveredCount = 0;
if ($orphanFiles) {
    $now = time();
    foreach ($orphanFiles as $procFile) {
        if (!is_file($procFile)) {
            continue;
        }
        $mtime = @filemtime($procFile) ?: 0;
        if (($now - $mtime) >= $staleThreshold) {
            // Verificar que ningún proceso mantenga un bloqueo activo en el archivo
            $fh = @fopen($procFile, 'r+');
            if ($fh) {
                if (flock($fh, LOCK_EX | LOCK_NB)) {
                    flock($fh, LOCK_UN);
                    fclose($fh);
                    $originalJson = preg_replace('/\.processing$/', '', $procFile);
                    if (!file_exists($originalJson)) {
                        if (@rename($procFile, $originalJson)) {
                            @touch($originalJson);
                            $recoveredCount++;
                            error_log("[QCS FallbackQueue Processor] Archivo huérfano recuperado: " . basename($originalJson));
                        }
                    }
                } else {
                    fclose($fh);
                }
            }
        }
    }
}

// 5. Escaneo de Archivos de Contingencia en Disco
$stats = [
    'total_files' => 0,
    'recovered'   => $recoveredCount,
    'processed'   => 0,
    'duplicates'  => 0,
    'failed'      => 0,
    'skipped'     => 0,
    'details'     => [],
];

$rawFiles = glob($queueDir . '/*.json');
if (!$rawFiles) {
    $rawFiles = [];
}

$stats['total_files'] = count($rawFiles);

foreach ($rawFiles as $filePath) {
    $fileName = basename($filePath);

    // Omitir archivos no correspondientes a la cola
    if ($fileName === 'index.php' || str_ends_with($fileName, '.processing')) {
        continue;
    }

    // Adquisición atómica del archivo renombrándolo a .processing
    $processingFile = $filePath . '.processing';
    if (!@rename($filePath, $processingFile)) {
        // Otro hilo tomó el archivo o está ocupado
        continue;
    }

    $rawContent = @file_get_contents($processingFile);
    if (empty($rawContent)) {
        @rename($processingFile, $filePath);
        $stats['skipped']++;
        continue;
    }

    $payload = json_decode($rawContent, true);
    if (!is_array($payload)) {
        // Archivo JSON corrupto: revertir y reportar
        @rename($processingFile, $filePath);
        $stats['failed']++;
        error_log("[QCS FallbackQueue Processor] JSON corrupto o ilegible en: {$fileName}");
        continue;
    }

    // 5. Detección y Procesamiento Idempotente del Tipo de Registro
    $success = false;
    $isDuplicate = false;
    $recordType = detectRecordType($fileName, $payload);

    try {
        switch ($recordType) {
            case 'contact':
                $contactData = $payload['data'] ?? $payload;
                if (empty($contactData['queue_id']) && !empty($payload['queue_id'])) {
                    $contactData['queue_id'] = $payload['queue_id'];
                }
                $res = processContact($pdo, $config, $contactData);
                $success = $res['success'];
                $isDuplicate = $res['is_duplicate'];
                break;

            case 'claim':
                $claimData = $payload['data'] ?? $payload;
                $claimCode = $payload['id'] ?? ($claimData['codigo_reclamacion'] ?? null);
                if ($claimCode && empty($claimData['codigo_reclamacion'])) {
                    $claimData['codigo_reclamacion'] = $claimCode;
                }
                $res = processClaim($pdo, $config, $claimData);
                $success = $res['success'];
                $isDuplicate = $res['is_duplicate'];
                break;

            case 'soft-skills':
                $reportData = $payload['report'] ?? ($payload['data']['report'] ?? []);
                $answersData = $payload['answers'] ?? ($payload['data']['answers'] ?? []);
                $res = processSoftSkillsEvaluation($pdo, $reportData, $answersData);
                $success = $res['success'];
                $isDuplicate = $res['is_duplicate'];
                break;

            case 'paypal_first_class':
                $paypalData = $payload['data'] ?? $payload;
                $res = processPaypalFirstClassRegistration($pdo, $config, $paypalData);
                $success = $res['success'];
                $isDuplicate = $res['is_duplicate'];
                break;

            default:
                // Tipo desconocido
                error_log("[QCS FallbackQueue Processor] Formato desconocido para {$fileName}");
                $stats['skipped']++;
                @rename($processingFile, $filePath);
                continue 2;
        }

        if ($success) {
            // Eliminación segura del archivo procesado en disco
            @unlink($processingFile);
            if ($isDuplicate) {
                $stats['duplicates']++;
                $stats['details'][] = "{$fileName} [{$recordType}]: Registro duplicado previamente existente. Archivo retirado de la cola.";
            } else {
                $stats['processed']++;
                $stats['details'][] = "{$fileName} [{$recordType}]: Guardado exitosamente en MySQL.";
            }
        } else {
            // Fallo en la persistencia: Restaurar nombre original para próximo intento
            @rename($processingFile, $filePath);
            $stats['failed']++;
            error_log("[QCS FallbackQueue Processor] Fallo al sincronizar {$fileName}");
        }
    } catch (\Throwable $e) {
        @rename($processingFile, $filePath);
        $stats['failed']++;
        error_log("[QCS FallbackQueue Processor Exception] {$fileName}: " . $e->getMessage());
    }
}

// 6. Liberación del Cerrojo
flock($lockHandle, LOCK_UN);
fclose($lockHandle);

// 7. Emisión de Reporte de Ejecución (Solo CLI)
echo "======================================================\n";
echo "  QUALITY CONSULTING SOLUTIONS - FALLBACK QUEUE CRON  \n";
echo "======================================================\n";
if ($stats['recovered'] > 0) {
    echo "Huérfanos recuperados: {$stats['recovered']}\n";
}
echo "Archivos evaluados  : {$stats['total_files']}\n";
echo "Procesados a MySQL  : {$stats['processed']}\n";
echo "Duplicados limpiados: {$stats['duplicates']}\n";
echo "Fallos retenidos    : {$stats['failed']}\n";
echo "Omitidos / Ignorados: {$stats['skipped']}\n";
if (!empty($stats['details'])) {
    echo "\nDetalle:\n";
    foreach ($stats['details'] as $detail) {
        echo " - {$detail}\n";
    }
}
echo "======================================================\n";
echo "Ejecución finalizada con éxito.\n";

// ==============================================================================
// FUNCIONES AUXILIARES DE PROCESAMIENTO E IDEMPOTENCIA
// ==============================================================================

/**
 * Detecta el tipo de registro de forma robusta por metadata o nombre de archivo
 */
function detectRecordType(string $fileName, array $payload): string {
    $type = $payload['type'] ?? '';
    if (!empty($type)) {
        if ($type === 'contact') return 'contact';
        if ($type === 'claim') return 'claim';
        if (in_array($type, ['soft-skills', 'evaluation', 'eval'], true)) return 'soft-skills';
        if ($type === 'paypal_first_class') return 'paypal_first_class';
    }

    if (str_starts_with($fileName, 'contact_')) return 'contact';
    if (str_starts_with($fileName, 'claim_')) return 'claim';
    if (str_starts_with($fileName, 'eval_') || isset($payload['report'])) return 'soft-skills';
    if (str_starts_with($fileName, 'paypal_first_class_')) return 'paypal_first_class';

    return 'unknown';
}

/**
 * Procesa un registro de contacto con verificación previa de duplicados basada en queue_id
 */
function processContact(PDO $pdo, array $config, array $data): array {
    if (empty($data['email']) || empty($data['nombre'])) {
        return ['success' => false, 'is_duplicate' => false];
    }

    $queueId = $data['queue_id'] ?? null;
    if (!empty($queueId)) {
        // Idempotencia por identidad de evento: Si el queue_id ya existe en la BD, se descarta como duplicado
        $checkSql = "SELECT id FROM `contactos` WHERE `queue_id` = :qid LIMIT 1";
        $stmt = $pdo->prepare($checkSql);
        $stmt->execute([':qid' => $queueId]);
        if ($stmt->fetch()) {
            return ['success' => true, 'is_duplicate' => true];
        }
    }

    $saved = Database::saveContact($config, $data);
    return ['success' => $saved, 'is_duplicate' => false];
}

/**
 * Procesa un registro de reclamo con verificación previa de código único
 */
function processClaim(PDO $pdo, array $config, array $data): array {
    $code = $data['codigo_reclamacion'] ?? '';
    if (empty($code)) {
        return ['success' => false, 'is_duplicate' => false];
    }

    // Idempotencia: Verificar si el código de reclamación ya está registrado
    $checkSql = "SELECT id FROM `libro_reclamaciones` WHERE `codigo_reclamacion` = :codigo LIMIT 1";
    $stmt = $pdo->prepare($checkSql);
    $stmt->execute([':codigo' => $code]);

    if ($stmt->fetch()) {
        return ['success' => true, 'is_duplicate' => true];
    }

    $saved = Database::saveClaim($config, $data);
    return ['success' => $saved, 'is_duplicate' => false];
}

/**
 * Procesa una evaluación de habilidades blandas con inserción atómica
 */
function processSoftSkillsEvaluation(PDO $pdo, array $report, array $answers): array {
    $candidate = $report['candidate'] ?? [];
    $summary = $report['summary'] ?? [];
    $completedAt = $summary['completed_at'] ?? date('Y-m-d H:i:s');

    if (empty($candidate['name']) || empty($candidate['email'])) {
        return ['success' => false, 'is_duplicate' => false];
    }

    // Asegurar catálogo de preguntas situacionales en MySQL si está vacío
    ensureSoftSkillsCatalog($pdo);

    // Idempotencia: Verificar si la evaluación ya fue ingresada
    $checkSql = "SELECT id FROM `soft_skills_evaluations` 
                 WHERE `candidate_email` = :email AND `candidate_name` = :name AND `completed_at` = :completed 
                 LIMIT 1";
    $stmt = $pdo->prepare($checkSql);
    $stmt->execute([
        ':email'     => $candidate['email'],
        ':name'      => $candidate['name'],
        ':completed' => $completedAt,
    ]);

    if ($stmt->fetch()) {
        return ['success' => true, 'is_duplicate' => true];
    }

    // Transacción atómica para evaluación, resultados dimensionales y respuestas
    $pdo->beginTransaction();
    try {
        $stmtEval = $pdo->prepare(
            "INSERT INTO `soft_skills_evaluations` 
            (`test_id`, `candidate_name`, `candidate_email`, `candidate_phone`, `candidate_role`, 
             `total_score`, `max_score`, `percentage`, `performance_level`, `completed_at`, `ip_origen`, `user_agent`) 
            VALUES (1, :name, :email, :phone, :role, :total, :max, :pct, :level, :completed, :ip, :ua)"
        );

        $stmtEval->execute([
            ':name'      => $candidate['name'],
            ':email'     => $candidate['email'],
            ':phone'     => $candidate['phone'] ?? '',
            ':role'      => $candidate['role'] ?? 'General',
            ':total'     => $summary['total_score'] ?? 0,
            ':max'       => $summary['max_score'] ?? 0,
            ':pct'       => $summary['percentage'] ?? 0,
            ':level'     => $summary['performance_level'] ?? 'inicial',
            ':completed' => $completedAt,
            ':ip'        => $report['ip_origen'] ?? '127.0.0.1',
            ':ua'        => $report['user_agent'] ?? 'QCS Fallback Cron Worker',
        ]);

        $evalId = (int)$pdo->lastInsertId();

        // Guardar dimensiones analíticas
        if (!empty($report['dimensions']) && is_array($report['dimensions'])) {
            $stmtRes = $pdo->prepare(
                "INSERT INTO `soft_skills_evaluation_results` 
                (`evaluation_id`, `dimension`, `score_obtained`, `score_max`, `percentage`, `level`, `strengths`, `recommendations`) 
                VALUES (:eval_id, :dim, :obtained, :max, :pct, :level, :strengths, :recom)"
            );
            foreach ($report['dimensions'] as $dimKey => $dim) {
                $stmtRes->execute([
                    ':eval_id'   => $evalId,
                    ':dim'       => $dimKey,
                    ':obtained'  => $dim['score_obtained'] ?? 0,
                    ':max'       => $dim['score_max'] ?? 0,
                    ':pct'       => $dim['percentage'] ?? 0,
                    ':level'     => $dim['level'] ?? '',
                    ':strengths' => $dim['strengths'] ?? '',
                    ':recom'     => $dim['recommendations'] ?? '',
                ]);
            }
        }

        // Guardar respuestas seleccionadas
        if (!empty($answers) && is_array($answers)) {
            $stmtAns = $pdo->prepare(
                "INSERT INTO `soft_skills_evaluation_answers` 
                (`evaluation_id`, `question_id`, `selected_option_id`, `score_value`) 
                VALUES (:eval_id, :qid, :opt_id, :score)"
            );
            foreach ($answers as $ans) {
                $qid = (int)($ans['question_id'] ?? 0);
                $optId = (int)($ans['selected_option_id'] ?? 0);
                if ($qid <= 0 || $optId <= 0) {
                    continue;
                }
                try {
                    $stmtAns->execute([
                        ':eval_id' => $evalId,
                        ':qid'     => $qid,
                        ':opt_id'  => $optId,
                        ':score'   => $ans['score_value'] ?? 0,
                    ]);
                } catch (\Throwable $errAns) {
                    error_log('[QCS Fallback Answer Skip] ' . $errAns->getMessage());
                }
            }
        }

        $pdo->commit();
        return ['success' => true, 'is_duplicate' => false];
    } catch (\Throwable $e) {
        $pdo->rollBack();
        error_log('[QCS Fallback Processor Evaluation Error] ' . $e->getMessage());
        return ['success' => false, 'is_duplicate' => false];
    }
}

/**
 * Asegura la existencia del banco de preguntas en MySQL si la tabla está vacía
 */
function ensureSoftSkillsCatalog(PDO $pdo): void {
    try {
        $count = (int)$pdo->query("SELECT COUNT(*) FROM `soft_skills_questions`")->fetchColumn();
        if ($count > 0) {
            return;
        }

        require_once dirname(__DIR__) . '/services/SoftSkillsService.php';
        $questions = SoftSkillsService::getDefaultSituationalBank();

        $stmtQ = $pdo->prepare("INSERT INTO `soft_skills_questions` 
            (`id`, `test_id`, `dimension`, `scenario`, `question_text`, `weight`, `order_num`, `is_active`) 
            VALUES (:id, 1, :dim, :scenario, :qtext, :weight, :order_num, 1)
            ON DUPLICATE KEY UPDATE `id` = VALUES(`id`)");

        $stmtOpt = $pdo->prepare("INSERT INTO `soft_skills_options` 
            (`id`, `question_id`, `option_text`, `score_value`) 
            VALUES (:id, :qid, :text, :score)
            ON DUPLICATE KEY UPDATE `id` = VALUES(`id`)");

        foreach ($questions as $q) {
            $stmtQ->execute([
                ':id'        => $q['id'],
                ':dim'       => $q['dimension'],
                ':scenario'  => $q['scenario'],
                ':qtext'     => $q['question_text'],
                ':weight'    => $q['weight'] ?? 1.0,
                ':order_num' => $q['id'],
            ]);
            foreach ($q['options'] as $opt) {
                $stmtOpt->execute([
                    ':id'    => $opt['id'],
                    ':qid'   => $q['id'],
                    ':text'  => $opt['option_text'],
                    ':score' => $opt['score_value'],
                ]);
            }
        }
    } catch (\Throwable $e) {
        error_log('[QCS FallbackQueue Catalog Init Warning] ' . $e->getMessage());
    }
}

/**
 * Procesa un registro de inscripción de primera clase (PayPal USD 10) de forma idempotente en MySQL
 */
function processPaypalFirstClassRegistration(PDO $pdo, array $config, array $data): array {
    $orderId = trim((string)($data['paypal_order_id'] ?? ''));
    if (empty($orderId)) {
        return ['success' => false, 'is_duplicate' => false];
    }

    $captureId = trim((string)($data['paypal_capture_id'] ?? ''));

    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS `paypal_first_class_registrations` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `paypal_order_id` VARCHAR(127) NOT NULL,
            `paypal_capture_id` VARCHAR(127) NOT NULL,
            `nombres` VARCHAR(150) NOT NULL,
            `email` VARCHAR(150) NOT NULL,
            `telefono` VARCHAR(50) NOT NULL,
            `curso_slug` VARCHAR(190) NOT NULL,
            `curso_titulo` VARCHAR(255) NOT NULL,
            `concepto` VARCHAR(255) NOT NULL,
            `monto` DECIMAL(10,2) NOT NULL,
            `moneda` CHAR(3) NOT NULL,
            `fecha_registro` DATETIME NOT NULL,
            `verification_status` VARCHAR(40) NOT NULL DEFAULT 'verified',
            `ip_origen` VARCHAR(45) NULL,
            `user_agent` TEXT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY `uq_paypal_first_class_order` (`paypal_order_id`),
            UNIQUE KEY `uq_paypal_first_class_capture` (`paypal_capture_id`),
            INDEX `idx_paypal_first_class_email` (`email`),
            INDEX `idx_paypal_first_class_created` (`created_at`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

        $checkStmt = $pdo->prepare("SELECT id FROM `paypal_first_class_registrations`
            WHERE `paypal_order_id` = :order_id OR `paypal_capture_id` = :capture_id LIMIT 1");
        $checkStmt->execute([':order_id' => $orderId, ':capture_id' => $captureId]);
        $isDuplicate = (bool)$checkStmt->fetch();

        $saved = true;
        if (!$isDuplicate) {
            $stmt = $pdo->prepare("INSERT INTO `paypal_first_class_registrations`
            (`paypal_order_id`, `paypal_capture_id`, `nombres`, `email`, `telefono`, `curso_slug`, `curso_titulo`, `concepto`, `monto`, `moneda`, `fecha_registro`, `verification_status`, `ip_origen`, `user_agent`)
            VALUES 
            (:order_id, :capture_id, :nombres, :email, :telefono, :curso_slug, :curso_titulo, :concepto, :monto, :moneda, :fecha_reg, :verification_status, :ip, :ua)");

            $saved = $stmt->execute([
            ':order_id'     => $orderId,
            ':capture_id'   => $captureId ?: null,
            ':nombres'      => $data['nombres'] ?? '',
            ':email'        => $data['email'] ?? '',
            ':telefono'     => $data['telefono'] ?? '',
            ':curso_slug'   => $data['curso_slug'] ?? '',
            ':curso_titulo' => $data['curso_titulo'] ?? '',
            ':concepto'     => $data['concepto'] ?? 'Primera clase del curso (no incluye el curso completo)',
            ':monto'        => (float)($data['monto'] ?? 10.00),
            ':moneda'       => $data['moneda'] ?? 'USD',
            ':fecha_reg'    => $data['fecha_registro'] ?? date('Y-m-d H:i:s'),
            ':verification_status' => $data['verification_status'] ?? 'verified',
            ':ip'           => $data['ip_origen'] ?? '127.0.0.1',
            ':ua'           => $data['user_agent'] ?? 'QCS Fallback Cron Worker',
            ]);
        }

        if (!$saved) {
            return ['success' => false, 'is_duplicate' => false];
        }

        // La cola se retira solo cuando la notificación también fue entregada.
        $mailDelivered = !empty($data['mail_sent']);
        $notificationEmail = trim((string)($config['recipients']['payment_notification'] ?? ''));
        if (!$mailDelivered && filter_var($notificationEmail, FILTER_VALIDATE_EMAIL) && class_exists('SmtpMailer')) {
            try {
                $mailer = new SmtpMailer($config);
                $courseTitle = $data['curso_titulo'] ?? 'Capacitación';
                $nombres = $data['nombres'] ?? 'Alumno';
                $email = $data['email'] ?? '';
                $subject = ($data['verification_status'] ?? 'verified') === 'pending_manual_verification'
                    ? "Pago pendiente de verificación – Primera clase: {$courseTitle} - {$nombres}"
                    : "Nueva Inscripción – Primera Clase (USD 10): {$courseTitle} - {$nombres}";
                $bodyHtml = '<p>Notificación procesada desde la cola de contingencia.</p>'
                    . '<p><strong>Curso:</strong> ' . htmlspecialchars($courseTitle, ENT_QUOTES, 'UTF-8') . '</p>'
                    . '<p><strong>Alumno:</strong> ' . htmlspecialchars($nombres, ENT_QUOTES, 'UTF-8') . '</p>'
                    . '<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>'
                    . '<p><strong>Orden PayPal:</strong> ' . htmlspecialchars($orderId, ENT_QUOTES, 'UTF-8') . '</p>'
                    . '<p><strong>Captura PayPal:</strong> ' . htmlspecialchars($captureId, ENT_QUOTES, 'UTF-8') . '</p>';
                $mailDelivered = $mailer->send($notificationEmail, $subject, $bodyHtml, $email);
            } catch (\Throwable $mailErr) {
                error_log('[QCS Fallback Retry Email Error] ' . $mailErr->getMessage());
            }
        }

        if (!$mailDelivered) {
            error_log('[QCS FallbackQueue] Notificación PayPal pendiente; el registro permanece en cola.');
            return ['success' => false, 'is_duplicate' => $isDuplicate];
        }

        return ['success' => true, 'is_duplicate' => $isDuplicate];
    } catch (\Throwable $e) {
        error_log('[QCS Fallback Processor PayPal Error] ' . $e->getMessage());
        return ['success' => false, 'is_duplicate' => false];
    }
}
