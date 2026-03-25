-- Run this in phpMyAdmin or MySQL to create the employee_types table.
-- Navigate to: http://localhost/phpmyadmin → Select your HRMS database → SQL tab → paste and run.

CREATE TABLE IF NOT EXISTS `employee_types` (
    `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type_code`   VARCHAR(50)  NULL,
    `type_name`   VARCHAR(255) NOT NULL,
    `description` TEXT         NULL,
    `status`      TINYINT(1)   NOT NULL DEFAULT 1,
    `created_at`  TIMESTAMP    NULL,
    `updated_at`  TIMESTAMP    NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Also insert the migrations record so Laravel tracks it:
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_03_17_120000_create_employee_types_table', MAX(`batch`) + 1
FROM `migrations`;
