-- ============================================
-- ATUALIZAÇÕES DE BANCO DE DADOS
-- Data: 20260202
-- Descrição: Adição de coluna capa_image para projetos
-- ============================================

-- Adicionar coluna de imagem de capa nos projetos
ALTER TABLE projetos ADD COLUMN capa_image VARCHAR(255) DEFAULT NULL COMMENT 'Caminho da imagem de capa do projeto (600x400px recomendado)';

-- Criar tabela de configurações da home page
CREATE TABLE IF NOT EXISTS home_config (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hero_image VARCHAR(255) DEFAULT NULL COMMENT 'Imagem hero da página inicial',
  atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir registro padrão
INSERT INTO home_config (id, hero_image) VALUES (1, NULL) ON DUPLICATE KEY UPDATE id=1;

-- ============================================
-- RESUMO DAS MUDANÇAS:
-- TABELA: projetos
-- - Nova coluna: capa_image (VARCHAR 255)
-- - Campo opcional (pode ser NULL)
-- - Uso: Armazenar caminho da imagem de capa
-- - Localização do upload: /assets/uploads/capa-{id}.ext
--
-- TABELA: home_config (NOVA)
-- - id (INT, chave primária)
-- - hero_image (VARCHAR 255) - Imagem de fundo da home
-- - atualizado_em (TIMESTAMP) - Data da última atualização
-- - Localização do upload: /assets/uploads/hero-{uniqid}.ext
-- ============================================
