<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Módulo de Evaluación de Habilidades Blandas
 * Dimensiones: Comunicación, Trabajo en Equipo, Resolución de Problemas y Adaptabilidad.
 * Lógica de scoring ponderado, banco de dilemas situacionales, reportes analíticos y persistencia optimizada.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class SoftSkillsService {
    public const DIMENSION_COMUNICACION = 'comunicacion';
    public const DIMENSION_TRABAJO_EQUIPO = 'trabajo_equipo';
    public const DIMENSION_RESOLUCION_PROBLEMAS = 'resolucion_problemas';
    public const DIMENSION_ADAPTABILIDAD = 'adaptabilidad';

    private array $config;
    private CacheInterface $cache;
    private CircuitBreaker $circuitBreaker;

    public function __construct(array $config, CacheInterface $cache, CircuitBreaker $circuitBreaker) {
        $this->config = $config;
        $this->cache = $cache;
        $this->circuitBreaker = $circuitBreaker;
    }

    /**
     * Obtiene el banco de preguntas situacionales (con soporte de Caché L1/L2)
     */
    public function getQuestions(): array {
        return $this->cache->remember('soft_skills_questions_catalog_v2', 86400, function () {
            // Intentar cargar desde BD si está disponible
            $pdo = Database::getConnection($this->config);
            if ($pdo) {
                try {
                    $sql = "SELECT q.id, q.dimension, q.scenario, q.question_text, q.weight, q.order_num,
                                   o.id AS opt_id, o.option_text, o.score_value
                            FROM `soft_skills_questions` q
                            JOIN `soft_skills_options` o ON q.id = o.question_id
                            WHERE q.is_active = 1
                            ORDER BY q.dimension, q.order_num ASC, o.id ASC";
                    $stmt = $pdo->query($sql);
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($rows)) {
                        $catalog = [];
                        foreach ($rows as $row) {
                            $qid = (int)$row['id'];
                            if (!isset($catalog[$qid])) {
                                $catalog[$qid] = [
                                    'id'            => $qid,
                                    'dimension'     => $row['dimension'],
                                    'scenario'      => $row['scenario'],
                                    'question_text' => $row['question_text'],
                                    'weight'        => (float)$row['weight'],
                                    'options'       => [],
                                ];
                            }
                            $catalog[$qid]['options'][] = [
                                'id'          => (int)$row['opt_id'],
                                'option_text' => $row['option_text'],
                                'score_value' => (int)$row['score_value'],
                            ];
                        }
                        return array_values($catalog);
                    }
                } catch (\Throwable $e) {
                    error_log('[QCS SoftSkills] DB Fallback to default situational bank: ' . $e->getMessage());
                }
            }

            // Fallback de contingencia: Banco de alta calidad situacional predeterminado
            return $this->getDefaultSituationalBank();
        });
    }

    /**
     * Evalúa las respuestas del candidato, calcula scoring multidimensional y genera el reporte
     *
     * @param array $candidate Datos del candidato: [name, email, phone, role]
     * @param array $answers Mapeo [question_id => option_id]
     * @return array Reporte estructurado
     */
    public function evaluateAndProcess(array $candidate, array $answers): array {
        $questions = $this->getQuestions();
        $questionsMap = [];
        foreach ($questions as $q) {
            $questionsMap[$q['id']] = $q;
        }

        // Inicializar acumuladores por dimensión
        $dimensions = [
            self::DIMENSION_COMUNICACION => [
                'name' => 'Comunicación Asertiva',
                'description' => 'Habilidad para transmitir ideas técnicas y estratégicas con claridad, empatía y adaptabilidad al interlocutor.',
                'obtained' => 0.0,
                'max' => 0.0,
            ],
            self::DIMENSION_TRABAJO_EQUIPO => [
                'name' => 'Trabajo en Equipo y Sinergia',
                'description' => 'Capacidad de cooperar activamente, gestionar dinámicas interfuncionales y anteponer el éxito colectivo.',
                'obtained' => 0.0,
                'max' => 0.0,
            ],
            self::DIMENSION_RESOLUCION_PROBLEMAS => [
                'name' => 'Resolución de Problemas Complejos',
                'description' => 'Aptitud para analizar la causa raíz de desviaciones en obra o proyectos, priorizar con pensamiento crítico y decidir bajo presión.',
                'obtained' => 0.0,
                'max' => 0.0,
            ],
            self::DIMENSION_ADAPTABILIDAD => [
                'name' => 'Adaptabilidad y Gestión del Cambio',
                'description' => 'Flexibilidad ante contingencias, reformas contractuales, normativas o condiciones imprevistas de terreno.',
                'obtained' => 0.0,
                'max' => 0.0,
            ],
        ];

        $answeredRecords = [];
        $totalObtained = 0.0;
        $totalMax = 0.0;

        foreach ($questions as $q) {
            $qid = $q['id'];
            $dim = $q['dimension'];
            $weight = (float)($q['weight'] ?? 1.0);

            // Opciones disponibles para la pregunta
            $optsMap = [];
            $maxOptScore = 1;
            foreach ($q['options'] as $opt) {
                $optsMap[$opt['id']] = $opt['score_value'];
                if ($opt['score_value'] > $maxOptScore) {
                    $maxOptScore = $opt['score_value'];
                }
            }

            $selectedOptId = isset($answers[$qid]) ? (int)$answers[$qid] : null;
            $scoreValue = ($selectedOptId !== null && isset($optsMap[$selectedOptId])) ? (int)$optsMap[$selectedOptId] : 1;

            $weightedScore = $scoreValue * $weight;
            $weightedMax = $maxOptScore * $weight;

            if (isset($dimensions[$dim])) {
                $dimensions[$dim]['obtained'] += $weightedScore;
                $dimensions[$dim]['max'] += $weightedMax;
            }

            $totalObtained += $weightedScore;
            $totalMax += $weightedMax;

            $answeredRecords[] = [
                'question_id'        => $qid,
                'selected_option_id' => $selectedOptId ?: $q['options'][0]['id'],
                'score_value'        => $scoreValue,
            ];
        }

        // Calcular porcentajes y clasificaciones por dimensión
        $dimensionalResults = [];
        foreach ($dimensions as $dimKey => $data) {
            $max = max(1.0, $data['max']);
            $pct = round(($data['obtained'] / $max) * 100, 2);
            $analysis = $this->analyzeDimensionLevel($dimKey, $pct);

            $dimensionalResults[$dimKey] = [
                'dimension'       => $dimKey,
                'name'            => $data['name'],
                'description'     => $data['description'],
                'score_obtained'  => round($data['obtained'], 2),
                'score_max'       => round($data['max'], 2),
                'percentage'      => $pct,
                'level'           => $analysis['level'],
                'strengths'       => $analysis['strengths'],
                'recommendations' => $analysis['recommendations'],
            ];
        }

        $overallPct = $totalMax > 0 ? round(($totalObtained / $totalMax) * 100, 2) : 0.0;
        $overallLevel = $this->determineOverallLevel($overallPct);

        $report = [
            'evaluation_id'    => 'QCS-' . strtoupper(substr(uniqid(), -8)),
            'candidate'        => [
                'name'  => $candidate['name'] ?? 'Candidato Confidencial',
                'email' => $candidate['email'] ?? '',
                'phone' => $candidate['phone'] ?? '',
                'role'  => $candidate['role'] ?? 'Ingeniero / Gestor de Proyectos',
            ],
            'summary' => [
                'total_score'       => round($totalObtained, 2),
                'max_score'         => round($totalMax, 2),
                'percentage'        => $overallPct,
                'performance_level' => $overallLevel['key'],
                'level_title'       => $overallLevel['title'],
                'executive_summary' => $overallLevel['summary'],
                'completed_at'      => date('Y-m-d H:i:s'),
            ],
            'dimensions' => $dimensionalResults,
            'action_plan' => $this->generateIntegratedActionPlan($dimensionalResults),
            'system_mode' => 'active_db',
        ];

        // 3. Persistencia con Resiliencia (Circuit Breaker + Graceful Fallback)
        $persisted = $this->persistEvaluationWithFallback($report, $answeredRecords);
        if (!$persisted) {
            $report['system_mode'] = 'degraded_file_fallback';
        }

        return $report;
    }

    /**
     * Guarda la evaluación en la base de datos dentro de una transacción única,
     * o encola en almacenamiento seguro si la base de datos está inaccesible.
     */
    private function persistEvaluationWithFallback(array $report, array $answers): bool {
        return $this->circuitBreaker->execute(
            function () use ($report, $answers) {
                $pdo = Database::getConnection($this->config);
                if (!$pdo) {
                    throw new \RuntimeException('Base de datos no disponible.');
                }

                // Transacción atómica
                $pdo->beginTransaction();

                try {
                    // 1. Insertar evaluación principal
                    $stmtEval = $pdo->prepare(
                        "INSERT INTO `soft_skills_evaluations` 
                        (`test_id`, `candidate_name`, `candidate_email`, `candidate_phone`, `candidate_role`, 
                         `total_score`, `max_score`, `percentage`, `performance_level`, `ip_origen`, `user_agent`) 
                        VALUES (1, :name, :email, :phone, :role, :total, :max, :pct, :level, :ip, :ua)"
                    );

                    $stmtEval->execute([
                        ':name'  => $report['candidate']['name'],
                        ':email' => $report['candidate']['email'],
                        ':phone' => $report['candidate']['phone'],
                        ':role'  => $report['candidate']['role'],
                        ':total' => $report['summary']['total_score'],
                        ':max'   => $report['summary']['max_score'],
                        ':pct'   => $report['summary']['percentage'],
                        ':level' => $report['summary']['performance_level'],
                        ':ip'    => Security::getClientIp(),
                        ':ua'    => Security::getUserAgent(),
                    ]);

                    $evaluationId = (int)$pdo->lastInsertId();

                    // 2. Insertar resultados dimensionales en batch
                    $stmtRes = $pdo->prepare(
                        "INSERT INTO `soft_skills_evaluation_results` 
                        (`evaluation_id`, `dimension`, `score_obtained`, `score_max`, `percentage`, `level`, `strengths`, `recommendations`) 
                        VALUES (:eval_id, :dim, :obtained, :max, :pct, :level, :strengths, :recom)"
                    );

                    foreach ($report['dimensions'] as $dimKey => $dim) {
                        $stmtRes->execute([
                            ':eval_id'   => $evaluationId,
                            ':dim'       => $dimKey,
                            ':obtained'  => $dim['score_obtained'],
                            ':max'       => $dim['score_max'],
                            ':pct'       => $dim['percentage'],
                            ':level'     => $dim['level'],
                            ':strengths' => $dim['strengths'],
                            ':recom'     => $dim['recommendations'],
                        ]);
                    }

                    // 3. Insertar respuestas del candidato
                    $stmtAns = $pdo->prepare(
                        "INSERT INTO `soft_skills_evaluation_answers` 
                        (`evaluation_id`, `question_id`, `selected_option_id`, `score_value`) 
                        VALUES (:eval_id, :qid, :opt_id, :score)"
                    );

                    foreach ($answers as $ans) {
                        $stmtAns->execute([
                            ':eval_id' => $evaluationId,
                            ':qid'     => $ans['question_id'],
                            ':opt_id'  => $ans['selected_option_id'],
                            ':score'   => $ans['score_value'],
                        ]);
                    }

                    $pdo->commit();
                    return true;
                } catch (\Throwable $e) {
                    $pdo->rollBack();
                    throw $e;
                }
            },
            // Fallback de degradación elegante: Guardar en cola de contingencia local
            function (\Throwable $e) use ($report, $answers) {
                error_log('[QCS Graceful Degradation] Guardando evaluación en fallback queue: ' . $e->getMessage());
                $queueDir = __DIR__ . '/../storage/fallback_queue';
                if (!is_dir($queueDir)) {
                    @mkdir($queueDir, 0755, true);
                }

                $payload = [
                    'report'    => $report,
                    'answers'   => $answers,
                    'queued_at' => time(),
                    'reason'    => $e->getMessage(),
                ];

                $fileName = $queueDir . '/eval_' . date('Ymd_His') . '_' . uniqid() . '.json';
                @file_put_contents($fileName, json_encode($payload, JSON_PRETTY_PRINT), LOCK_EX);
                return false;
            }
        );
    }

    /**
     * Clasificación analítica por dimensión
     */
    private function analyzeDimensionLevel(string $dimension, float $pct): array {
        if ($pct >= 90.0) {
            $level = 'Sobresaliente';
            $texts = [
                self::DIMENSION_COMUNICACION => [
                    'strengths' => 'Capacidad de síntesis ejecutiva excepcional, oratoria persuasiva y comunicación no verbal impecable en comités de obra y arbitrajes.',
                    'recommendations' => 'Fomentar mentoría a supervisores junior e intervenir como facilitador clave en negociaciones contractuales complejas.'
                ],
                self::DIMENSION_TRABAJO_EQUIPO => [
                    'strengths' => 'Liderazgo inspirador, articulación natural de sinergias multidisciplinarias y alta cohesión bajo plazos exigentes.',
                    'recommendations' => 'Asignar dirección de mesas técnicas de alta criticidad y programas de formación interna en Lean Construction.'
                ],
                self::DIMENSION_RESOLUCION_PROBLEMAS => [
                    'strengths' => 'Pensamiento lateral y deductivo agudo; abordaje con diagramas causa-raíz y mitigación preventiva de contingencias en obra.',
                    'recommendations' => 'Documentar lecciones aprendidas en la PMO corporativa para enriquecer la base de conocimiento institucional.'
                ],
                self::DIMENSION_ADAPTABILIDAD => [
                    'strengths' => 'Extraordinaria serenidad y flexibilidad estratégica ante modificaciones de ingeniería de detalle, clima adverso o cambios contractuales.',
                    'recommendations' => 'Liderar la gestión del cambio en transiciones tecnológicas (BIM, ERPs de obra, automatización).'
                ],
            ];
        } elseif ($pct >= 75.0) {
            $level = 'Competente';
            $texts = [
                self::DIMENSION_COMUNICACION => [
                    'strengths' => 'Transmite instrucciones técnicas con consistencia y mantiene a los stakeholders alineados con regularidad.',
                    'recommendations' => 'Potenciar la comunicación empática hacia contratistas y reforzar el uso de tableros visuales de control.'
                ],
                self::DIMENSION_TRABAJO_EQUIPO => [
                    'strengths' => 'Colabora de forma activa, respeta las metas colectivas y muestra compromiso con el equipo de proyecto.',
                    'recommendations' => 'Desarrollar habilidades de resolución proactiva de fricciones interpersonales antes de que escalen.'
                ],
                self::DIMENSION_RESOLUCION_PROBLEMAS => [
                    'strengths' => 'Resuelve desviaciones habituales de forma eficaz con base en procedimientos y buenas prácticas.',
                    'recommendations' => 'Incorporar herramientas estructuradas de análisis de causa raíz (5 Porqués, Ishikawa) para desvíos no rutinarios.'
                ],
                self::DIMENSION_ADAPTABILIDAD => [
                    'strengths' => 'Acepta ajustes de cronograma o especificaciones y se acomoda a nuevos requerimientos.',
                    'recommendations' => 'Anticipar escenarios de contingencia mediante planes de respuesta a riesgos preacordados.'
                ],
            ];
        } elseif ($pct >= 60.0) {
            $level = 'En Desarrollo';
            $texts = [
                self::DIMENSION_COMUNICACION => [
                    'strengths' => 'Maneja adecuadamente la comunicación rutinaria por correo o informes técnicos básicos.',
                    'recommendations' => 'Entrenar asertividad en reuniones de coordinación y estructuración de informes ejecutivos orientados a toma de decisiones.'
                ],
                self::DIMENSION_TRABAJO_EQUIPO => [
                    'strengths' => 'Cumple con su cuota individual de entregables en el equipo.',
                    'recommendations' => 'Incrementar la participación transversal, compartiendo información técnica tempranamente con otras especialidades.'
                ],
                self::DIMENSION_RESOLUCION_PROBLEMAS => [
                    'strengths' => 'Identifica los síntomas de los problemas y los reporta a sus superiores.',
                    'recommendations' => 'Fomentar la proposición de al menos dos alternativas de solución cuantificadas antes de escalar el problema.'
                ],
                self::DIMENSION_ADAPTABILIDAD => [
                    'strengths' => 'Se adapta a cambios cuando estos vienen acompañados de directivas explícitas.',
                    'recommendations' => 'Fomentar la tolerancia a la ambigüedad y la rápida reasignación de prioridades sin pérdida de foco.'
                ],
            ];
        } else {
            $level = 'Inicial';
            $texts = [
                self::DIMENSION_COMUNICACION => [
                    'strengths' => 'Demuestra disposición para recibir retroalimentación.',
                    'recommendations' => 'Capacitación intensiva en habilidades de escucha activa, comunicación técnica no violenta y síntesis ejecutiva.'
                ],
                self::DIMENSION_TRABAJO_EQUIPO => [
                    'strengths' => 'Trabaja de manera individual concentrado en su rol directo.',
                    'recommendations' => 'Integración en dinámicas grupales con metas compartidas y acompañamiento de un mentor senior.'
                ],
                self::DIMENSION_RESOLUCION_PROBLEMAS => [
                    'strengths' => 'Reconoce cuando una situación escapa a su control.',
                    'recommendations' => 'Formación en metodologías de análisis de problemas, diagramación de procesos y toma de decisiones guiada.'
                ],
                self::DIMENSION_ADAPTABILIDAD => [
                    'strengths' => 'Mantiene un estándar de rigor en entornos con rutinas altamente predecibles.',
                    'recommendations' => 'Desarrollar resiliencia frente a la incertidumbre y técnicas de gestión del estrés en picos de obra.'
                ],
            ];
        }

        return [
            'level'           => $level,
            'strengths'       => $texts[$dimension]['strengths'],
            'recommendations' => $texts[$dimension]['recommendations'],
        ];
    }

    private function determineOverallLevel(float $percentage): array {
        if ($percentage >= 90.0) {
            return [
                'key'     => 'sobresaliente',
                'title'   => 'Liderazgo Senior y Alta Madurez Competencial',
                'summary' => 'El perfil evidencia un dominio sobresaliente en las 4 competencias blandas, destacándose por su autonomía directiva, visión estratégica de proyectos y capacidad para liderar equipos en entornos de alta incertidumbre.'
            ];
        } elseif ($percentage >= 75.0) {
            return [
                'key'     => 'competente',
                'title'   => 'Competente y Sólido en Gestión Interpersonal',
                'summary' => 'El candidato cuenta con una base sólida de competencias interpersonales y operativas, interactuando con fluidez técnica y solvencia en la resolución de vicisitudes comunes de proyecto.'
            ];
        } elseif ($percentage >= 60.0) {
            return [
                'key'     => 'en_desarrollo',
                'title'   => 'En Proceso de Desarrollo y Maduración',
                'summary' => 'Muestra aptitudes positivas y potencial de crecimiento. Requiere acompañamiento o mentoría enfocada en resolución autónoma de contingencias y comunicación persuasiva hacia clientes o contratistas.'
            ];
        } else {
            return [
                'key'     => 'inicial',
                'title'   => 'Nivel Inicial - Requiere Fortalecimiento Focalizado',
                'summary' => 'Se observan brechas sustanciales que pueden impactar en la coordinación o entrega de proyectos. Se recomienda un plan intensivo de formación en trabajo en equipo y resolución sistemática de problemas.'
            ];
        }
    }

    private function generateIntegratedActionPlan(array $dimensions): array {
        $sorted = $dimensions;
        uasort($sorted, function ($a, $b) {
            return $a['percentage'] <=> $b['percentage'];
        });

        $weakest = reset($sorted);
        $strongest = end($sorted);

        return [
            'priority_area'   => $weakest['name'],
            'priority_action' => $weakest['recommendations'],
            'key_asset'       => $strongest['name'],
            'leverage_action' => $strongest['strengths'],
        ];
    }

    /**
     * Banco de preguntas situacionales calibradas para proyectos y obras
     */
    public static function getDefaultSituationalBank(): array {
        return [
            // --- COMUNICACIÓN ASERTIVA ---
            [
                'id' => 1,
                'dimension' => self::DIMENSION_COMUNICACION,
                'scenario' => 'Durante la reunión de cierre semanal de avance de obra, el cliente cuestiona de forma molesta un retraso del 6% en el frente crítico, el cual se debió a una falta de liberación de permisos por parte de su propia supervisión.',
                'question_text' => '¿Cuál es su abordaje para comunicar la situación?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 101,
                        'option_text' => 'Le responde de forma directa frente al comité que el retraso es culpa exclusiva de ellos por no entregar los permisos a tiempo.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 102,
                        'option_text' => 'Presenta serenamente la curva de avance, correlacionando de manera documentada los hitos de permisos pendientes con el rendimiento del frente, y propone de inmediato dos opciones de recuperación acelerada.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 103,
                        'option_text' => 'Evita el conflicto en la reunión pública, acepta el desvío sin explicaciones y envía un correo técnico detallado al día siguiente.',
                        'score_value' => 3,
                    ],
                    [
                        'id' => 104,
                        'option_text' => 'Pide a su supervisor inmediato que tome la palabra y asuma la explicación para no desgastar su relación con el cliente.',
                        'score_value' => 1,
                    ],
                ]
            ],
            [
                'id' => 2,
                'dimension' => self::DIMENSION_COMUNICACION,
                'scenario' => 'Ha detectado una incompatibilidad geométrica crítica entre los planos estructurales y los planos electromecánicos (MEP) que podría paralizar el colado de concreto en 48 horas.',
                'question_text' => '¿Cómo canaliza la comunicación con los proyectistas y la residencia de obra?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 201,
                        'option_text' => 'Genera un RFI (Request For Information) formal con capturas BIM 3D de la interferencia, sugiere una solución técnica preliminar y convoca una reunión relámpago con ambas partes para acordar la solución hoy mismo.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 202,
                        'option_text' => 'Envía el RFI al buzón general del proyectista y espera el plazo formal de 7 días que estipula el contrato.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 203,
                        'option_text' => 'Llama informalmente al maestro de obra para que él decida sobre la marcha cómo acomodar las tuberías en campo.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 204,
                        'option_text' => 'Comunica el hallazgo a su jefe directo en el informe de fin de mes para que la gerencia tome una decisión.',
                        'score_value' => 1,
                    ],
                ]
            ],

            // --- TRABAJO EN EQUIPO ---
            [
                'id' => 3,
                'dimension' => self::DIMENSION_TRABAJO_EQUIPO,
                'scenario' => 'Dos ingenieros especialistas de su equipo están en fuerte desacuerdo sobre el método constructivo a utilizar para el recalce de muros vecinos, lo que está frenando la entrega del plan de trabajo.',
                'question_text' => '¿Cómo interviene para resolver la divergencia y asegurar la entrega?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 301,
                        'option_text' => 'Toma la decisión unilateralmente imponiendo su propio criterio técnico para no perder más tiempo.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 302,
                        'option_text' => 'Facilita una matriz de decisión técnica multicriterio (costo, seguridad, plazo, viabilidad de equipos) con ambos especialistas para llegar a un consenso fundamentado en datos objetivos.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 303,
                        'option_text' => 'Deja que continúen debatiendo hasta que uno de ellos convenza al otro por agotamiento.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 304,
                        'option_text' => 'Escala de inmediato la disputa al Director de Operaciones para deslindar su responsabilidad.',
                        'score_value' => 2,
                    ],
                ]
            ],
            [
                'id' => 4,
                'dimension' => self::DIMENSION_TRABAJO_EQUIPO,
                'scenario' => 'El área de Compras y Logística no logra abastecer a tiempo el acero corrugado de 1 pulgada, afectando el cronograma del equipo de Producción. La tensión entre ambas áreas es alta.',
                'question_text' => '¿Cuál es su actitud como miembro del proyecto?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 401,
                        'option_text' => 'Se reúne conjuntamente con Producción y Logística, mapean el flujo de abastecimiento y coordinan un plan de despachos escalonados priorizando los frentes indispensables para no parar la cuadrilla.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 402,
                        'option_text' => 'Redacta un memorándum de queja formal acusando a Logística por incumplimiento de hitos.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 403,
                        'option_text' => 'Se mantiene al margen ya que el suministro de insumos no pertenece a sus responsabilidades directas.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 404,
                        'option_text' => 'Detiene la labor de las cuadrillas y espera a que el proveedor despache la totalidad de toneladas.',
                        'score_value' => 1,
                    ],
                ]
            ],

            // --- RESOLUCIÓN DE PROBLEMAS ---
            [
                'id' => 5,
                'dimension' => self::DIMENSION_RESOLUCION_PROBLEMAS,
                'scenario' => 'Una prueba de compresión de probetas de concreto a 28 días arroja un valor 15% inferior al f’c especificado en una columna central de soporte del proyecto.',
                'question_text' => '¿Qué secuencia de acciones emprende?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 501,
                        'option_text' => 'Suspende de inmediato la sobrecarga del elemento, convoca al calculista estructural, ordena extracción de diamantinas para ensayo normado y coordina la trazabilidad del lote con la planta concretera.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 502,
                        'option_text' => 'Ordena demoler la columna sin consultar para no levantar sospechas de la supervisión externa.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 503,
                        'option_text' => 'Espera a las pruebas de 56 días confiando en que el concreto gane la resistencia esperada por el paso del tiempo.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 504,
                        'option_text' => 'Aplica un mortero de reparación superficial para mejorar la apariencia del elemento.',
                        'score_value' => 1,
                    ],
                ]
            ],
            [
                'id' => 6,
                'dimension' => self::DIMENSION_RESOLUCION_PROBLEMAS,
                'scenario' => 'El presupuesto de contingencias se ha agotado al 80% y solo se ha completado el 40% del cronograma de la obra.',
                'question_text' => '¿Cómo aborda este desvío presupuestal?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 601,
                        'option_text' => 'Realiza un análisis de Valor Ganado (EVM), evalúa las causas raíz del sobrecosto por partidas e implementa ingeniería de valor para optimizar rendimientos y materiales en las fases restantes.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 602,
                        'option_text' => 'Solicita una ampliación presupuestal automática al cliente argumentando imprevistos sin mayor sustento.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 603,
                        'option_text' => 'Recorta arbitrariamente el personal de control de calidad para compensar los gastos.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 604,
                        'option_text' => 'Oculta el sobrecosto distribuyéndolo contablemente en partidas futuras aún no ejecutadas.',
                        'score_value' => 1,
                    ],
                ]
            ],

            // --- ADAPTABILIDAD ---
            [
                'id' => 7,
                'dimension' => self::DIMENSION_ADAPTABILIDAD,
                'scenario' => 'La empresa decide migrar en 3 semanas de un sistema de control tradicional en hojas de cálculo a una plataforma Cloud BIM 360 y Last Planner digital. Varios miembros del equipo muestran resistencia al cambio.',
                'question_text' => '¿Cuál es su postura y acción ante esta transición?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 701,
                        'option_text' => 'Se capacita intensamente en la plataforma, actúa como embajador del cambio apoyando a sus pares y lidera la prueba piloto en su frente de trabajo.',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 702,
                        'option_text' => 'Continúa utilizando sus hojas de cálculo en paralelo y solo usa la nueva herramienta cuando su superior lo supervisa directamente.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 703,
                        'option_text' => 'Se queja formalmente argumentando que el sistema actual funcionaba y que el software nuevo retrasará los trabajos.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 704,
                        'option_text' => 'Espera a ver si el resto del equipo adopta la plataforma antes de involucrarse.',
                        'score_value' => 2,
                    ],
                ]
            ],
            [
                'id' => 8,
                'dimension' => self::DIMENSION_ADAPTABILIDAD,
                'scenario' => 'Debido a una huelga regional de transportistas imprevista, el proyecto no recibirá insumos por 5 días laborables consecutivos.',
                'question_text' => '¿Cómo reacciona frente a esta contingencia no planificada?',
                'weight' => 1.0,
                'options' => [
                    [
                        'id' => 801,
                        'option_text' => 'Replanifica inmediatamente el Lookahead, reorientando las cuadrillas a actividades no dependientes de insumos frescos (ej: desencofrados, habilitación de armaduras en taller, capacitación en seguridad y mantenimiento preventivo de equipos).',
                        'score_value' => 5,
                    ],
                    [
                        'id' => 802,
                        'option_text' => 'Manda a descansar a todo el personal de obra hasta que la huelga se levante de manera natural.',
                        'score_value' => 1,
                    ],
                    [
                        'id' => 803,
                        'option_text' => 'Presenta de inmediato un reclamo de ampliación de plazo con gastos generales al cliente sin mitigar el impacto.',
                        'score_value' => 2,
                    ],
                    [
                        'id' => 804,
                        'option_text' => 'Presiona a los choferes para intentar cruzar los piquetes a pesar de los riesgos de seguridad física.',
                        'score_value' => 1,
                    ],
                ]
            ],
        ];
    }

    /**
     * Recupera listado interno de evaluaciones para propósitos de reporte o tareas internas (CLI/Job).
     * NOTA: Este método es estrictamente de uso interno y NO debe ser expuesto como endpoint público.
     *
     * @param int $limit
     * @param int $offset
     * @return array ['items' => array, 'total' => int]
     */
    public function listEvaluationsInternal(int $limit = 10, int $offset = 0): array {
        $pdo = Database::getConnection($this->config);
        if (!$pdo) {
            return ['items' => [], 'total' => 0];
        }

        try {
            $countStmt = $pdo->query("SELECT COUNT(*) FROM `soft_skills_evaluations`");
            $total = (int)$countStmt->fetchColumn();

            $sql = "SELECT id, candidate_name, candidate_email, candidate_role, 
                           total_score, max_score, percentage, performance_level, completed_at
                    FROM `soft_skills_evaluations`
                    ORDER BY completed_at DESC
                    LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'items' => $items,
                'total' => $total
            ];
        } catch (\Throwable $e) {
            error_log('[SoftSkillsService::listEvaluationsInternal] Error: ' . $e->getMessage());
            return ['items' => [], 'total' => 0];
        }
    }
}

