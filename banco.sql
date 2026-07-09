-- =============================================
-- Box 377 Oficina - Banco de Dados
-- Etapa 4: Atualização de Conteúdo pelo Painel
-- =============================================

CREATE DATABASE IF NOT EXISTS bd_mecanica;
USE bd_mecanica;

-- Tabela de usuários (completa desde etapa 2)
CREATE TABLE IF NOT EXISTS usuarios (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nome  VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    foto  VARCHAR(255) DEFAULT NULL
);

-- Usuário admin padrão (senha: admin123)
INSERT INTO usuarios (nome, email, senha) VALUES (
    'Administrador',
    'admin@box377oficina.com.br',
    '$2y$10$/bPemSoU.b7xSjhHZTRBZOwtzWBa2bE1lkyoMCti5Ybm7ov4ywZZe'
);

-- Tabela de serviços (conteúdo 1 - editável pelo painel)
CREATE TABLE IF NOT EXISTS servicos (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    titulo    VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    categoria VARCHAR(100)
);

INSERT INTO servicos (titulo, descricao, categoria) VALUES
('Freios',              'Manutenção e revisão completa do sistema de freios: pastilhas, discos, fluido e cilindros.', 'SAFETY & PERFORMANCE'),
('Suspensão',           'Diagnóstico e manutenção completa da suspensão dianteira e traseira.',                        'STABILITY & CONTROL'),
('Diagnóstico',         'Scanner automotivo e diagnóstico eletrônico completo.',                                       'SYSTEM ANALYSIS'),
('Revisão Preventiva',  'Checklist completo para manter seu veículo em perfeito estado.',                              'PREVENTIVE CARE'),
('Elétrica Automotiva', 'Diagnóstico e reparo do sistema elétrico, bateria e alternador.',                            'ELECTRICAL SYSTEM'),
('Injeção Eletrônica',  'Limpeza e regulagem do sistema de injeção para melhor performance.',                          'FUEL SYSTEM');

-- Tabela de depoimentos (conteúdo 2 - editável pelo painel)
CREATE TABLE IF NOT EXISTS depoimentos (
    id      INT AUTO_INCREMENT PRIMARY KEY,
    nome    VARCHAR(100) NOT NULL,
    texto   TEXT NOT NULL,
    cliente VARCHAR(100)
);

INSERT INTO depoimentos (nome, texto, cliente) VALUES
('João Silva',     'Atendimento excelente, serviço rápido e transparente. Recomendo!', 'Cliente há 5 anos'),
('Maria Souza',    'Resolveram um problema que outras oficinas não conseguiram identificar.', 'Cliente'),
('Carlos Oliveira','Preço justo, honestidade e qualidade. Não levo meu carro em mais nenhum lugar.', 'Cliente há 3 anos');

-- Tabela de mensagens do formulário de contato (conteúdo 3 - visualizado pelo painel)
CREATE TABLE IF NOT EXISTS mensagens (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nome       VARCHAR(100) NOT NULL,
    telefone   VARCHAR(20),
    email      VARCHAR(100) NOT NULL,
    mensagem   TEXT NOT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    lida       TINYINT DEFAULT 0
);
