-- 1. Crear la base de datos
CREATE DATABASE IF NOT EXISTS restaurante_chaval;
USE restaurante_chaval;

-- 2. Crear tabla de Categorías (Entradas y Segundos)
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- 3. Crear tabla de Platos
CREATE TABLE platos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_categoria INT,
    precio DECIMAL(10,2) DEFAULT 0.00,
    estado ENUM('disponible', 'agotado') DEFAULT 'disponible',
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

-- 4. Insertar las Categorías
INSERT INTO categorias (nombre) VALUES ('Entradas'), ('Segundos');

-- 5. Insertar los Platos (Extraídos de tus menús físicos)
-- ENTRADAS (id_categoria = 1)
INSERT INTO platos (nombre, id_categoria) VALUES 
('Sopa a la minuta', 1),
('Camote con queso', 1),
('Ensalada mixta', 1),
('Sopa de moron', 1),
('Causa', 1),
('Menestron', 1),
('Ensalada de fideos', 1);

-- SEGUNDOS (id_categoria = 2)
INSERT INTO platos (nombre, id_categoria) VALUES 
('Arroz con pollo', 2),
('Saltado de coliflor', 2),
('Pollo al mani', 2),
('Menestra', 2),
('Trucha', 2),
('Sopa seca con carapulcra', 2),
('Cau-cau', 2),
('Arroz con marisco', 2),
('Pollo frito', 2),
('Ternera al vino', 2),
('Pollo al vino', 2),
('Locro', 2),
('Arroz ala jardinera con pollada', 2);