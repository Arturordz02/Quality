<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Evaluación de Habilidades Blandas
 * Archivo: app/Views/pages/evaluacion-habilidades.php
 */

declare(strict_types=1);
?>
    <style>
        :root {
            --qcs-navy: #0b2545;
            --qcs-blue-mid: #134074;
            --qcs-blue-light: #0077b6;
            --qcs-gold: #e0a96d;
            --qcs-gold-light: #fdfaf6;
            --qcs-success: #2a9d8f;
            --qcs-warning: #e76f51;
        }

        .assessment-hero {
            background: linear-gradient(135deg, var(--qcs-navy) 0%, var(--qcs-blue-mid) 100%);
            color: #ffffff;
            padding: 50px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .assessment-hero::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        .dimension-badge {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
        }
        .dim-comunicacion { background: #e0f2fe; color: #0284c7; }
        .dim-trabajo_equipo { background: #ecfdf5; color: #059669; }
        .dim-resolucion_problemas { background: #fef3c7; color: #d97706; }
        .dim-adaptabilidad { background: #f3e8ff; color: #7c3aed; }

        .scenario-box {
            background: #f8fafc;
            border-left: 4px solid var(--qcs-blue-mid);
            padding: 18px 22px;
            border-radius: 8px;
            font-style: italic;
            color: #334155;
            margin-bottom: 24px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.03);
        }

        .option-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 14px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            background: #ffffff;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .option-card:hover {
            border-color: var(--qcs-blue-light);
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.08);
        }

        .option-card.selected {
            border-color: var(--qcs-blue-mid);
            background: #eff6ff;
            box-shadow: 0 4px 14px rgba(11, 37, 69, 0.12);
        }

        .option-radio-indicator {
            width: 22px;
            height: 22px;
            border: 2px solid #94a3b8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
            transition: all 0.2s ease;
        }

        .option-card.selected .option-radio-indicator {
            border-color: var(--qcs-navy);
            background: var(--qcs-navy);
        }

        .option-card.selected .option-radio-indicator::after {
            content: '';
            width: 8px;
            height: 8px;
            background: #ffffff;
            border-radius: 50%;
        }

        .progress-container {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 12px 0;
        }

        /* Report Styles */
        .report-header-card {
            background: linear-gradient(135deg, #0b2545 0%, #1e3a8a 100%);
            color: #ffffff;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(11, 37, 69, 0.15);
        }

        .score-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 4px solid var(--qcs-gold);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(224, 169, 109, 0.3);
        }

        .dimension-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            padding: 24px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.2s ease;
        }

        .dimension-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        }

        .radar-chart-container {
            position: relative;
            max-width: 440px;
            margin: 0 auto;
        }

        @media print {
            .no-print, header, footer, .progress-container, .btn-action-bar {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }
            .report-header-card {
                background: #0b2545 !important;
                color: #ffffff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <section class="assessment-hero no-print">
        <div class="container text-center">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-bold">
                <i class="fa-solid fa-brain me-1"></i> EVALUACIÓN PSICOMÉTRICA SITUACIONAL
            </span>
            <h1 class="fw-bold mb-3">Diagnóstico Integral de Habilidades Blandas</h1>
            <p class="lead mx-auto text-light opacity-90" style="max-width: 780px;">
                Mida su madurez competencial en <strong>Comunicación Asertiva</strong>, <strong>Trabajo en Equipo</strong>, 
                <strong>Resolución de Problemas Complejos</strong> y <strong>Adaptabilidad al Cambio</strong> bajo dilemas reales de proyectos y obras de construcción.
            </p>
        </div>
    </section>
    <main class="container my-5">

        <!-- PASO 1: Formulario de Registro de Candidato -->
        <div id="stepRegistration" class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fa-solid fa-user-tie fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-dark">Registro del Evaluado</h3>
                        <p class="text-muted">Por favor, ingrese sus datos profesionales para emitir su informe analítico confidencial.</p>
                    </div>

                    <form id="formCandidateRegistration" novalidate>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="candidateName" class="form-label fw-semibold">Nombres y Apellidos Completos *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input type="text" class="form-control" id="candidateName" required placeholder="Ej. Ing. Carlos Mendoza Torres">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="candidateEmail" class="form-label fw-semibold">Correo Electrónico Corporativo/Personal *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control" id="candidateEmail" required placeholder="cmendoza@empresa.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="candidatePhone" class="form-label fw-semibold">Teléfono / WhatsApp *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-muted"></i></span>
                                    <input type="tel" class="form-control" id="candidatePhone" required placeholder="+51 987 654 321">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="candidateRole" class="form-label fw-semibold">Cargo / Especialidad Actual *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-briefcase text-muted"></i></span>
                                    <input type="text" class="form-control" id="candidateRole" required placeholder="Ej. Residente de Obra / Jefe de Oficina Técnica / Project Manager">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4 d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-shield-halved fa-lg me-3 text-primary"></i>
                            <div class="small">
                                <strong>Privacidad Garantizada:</strong> Sus respuestas son procesadas de manera confidencial bajo estrictos estándares de ciberseguridad y no serán compartidas públicamente.
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm">
                                Comenzar Evaluación <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- PASO 2: Cuestionario Dinámico Situacional -->
        <div id="stepAssessment" class="d-none">
            <!-- Barra de Progreso Flotante -->
            <div class="progress-container mb-4 rounded-3 border">
                <div class="container d-flex align-items-center justify-content-between">
                    <span class="small fw-bold text-muted">
                        Pregunta <span id="currentQuestionNumber">1</span> de <span id="totalQuestionsCount">8</span>
                    </span>
                    <div class="progress flex-grow-1 mx-3" style="height: 10px;">
                        <div id="assessmentProgressBar" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;"></div>
                    </div>
                    <span id="progressPercentageText" class="small fw-bold text-primary">0%</span>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                        
                        <!-- Encabezado de Pregunta -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span id="questionDimensionBadge" class="dimension-badge dim-comunicacion">COMUNICACIÓN</span>
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                <i class="fa-regular fa-clock me-1"></i> Situación Real de Obra
                            </span>
                        </div>

                        <!-- Escenario Contextual -->
                        <div class="scenario-box">
                            <span class="d-block fw-bold text-uppercase small text-muted mb-1">Contexto Situacional:</span>
                            <span id="questionScenarioText">Cargando situación...</span>
                        </div>

                        <!-- Pregunta / Dilema -->
                        <h4 id="questionTitleText" class="fw-bold text-dark mb-4">¿Cuál es su abordaje para comunicar la situación?</h4>

                        <!-- Opciones de Respuesta -->
                        <div id="optionsContainer">
                            <!-- Inyectadas dinámicamente -->
                        </div>

                        <!-- Botones de Navegación -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <button id="btnPrevQuestion" class="btn btn-outline-secondary rounded-pill px-4" disabled>
                                <i class="fa-solid fa-chevron-left me-1"></i> Anterior
                            </button>
                            <button id="btnNextQuestion" class="btn btn-primary rounded-pill px-5 fw-bold" disabled>
                                Siguiente <i class="fa-solid fa-chevron-right ms-1"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- PASO 3: Reporte Analítico Detallado -->
        <div id="stepReport" class="d-none">
            
            <!-- Barra de Acciones de Reporte -->
            <div class="d-flex justify-content-between align-items-center mb-4 btn-action-bar no-print">
                <a href="/evaluacion-habilidades" class="btn btn-outline-secondary rounded-pill">
                    <i class="fa-solid fa-rotate-right me-1"></i> Realizar Nueva Evaluación
                </a>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-dark rounded-pill px-4">
                        <i class="fa-solid fa-print me-1"></i> Imprimir / Guardar PDF
                    </button>
                </div>
            </div>

            <!-- Ficha de Encabezado de Reporte -->
            <div class="report-header-card mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2">INFORME DE COMPETENCIAS PROFESIONALES</span>
                        <h2 id="reportCandidateName" class="fw-bold mb-1">Ing. Carlos Mendoza</h2>
                        <p id="reportCandidateRole" class="text-light opacity-90 mb-3 fs-5">Project Manager Senior</p>
                        <div class="d-flex flex-wrap gap-3 small text-light opacity-80">
                            <span><i class="fa-solid fa-envelope me-1"></i> <span id="reportCandidateEmail"></span></span>
                            <span><i class="fa-solid fa-calendar me-1"></i> <span id="reportDate"></span></span>
                            <span><i class="fa-solid fa-fingerprint me-1"></i> ID: <span id="reportEvalId"></span></span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mt-4 mt-md-0">
                        <div class="score-circle mx-auto mb-2">
                            <span id="reportGlobalScorePct" class="fs-1 fw-bold text-white">0%</span>
                            <span class="small text-warning text-uppercase fw-bold">Puntuación</span>
                        </div>
                        <span id="reportGlobalLevelBadge" class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold fs-6">
                            Competente
                        </span>
                    </div>
                </div>
            </div>

            <!-- Resumen Ejecutivo -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-clipboard-check text-primary me-2"></i> Diagnóstico Ejecutivo</h4>
                <p id="reportExecutiveSummary" class="text-secondary leading-relaxed mb-0 fs-6">
                    Análisis ejecutivo de competencias...
                </p>
            </div>

            <!-- Gráfico Radar y Desglose de Dimensiones -->
            <div class="row g-4 mb-4">
                <!-- Visualización de Gráfico Radar SVG -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
                        <h5 class="fw-bold text-dark mb-3">Matriz Radial de Competencias</h5>
                        <div class="radar-chart-container my-auto">
                            <svg id="radarSvg" viewBox="0 0 360 360" width="100%" height="320">
                                <!-- Generado por JS -->
                            </svg>
                        </div>
                        <div class="d-flex justify-content-around small text-muted mt-3">
                            <span><span class="badge bg-primary me-1">&nbsp;</span> Perfil Evaluado</span>
                            <span><span class="badge bg-secondary me-1">&nbsp;</span> Referencia Base (75%)</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjetas Detalladas por Dimensión -->
                <div class="col-lg-7">
                    <div class="row g-3" id="dimensionalCardsContainer">
                        <!-- Inyectadas por JS -->
                    </div>
                </div>
            </div>

            <!-- Plan de Acción Recomendado -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 border-start border-4 border-warning">
                <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-route text-warning me-2"></i> Plan de Acción y Aceleración</h4>
                <div class="row g-4" id="actionPlanContainer">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Prioridad de Desarrollo Inmediato:</h6>
                            <p id="actionPlanWeakestArea" class="fw-bold mb-1 text-dark"></p>
                            <p id="actionPlanWeakestRec" class="text-muted small mb-0"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 h-100">
                            <h6 class="fw-bold text-success"><i class="fa-solid fa-star me-2"></i> Fortaleza Clave a Apalancar:</h6>
                            <p id="actionPlanStrongestArea" class="fw-bold mb-1 text-dark"></p>
                            <p id="actionPlanStrongestStrength" class="text-muted small mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
    <!-- Lógica del Módulo de Evaluación de Habilidades Blandas -->
    <script>
        (function() {
            // Estado de la Evaluación
            let candidateData = {};
            let questions = [];
            let currentQuestionIndex = 0;
            let userAnswers = {};

            // Referencias DOM
            const stepRegistration = document.getElementById('stepRegistration');
            const stepAssessment = document.getElementById('stepAssessment');
            const stepReport = document.getElementById('stepReport');

            const formRegistration = document.getElementById('formCandidateRegistration');
            const currentQuestionNumber = document.getElementById('currentQuestionNumber');
            const totalQuestionsCount = document.getElementById('totalQuestionsCount');
            const assessmentProgressBar = document.getElementById('assessmentProgressBar');
            const progressPercentageText = document.getElementById('progressPercentageText');

            const questionDimensionBadge = document.getElementById('questionDimensionBadge');
            const questionScenarioText = document.getElementById('questionScenarioText');
            const questionTitleText = document.getElementById('questionTitleText');
            const optionsContainer = document.getElementById('optionsContainer');
            const btnPrevQuestion = document.getElementById('btnPrevQuestion');
            const btnNextQuestion = document.getElementById('btnNextQuestion');

            // Cargar Cuestionario Situacional desde el Backend
            async function loadQuestions() {
                try {
                    const response = await fetch('backend/api/soft-skills.php?action=questions');
                    const data = await response.json();
                    if (data.success && data.questions) {
                        questions = data.questions;
                        totalQuestionsCount.innerText = questions.length;
                    } else {
                        alert('No se pudieron cargar las preguntas del servidor: ' + (data.message || 'Error desconocido'));
                    }
                } catch (e) {
                    console.error('Error cargando preguntas:', e);
                    alert('Error de conexión con el servicio de evaluación.');
                }
            }

            // Manejo de Registro
            formRegistration.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('candidateName').value.trim();
                const email = document.getElementById('candidateEmail').value.trim();
                const phone = document.getElementById('candidatePhone').value.trim();
                const role = document.getElementById('candidateRole').value.trim();

                if (!name || !email || !phone || !role) {
                    alert('Por favor complete todos los campos requeridos.');
                    return;
                }

                candidateData = { name, email, phone, role };

                stepRegistration.classList.add('d-none');
                stepAssessment.classList.remove('d-none');
                window.scrollTo({ top: 0, behavior: 'smooth' });

                renderCurrentQuestion();
            });

            // Renderizar Pregunta Actual
            function renderCurrentQuestion() {
                const q = questions[currentQuestionIndex];
                if (!q) return;

                currentQuestionNumber.innerText = currentQuestionIndex + 1;
                const progressPct = Math.round(((currentQuestionIndex) / questions.length) * 100);
                assessmentProgressBar.style.width = progressPct + '%';
                progressPercentageText.innerText = progressPct + '%';

                // Dimension Badge
                const dimNames = {
                    comunicacion: 'COMUNICACIÓN ASERTIVA',
                    trabajo_equipo: 'TRABAJO EN EQUIPO',
                    resolucion_problemas: 'RESOLUCIÓN DE PROBLEMAS',
                    adaptabilidad: 'ADAPTABILIDAD AL CAMBIO'
                };
                questionDimensionBadge.className = 'dimension-badge dim-' + q.dimension;
                questionDimensionBadge.innerText = dimNames[q.dimension] || q.dimension.toUpperCase();

                questionScenarioText.innerText = q.scenario;
                questionTitleText.innerText = q.question_text;

                // Render Opciones
                optionsContainer.innerHTML = '';
                const selectedOptId = userAnswers[q.id];

                q.options.forEach(opt => {
                    const card = document.createElement('div');
                    card.className = 'option-card' + (selectedOptId === opt.id ? ' selected' : '');
                    card.innerHTML = `
                        <div class="option-radio-indicator"></div>
                        <div class="flex-grow-1 text-dark fs-6">${opt.option_text}</div>
                    `;
                    card.addEventListener('click', () => {
                        userAnswers[q.id] = opt.id;
                        document.querySelectorAll('.option-card').forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        btnNextQuestion.disabled = false;
                    });
                    optionsContainer.appendChild(card);
                });

                btnPrevQuestion.disabled = currentQuestionIndex === 0;
                btnNextQuestion.disabled = !userAnswers[q.id];

                if (currentQuestionIndex === questions.length - 1) {
                    btnNextQuestion.innerHTML = 'Finalizar y Calificar <i class="fa-solid fa-circle-check ms-1 text-warning"></i>';
                } else {
                    btnNextQuestion.innerHTML = 'Siguiente <i class="fa-solid fa-chevron-right ms-1"></i>';
                }
            }

            // Botón Anterior
            btnPrevQuestion.addEventListener('click', () => {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    renderCurrentQuestion();
                    window.scrollTo({ top: 150, behavior: 'smooth' });
                }
            });

            // Botón Siguiente / Enviar
            btnNextQuestion.addEventListener('click', async () => {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    renderCurrentQuestion();
                    window.scrollTo({ top: 150, behavior: 'smooth' });
                } else {
                    // Enviar evaluación al backend
                    btnNextQuestion.disabled = true;
                    btnNextQuestion.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Procesando Diagnóstico...';

                    try {
                        const response = await fetch('backend/api/soft-skills.php?action=submit', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                candidate: candidateData,
                                answers: userAnswers
                            })
                        });

                        const result = await response.json();
                        if (result.success && result.report) {
                            renderReport(result.report);
                        } else {
                            alert('Error al procesar: ' + (result.message || 'Intente nuevamente.'));
                            btnNextQuestion.disabled = false;
                        }
                    } catch (err) {
                        console.error('Error enviando test:', err);
                        alert('Ocurrió un error al conectar con el servidor.');
                        btnNextQuestion.disabled = false;
                    }
                }
            });

            // Renderizar Reporte Detallado y Gráfico Radar
            function renderReport(report) {
                stepAssessment.classList.add('d-none');
                stepReport.classList.remove('d-none');
                window.scrollTo({ top: 0, behavior: 'smooth' });

                document.getElementById('reportCandidateName').innerText = report.candidate.name;
                document.getElementById('reportCandidateRole').innerText = report.candidate.role;
                document.getElementById('reportCandidateEmail').innerText = report.candidate.email;
                document.getElementById('reportDate').innerText = report.summary.completed_at;
                document.getElementById('reportEvalId').innerText = report.evaluation_id;

                document.getElementById('reportGlobalScorePct').innerText = Math.round(report.summary.percentage) + '%';
                const levelBadge = document.getElementById('reportGlobalLevelBadge');
                levelBadge.innerText = report.summary.level_title;

                document.getElementById('reportExecutiveSummary').innerText = report.summary.executive_summary;

                // Desglose Dimensional
                const cardsContainer = document.getElementById('dimensionalCardsContainer');
                cardsContainer.innerHTML = '';

                const dimArray = Object.values(report.dimensions);
                dimArray.forEach(dim => {
                    const col = document.createElement('div');
                    col.className = 'col-md-6';

                    let badgeColor = 'bg-success';
                    if (dim.percentage < 60) badgeColor = 'bg-danger';
                    else if (dim.percentage < 75) badgeColor = 'bg-warning text-dark';

                    col.innerHTML = `
                        <div class="dimension-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-dark mb-0">${dim.name}</h6>
                                <span class="badge ${badgeColor} rounded-pill">${Math.round(dim.percentage)}%</span>
                            </div>
                            <div class="progress mb-3" style="height: 6px;">
                                <div class="progress-bar ${badgeColor}" style="width: ${dim.percentage}%"></div>
                            </div>
                            <p class="small text-muted mb-2"><strong>Fortaleza:</strong> ${dim.strengths}</p>
                            <p class="small text-primary mb-0"><strong>Recomendación:</strong> ${dim.recommendations}</p>
                        </div>
                    `;
                    cardsContainer.appendChild(col);
                });

                // Plan de Acción
                if (report.action_plan) {
                    document.getElementById('actionPlanWeakestArea').innerText = report.action_plan.priority_area;
                    document.getElementById('actionPlanWeakestRec').innerText = report.action_plan.priority_action;
                    document.getElementById('actionPlanStrongestArea').innerText = report.action_plan.key_asset;
                    document.getElementById('actionPlanStrongestStrength').innerText = report.action_plan.leverage_action;
                }

                // Generar Gráfico Radar SVG Matemático
                renderRadarChart(dimArray);
            }

            // Algoritmo de Dibujo Radial SVG
            function renderRadarChart(dimensions) {
                const svg = document.getElementById('radarSvg');
                svg.innerHTML = '';
                const cx = 180, cy = 180, r = 120;
                const total = dimensions.length;

                // 1. Dibujar círculos concéntricos de referencia (25%, 50%, 75%, 100%)
                [0.25, 0.5, 0.75, 1.0].forEach(factor => {
                    const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    circle.setAttribute('cx', cx);
                    circle.setAttribute('cy', cy);
                    circle.setAttribute('r', r * factor);
                    circle.setAttribute('fill', 'none');
                    circle.setAttribute('stroke', '#e2e8f0');
                    circle.setAttribute('stroke-dasharray', factor === 0.75 ? '4,4' : 'none');
                    circle.setAttribute('stroke-width', factor === 0.75 ? '2' : '1');
                    svg.appendChild(circle);
                });

                // 2. Ejes radiales y etiquetas
                const points = [];
                dimensions.forEach((dim, i) => {
                    const angle = (Math.PI * 2 / total) * i - (Math.PI / 2);
                    const x = cx + r * Math.cos(angle);
                    const y = cy + r * Math.sin(angle);

                    // Línea radial
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', cx);
                    line.setAttribute('y1', cy);
                    line.setAttribute('x2', x);
                    line.setAttribute('y2', y);
                    line.setAttribute('stroke', '#cbd5e1');
                    line.setAttribute('stroke-width', '1');
                    svg.appendChild(line);

                    // Etiqueta de dimensión
                    const labelX = cx + (r + 28) * Math.cos(angle);
                    const labelY = cy + (r + 22) * Math.sin(angle);
                    const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    text.setAttribute('x', labelX);
                    text.setAttribute('y', labelY);
                    text.setAttribute('text-anchor', 'middle');
                    text.setAttribute('dominant-baseline', 'middle');
                    text.setAttribute('font-size', '10');
                    text.setAttribute('font-weight', '600');
                    text.setAttribute('fill', '#334155');
                    text.textContent = dim.name.split(' ')[0];
                    svg.appendChild(text);

                    // Punto de valor evaluado (normalizado 0 a 1)
                    const valFactor = Math.min(1, Math.max(0.1, dim.percentage / 100));
                    const px = cx + (r * valFactor) * Math.cos(angle);
                    const py = cy + (r * valFactor) * Math.sin(angle);
                    points.push(`${px},${py}`);
                });

                // Polígono del resultado
                const polygon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                polygon.setAttribute('points', points.join(' '));
                polygon.setAttribute('fill', 'rgba(0, 119, 182, 0.35)');
                polygon.setAttribute('stroke', '#0077b6');
                polygon.setAttribute('stroke-width', '2.5');
                svg.appendChild(polygon);

                // Nodos circulares en vértices
                points.forEach(pt => {
                    const [px, py] = pt.split(',');
                    const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    dot.setAttribute('cx', px);
                    dot.setAttribute('cy', py);
                    dot.setAttribute('r', '4');
                    dot.setAttribute('fill', '#0b2545');
                    svg.appendChild(dot);
                });
            }

            // Iniciar carga al cargar la página
            loadQuestions();
        })();
    </script>
