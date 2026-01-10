CREATE DATABASE f1fp;
USE f1fp;

CREATE TABLE results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  season INT,
  race VARCHAR(100),
  winner VARCHAR(50),
  team VARCHAR(50),
  points INT
);

CREATE TABLE merch (
  id INT AUTO_INCREMENT PRIMARY KEY,
  team VARCHAR(50),
  product VARCHAR(100),
  price DECIMAL(8,2)
);

CREATE TABLE news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150),
  content TEXT,
  date DATE
);

CREATE TABLE tickets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  race VARCHAR(100),
  price DECIMAL(8,2),
  available INT
);

CREATE TABLE purchases (
  id INT AUTO_INCREMENT PRIMARY KEY,
  buyer VARCHAR(100),
  race VARCHAR(100)
);

INSERT INTO results VALUES
(NULL,2022,'Bahrain GP','Leclerc','Ferrari',25),
(NULL,2023,'Monaco GP','Verstappen','Red Bull',25),
(NULL,2024,'Silverstone','Hamilton','Mercedes',25);

INSERT INTO merch VALUES
(NULL,'Ferrari','Camiseta Oficial',45),
(NULL,'Red Bull','Gorra Oficial',30);

INSERT INTO news VALUES
(NULL,'Nueva normativa F1','La FIA anuncia cambios para 2026','2025-01-01');

INSERT INTO tickets VALUES
(NULL,'GP España 2026',300,100);
