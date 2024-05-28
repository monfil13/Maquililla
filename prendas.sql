CREATE DATABASE IF NOT EXISTS maquila;

USE maquila;

CREATE TABLE IF NOT EXISTS prendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombrePrenda VARCHAR(255) NOT NULL,
    colorPrenda ENUM('amarillo', 'azul', 'rojo', 'verde', 'blanco', 'negro') NOT NULL,
    precio DECIMAL(8,2) NOT NULL
);
