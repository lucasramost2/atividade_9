CREATE DATABASE petshop_db;
USE petshop_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Inserir usuário de teste com senha já criptografada (senha: 123456)
INSERT INTO usuarios (username, senha)
VALUES ('admin', '$2y$10$9v4XPiKz7ixGhKqAek3.juN6Dy36dQwZZrmL1aE3ZczQfGIBEr49i');
