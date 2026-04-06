-- Ejecutar este script en phpMyAdmin o MySQL CLI
-- antes de usar los archivos PHP

CREATE DATABASE IF NOT EXISTS lasalle_pruebas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE lasalle_pruebas;

CREATE TABLE IF NOT EXISTS contactos (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  nombre    VARCHAR(100) NOT NULL,
  email     VARCHAR(150) NOT NULL,
  telefono  VARCHAR(20),
  asunto    VARCHAR(50)  NOT NULL,
  mensaje   TEXT         NOT NULL,
  fecha     DATETIME     DEFAULT CURRENT_TIMESTAMP
);

-- Datos de prueba iniciales
INSERT INTO contactos (nombre, email, telefono, asunto, mensaje) VALUES
  ('Ana García',   'ana@correo.com',   '3001234567', 'admisiones', 'Quisiera información sobre el proceso de admisión.'),
  ('Luis Martínez','luis@correo.com',  '3109876543', 'becas',       'Necesito información sobre becas disponibles.'),
  ('María López',  'maria@correo.com', NULL,          'academico',   '¿Cuáles son los horarios de atención?');
