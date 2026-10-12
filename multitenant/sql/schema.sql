CREATE DATABASE IF NOT EXISTS multitenant CHARACTER SET utf8mb4;
USE multitenant;

CREATE TABLE empresa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    conflitos VARCHAR(255) NOT NULL DEFAULT ''
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha CHAR(64) NOT NULL,
    tipo ENUM('COMUM', 'ADMIN') NOT NULL
);

CREATE TABLE usuario_empresa (
    usuario_id INT NOT NULL,
    empresa_id INT NOT NULL,
    PRIMARY KEY (usuario_id, empresa_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);

CREATE TABLE noticia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    criada_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);

CREATE TABLE conta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    descricao VARCHAR(150) NOT NULL,
    valor DECIMAL(12,2) NOT NULL,
    criada_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empresa_id) REFERENCES empresa(id)
);

INSERT INTO empresa (id, nome, conflitos) VALUES
(1, 'Banco Alfa', '2'),
(2, 'Banco Beta', '1'),
(3, 'Tech Gama', ''),
(4, 'Mercado Delta', '');

INSERT INTO usuario (id, login, senha, tipo) VALUES
(1, 'admin', SHA2('admin123', 256), 'ADMIN'),
(2, 'maria', SHA2('123456', 256), 'COMUM'),
(3, 'joao', SHA2('123456', 256), 'COMUM'),
(4, 'admin2', SHA2('admin123', 256), 'ADMIN');

INSERT INTO usuario_empresa (usuario_id, empresa_id) VALUES
(1, 1), (1, 3),
(2, 1),
(3, 2),
(4, 2), (4, 4);
