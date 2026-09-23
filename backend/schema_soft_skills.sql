-- ==============================================================================
-- QUALITY CONSULTING SOLUTIONS - ESQUEMA DE BASE DE DATOS: HABILIDADES BLANDAS
-- Módulo de Evaluación Situacional: Comunicación, Trabajo en Equipo, 
-- Resolución de Problemas y Adaptabilidad.
-- ==============================================================================

-- 1. Catálogo de Tests de Evaluación
CREATE TABLE IF NOT EXISTS `soft_skills_tests` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `title` VARCHAR(200) NOT NULL,
    `description` TEXT NOT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_test_code` (`code`),
    INDEX `idx_test_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de tests de habilidades blandas';

-- 2. Preguntas Situacionales por Dimensión
CREATE TABLE IF NOT EXISTS `soft_skills_questions` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `test_id` INT UNSIGNED NOT NULL,
    `dimension` ENUM('comunicacion', 'trabajo_equipo', 'resolucion_problemas', 'adaptabilidad') NOT NULL,
    `scenario` TEXT NOT NULL COMMENT 'Contexto situacional del proyecto u obra',
    `question_text` TEXT NOT NULL COMMENT 'Pregunta o dilema situacional',
    `weight` DECIMAL(3,2) NOT NULL DEFAULT 1.00 COMMENT 'Ponderación de la pregunta',
    `order_num` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    INDEX `idx_test_dim_order` (`test_id`, `dimension`, `order_num`),
    INDEX `idx_dim` (`dimension`),
    CONSTRAINT `fk_question_test` FOREIGN KEY (`test_id`) REFERENCES `soft_skills_tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Preguntas situacionales del test';

-- 3. Opciones de Respuesta Ponderadas
CREATE TABLE IF NOT EXISTS `soft_skills_options` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `question_id` INT UNSIGNED NOT NULL,
    `option_text` TEXT NOT NULL,
    `score_value` TINYINT UNSIGNED NOT NULL COMMENT 'Escala de 1 a 5 según madurez de competencia',
    `rationale` TEXT NULL COMMENT 'Fundamento de la puntuación para feedback',
    INDEX `idx_opt_question_score` (`question_id`, `score_value`),
    CONSTRAINT `fk_option_question` FOREIGN KEY (`question_id`) REFERENCES `soft_skills_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Opciones de respuesta con ponderación conductual';

-- 4. Registro de Evaluaciones Realizadas
CREATE TABLE IF NOT EXISTS `soft_skills_evaluations` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `test_id` INT UNSIGNED NOT NULL,
    `candidate_name` VARCHAR(150) NOT NULL,
    `candidate_email` VARCHAR(150) NOT NULL,
    `candidate_phone` VARCHAR(30) NOT NULL,
    `candidate_role` VARCHAR(150) NOT NULL,
    `total_score` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    `max_score` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    `percentage` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    `performance_level` ENUM('inicial', 'en_desarrollo', 'competente', 'sobresaliente') NOT NULL,
    `ip_origen` VARCHAR(45) NULL,
    `user_agent` VARCHAR(255) NULL,
    `completed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_eval_email` (`candidate_email`),
    INDEX `idx_eval_date` (`completed_at`),
    INDEX `idx_eval_level` (`performance_level`),
    INDEX `idx_eval_composite` (`candidate_email`, `completed_at` DESC),
    CONSTRAINT `fk_eval_test` FOREIGN KEY (`test_id`) REFERENCES `soft_skills_tests` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Evaluaciones concluidas por candidatos';

-- 5. Resultados Consolidados por Dimensión (Evita N+1 y acelera reportes)
CREATE TABLE IF NOT EXISTS `soft_skills_evaluation_results` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `evaluation_id` INT UNSIGNED NOT NULL,
    `dimension` ENUM('comunicacion', 'trabajo_equipo', 'resolucion_problemas', 'adaptabilidad') NOT NULL,
    `score_obtained` DECIMAL(5,2) NOT NULL,
    `score_max` DECIMAL(5,2) NOT NULL,
    `percentage` DECIMAL(5,2) NOT NULL,
    `level` VARCHAR(50) NOT NULL,
    `strengths` TEXT NOT NULL,
    `recommendations` TEXT NOT NULL,
    INDEX `idx_result_eval_dim` (`evaluation_id`, `dimension`),
    CONSTRAINT `fk_result_eval` FOREIGN KEY (`evaluation_id`) REFERENCES `soft_skills_evaluations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Scores y feedback agrupado por competencia';

-- 6. Respuestas Detalladas del Candidato
CREATE TABLE IF NOT EXISTS `soft_skills_evaluation_answers` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `evaluation_id` INT UNSIGNED NOT NULL,
    `question_id` INT UNSIGNED NOT NULL,
    `selected_option_id` INT UNSIGNED NOT NULL,
    `score_value` TINYINT UNSIGNED NOT NULL,
    INDEX `idx_ans_eval` (`evaluation_id`),
    INDEX `idx_ans_question` (`question_id`),
    CONSTRAINT `fk_ans_eval` FOREIGN KEY (`evaluation_id`) REFERENCES `soft_skills_evaluations` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ans_question` FOREIGN KEY (`question_id`) REFERENCES `soft_skills_questions` (`id`),
    CONSTRAINT `fk_ans_option` FOREIGN KEY (`selected_option_id`) REFERENCES `soft_skills_options` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Respuestas individuales seleccionadas';

-- ==============================================================================
-- DATOS INICIALES: Test Situacional Estándar de Habilidades Blandas QCS
-- ==============================================================================
INSERT INTO `soft_skills_tests` (`id`, `code`, `title`, `description`, `is_active`) 
VALUES (1, 'QCS-SOFT-2026', 'Evaluación Situacional de Competencias Blandas para Proyectos', 'Evaluación psicométrica situacional orientada a proyectos multidisciplinarios de ingeniería, gestión de calidad y liderazgo.', 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

