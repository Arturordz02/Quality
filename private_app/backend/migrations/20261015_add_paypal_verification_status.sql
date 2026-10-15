ALTER TABLE `paypal_first_class_registrations`
    ADD COLUMN IF NOT EXISTS `verification_status` VARCHAR(40) NOT NULL DEFAULT 'verified' AFTER `fecha_registro`;
