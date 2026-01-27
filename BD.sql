-- =========================
-- CREACIÓN DE LA BASE DE DATOS
-- =========================
CREATE DATABASE IF NOT EXISTS Consultoria;
USE Consultoria;

-- =========================
-- TABLA: Usuarios
-- =========================
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA: Servicios
-- =========================
CREATE TABLE servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    activo BOOLEAN DEFAULT TRUE
);

-- =========================
-- TABLA: Especializaciones
-- =========================
CREATE TABLE especializaciones (
    id_especializacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- =========================
-- RELACIÓN: Servicios - Especializaciones
-- =========================
CREATE TABLE servicio_especializacion (
    id_servicio INT NOT NULL,
    id_especializacion INT NOT NULL,
    PRIMARY KEY (id_servicio, id_especializacion),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio),
    FOREIGN KEY (id_especializacion) REFERENCES especializaciones(id_especializacion)
);

-- =========================
-- TABLA: Proyectos (Portafolio)
-- =========================
CREATE TABLE proyectos (
    id_proyecto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    empresa VARCHAR(150),
    fecha_inicio DATE,
    fecha_fin DATE
);

-- =========================
-- TABLA: Comentarios de Empresas
-- =========================
CREATE TABLE comentarios_empresas (
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    id_proyecto INT NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    comentario TEXT NOT NULL,
    calificacion INT CHECK (calificacion BETWEEN 1 AND 5),
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto)
);

-- =========================
-- TABLA: Contactos (Correos y Teléfonos)
-- =========================
CREATE TABLE contactos (
    id_contacto INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('telefono', 'correo') NOT NULL,
    valor VARCHAR(150) NOT NULL
);

-- =========================
-- TABLA: Mensajes de Clientes (Chat)
-- =========================
CREATE TABLE mensajes_clientes (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_servicio INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio)
);

-- =========================
-- TABLA: Posibles Clientes
-- (Solo usuarios que preguntaron por servicios)
-- =========================
CREATE TABLE posibles_clientes (
    id_posible_cliente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    fecha_contacto DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('nuevo', 'en seguimiento', 'cerrado') DEFAULT 'nuevo',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- =========================
-- TABLA: Administradores
-- =========================
CREATE TABLE administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'superadmin') DEFAULT 'admin'
);

-- =========================
-- TRIGGER:
-- Cuando un usuario envía un mensaje,
-- automáticamente se convierte en posible cliente
-- =========================
DELIMITER $$

CREATE TRIGGER trg_insert_posible_cliente
AFTER INSERT ON mensajes_clientes
FOR EACH ROW
BEGIN
    INSERT IGNORE INTO posibles_clientes (id_usuario)
    VALUES (NEW.id_usuario);
END$$

DELIMITER ;
