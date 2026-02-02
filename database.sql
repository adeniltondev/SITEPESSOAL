-- Banco de dados: sitepessoal
-- Execute no phpMyAdmin / Hostinger

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE projetos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(180) NOT NULL,
  categoria VARCHAR(120) NOT NULL,
  descricao TEXT NOT NULL,
  cliente VARCHAR(180) DEFAULT NULL,
  ano VARCHAR(10) DEFAULT NULL,
  url VARCHAR(255) DEFAULT NULL,
  status ENUM('rascunho','publicado') NOT NULL DEFAULT 'rascunho',
  data_publicacao DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE midias_projeto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  projeto_id INT NOT NULL,
  type ENUM('image','video') NOT NULL,
  path VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_midias_projeto FOREIGN KEY (projeto_id) REFERENCES projetos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contatos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL,
  telefone VARCHAR(50) DEFAULT NULL,
  mensagem TEXT NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuário admin padrão (email: admin, senha: admin12345670236)
INSERT INTO usuarios (nome, email, senha_hash) VALUES
('Administrador', 'admin', '$2y$10$zFq3LFvMp6hTbZnKJ5lq5ehvVf5CqCbqLPVDfvQJl0aB3vLwpBVQK');
