-- SQL schema for FCT-TUTOR project
-- Run this in phpMyAdmin or via mysql CLI (XAMPP):
-- CREATE DATABASE fct_tutor; USE fct_tutor;

CREATE DATABASE IF NOT EXISTS `fct_tutor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fct_tutor`;

-- Students table
CREATE TABLE IF NOT EXISTS `student` (
  `St_id` VARCHAR(50) NOT NULL PRIMARY KEY,
  `Username` VARCHAR(100) NOT NULL UNIQUE,
  `Email` VARCHAR(150) NOT NULL UNIQUE,
  `Password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tutors table
CREATE TABLE IF NOT EXISTS `tutor` (
  `Tutor_id` VARCHAR(50) NOT NULL PRIMARY KEY,
  `Username` VARCHAR(100) NOT NULL UNIQUE,
  `Email` VARCHAR(150) NOT NULL UNIQUE,
  `Password` VARCHAR(255) NOT NULL,
  `Course_id` VARCHAR(50) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional courses table
CREATE TABLE IF NOT EXISTS `course` (
  `Course_id` VARCHAR(50) NOT NULL PRIMARY KEY,
  `Course_name` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Example seed data (optional)
INSERT INTO `course` (`Course_id`, `Coursename`) VALUES
('C101', 'Mathematics'),
('C102', 'Physics'),
('C103', 'Programming'),
('C104', 'Chemistry'),
('C105', 'Biology'),
('CT31043', 'Structure Programming');

-- Note: After importing, ensure `dbconnect.php` credentials match your MySQL (XAMPP) settings.
-- Password column MUST be VARCHAR(255) or larger to store bcrypt hashes (60+ characters).
-- Course_id in tutor table is optional (foreign key removed for flexibility).
