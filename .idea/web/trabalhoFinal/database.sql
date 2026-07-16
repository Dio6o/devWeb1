-- Banco de dados do sistema de livraria
CREATE DATABASE IF NOT EXISTS livraria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE livraria;

-- Tabela de autores
CREATE TABLE IF NOT EXISTS autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de livros
CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor_id INT NOT NULL,
    data_publicacao DATE NOT NULL,
    sinopse TEXT,
    capa VARCHAR(255),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (autor_id) REFERENCES autores(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Alguns dados de exemplo (opcional)
INSERT INTO autores (nome) VALUES
    ('Machado de Assis'),
    ('Clarice Lispector'),
    ('J.R.R. Tolkien');

INSERT INTO livros (titulo, autor_id, data_publicacao, sinopse) VALUES
    ('Dom Casmurro', 1, '1899-01-01', 'Um clássico da literatura brasileira sobre ciúme e dúvida.'),
    ('A Hora da Estrela', 2, '1977-01-01', 'A história de Macabéa, uma jovem nordestina no Rio de Janeiro.'),
    ('O Senhor dos Anéis', 3, '1954-07-29', 'A jornada de Frodo para destruir o Um Anel.');
