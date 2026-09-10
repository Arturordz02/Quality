<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * API Endpoint: Módulo de Evaluación de Habilidades Blandas
 * Acciones públicas autorizadas: questions, submit
 */

define('QCS_BACKEND_ACCESS', true);

$bootstrap = require __DIR__ . '/../bootstrap.php';
$config = $bootstrap['config'];
$cache = $bootstrap['cache'];
$rateLimiter = $bootstrap['rateLimiter'];
$dbCircuit = $bootstrap['dbCircuitBreaker'];

require_once __DIR__ . '/../services/SoftSkillsService.php';

Security::sendJsonHeaders($config);

$clientIp = Security::getClientIp($config);
$action = $_GET['action'] ?? ($_POST['action'] ?? 'questions');

$service = new SoftSkillsService($config, $cache, $dbCircuit);

switch ($action) {
    case 'questions':
        // Rate limiting para consultas (60 req/min)
        $rateLimiter->enforceOrBlock($clientIp . '_ss_questions', 60, 60);

        if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            Security::jsonError('Método no permitido.', 405);
        }

        $catalog = $service->getQuestions();

        // Ocultar puntuaciones internas para proteger la integridad psicométrica del test
        $sanitizedQuestions = array_map(function ($q) {
            return [
                'id'            => $q['id'],
                'dimension'     => $q['dimension'],
                'scenario'      => $q['scenario'],
                'question_text' => $q['question_text'],
                'options'       => array_map(function ($opt) {
                    return [
                        'id'          => $opt['id'],
                        'option_text' => $opt['option_text'],
                    ];
                }, $q['options']),
            ];
        }, $catalog);

        Security::jsonSuccess('Cuestionario situacional cargado exitosamente.', [
            'total_questions' => count($sanitizedQuestions),
            'dimensions' => [
                'comunicacion' => 'Comunicación Asertiva',
                'trabajo_equipo' => 'Trabajo en Equipo y Sinergia',
                'resolucion_problemas' => 'Resolución de Problemas Complejos',
                'adaptabilidad' => 'Adaptabilidad y Gestión del Cambio',
            ],
            'questions' => $sanitizedQuestions,
        ]);
        break;

    case 'submit':
        // Rate limiting estricto para envíos de test (15 req/min)
        $rateLimiter->enforceOrBlock($clientIp . '_ss_submit', 15, 60);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Security::jsonError('Método no permitido. Debe ser POST.', 405);
        }

        // Obtener datos (JSON o POST tradicional)
        $input = $_POST;
        $raw = file_get_contents('php://input');
        if (!empty($raw)) {
            $json = json_decode($raw, true);
            if (is_array($json)) {
                $input = array_merge($input, $json);
            }
        }

        $candidateInput = $input['candidate'] ?? [];
        $answersInput   = $input['answers'] ?? [];

        // Validaciones de datos del candidato
        $name  = Security::sanitizeString($candidateInput['name'] ?? '', 120);
        $email = Security::sanitizeEmail($candidateInput['email'] ?? '');
        $phone = Security::sanitizeString($candidateInput['phone'] ?? '', 30);
        $role  = Security::sanitizeString($candidateInput['role'] ?? '', 120);

        $errors = [];
        if (empty($name) || mb_strlen($name) < 3) {
            $errors['name'] = 'Por favor, ingrese su nombre y apellido completo.';
        }
        if (empty($email) || !Security::isValidEmail($email)) {
            $errors['email'] = 'Por favor, proporcione un correo electrónico válido.';
        }
        if (empty($phone) || !Security::isValidPhone($phone)) {
            $errors['phone'] = 'Por favor, proporcione un teléfono o WhatsApp de contacto válido.';
        }
        if (empty($role) || mb_strlen($role) < 2) {
            $errors['role'] = 'Por favor, indique su cargo actual o perfil profesional.';
        }

        if (empty($answersInput) || !is_array($answersInput)) {
            $errors['answers'] = 'Debe responder las preguntas situacionales de la evaluación.';
        }

        if (!empty($errors)) {
            Security::jsonError('Datos incompletos o inválidos.', 422, $errors);
        }

        $candidate = [
            'name'  => $name,
            'email' => $email,
            'phone' => $phone,
            'role'  => $role,
        ];

        // Procesar evaluación con el motor de scoring
        $report = $service->evaluateAndProcess($candidate, $answersInput);

        Security::jsonSuccess('Evaluación de competencias procesada con éxito.', [
            'report' => $report,
        ]);
        break;

    case 'list':
        // Endpoint deshabilitado por privacidad y protección de datos personales.
        // No se permite el listado público de evaluaciones de candidatos sin autenticación.
        Security::jsonError('Acceso denegado. El listado público de evaluaciones se encuentra deshabilitado.', 403);
        break;

    default:
        Security::jsonError("Acción no válida: '{$action}'", 400);
        break;
}

