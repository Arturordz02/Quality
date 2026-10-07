-- ==============================================================================
-- Quality Consulting Solutions - Migración Manual 001
-- Agrega columna queue_id y restricción UNIQUE a la tabla contactos
-- ==============================================================================
-- USO EXCLUSIVO: Ejecución manual única en bases de datos existentes que no
-- fueron creadas con el schema.sql sincronizado.
-- Comando de ejecución en servidor/cPanel:
-- mysql -u [usuario] -p [base_de_datos] < 001_add_queue_id_contactos.sql
-- ==============================================================================

ALTER TABLE `contactos` 
ADD COLUMN `queue_id` VARCHAR(64) NULL AFTER `id`,
ADD UNIQUE KEY `uq_contactos_queue_id` (`queue_id`),
ADD INDEX `idx_queue_id` (`queue_id`);

