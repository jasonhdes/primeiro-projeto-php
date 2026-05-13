-- =============================================================================
-- Migration — jasonh_erp
-- Full schema for the ko.dok ERP application.
-- Run this file against a fresh MySQL instance before running seed.sql.
-- =============================================================================

CREATE DATABASE IF NOT EXISTS jasonh_erp
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE jasonh_erp;

-- -----------------------------------------------------------------------------
-- Lookup / reference tables
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS estados (
    estado_id INT AUTO_INCREMENT PRIMARY KEY,
    estado    VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS setores (
    setor_id INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS cores (
    cor_id INT AUTO_INCREMENT PRIMARY KEY,
    cor    VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tamanhos (
    tamanho_id INT AUTO_INCREMENT PRIMARY KEY,
    tamanho    VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tecidos (
    tecido_id INT AUTO_INCREMENT PRIMARY KEY,
    tecido    VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pagamentos (
    pagamento_id INT AUTO_INCREMENT PRIMARY KEY,
    pagamento    VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS entregas (
    entrega_id INT AUTO_INCREMENT PRIMARY KEY,
    entrega    VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------------------------
-- Core tables
-- -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS locais (
    local_id    INT AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(100) NOT NULL,
    endereco    VARCHAR(255),
    estado_id   INT,
    numero      VARCHAR(10),
    complemento VARCHAR(255),
    telefone    VARCHAR(20),
    cidade      VARCHAR(100),
    FOREIGN KEY (estado_id) REFERENCES estados(estado_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS modelos (
    modelo_id  INT AUTO_INCREMENT PRIMARY KEY,
    codigo     VARCHAR(50)    NOT NULL,
    nome       VARCHAR(100)   NOT NULL,
    referencia VARCHAR(50),
    foto       VARCHAR(255),
    preco      DECIMAL(10,2)  NOT NULL,
    tamanho_id INT,
    cor_id     INT,
    tecido_id  INT,
    FOREIGN KEY (tamanho_id) REFERENCES tamanhos(tamanho_id),
    FOREIGN KEY (cor_id)     REFERENCES cores(cor_id),
    FOREIGN KEY (tecido_id)  REFERENCES tecidos(tecido_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS estoque (
    estoque_id INT AUTO_INCREMENT PRIMARY KEY,
    codigo     VARCHAR(50)   NOT NULL,
    nome       VARCHAR(100)  NOT NULL,
    quantidade INT           DEFAULT 0,
    preco      DECIMAL(10,2) NOT NULL,
    total      DECIMAL(10,2) DEFAULT 0,
    local_id   INT,
    cor_id     INT,
    tamanho_id INT,
    tecido_id  INT,
    FOREIGN KEY (local_id)   REFERENCES locais(local_id),
    FOREIGN KEY (cor_id)     REFERENCES cores(cor_id),
    FOREIGN KEY (tamanho_id) REFERENCES tamanhos(tamanho_id),
    FOREIGN KEY (tecido_id)  REFERENCES tecidos(tecido_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS funcionarios (
    funcionario_id INT AUTO_INCREMENT PRIMARY KEY,
    nome           VARCHAR(100) NOT NULL,
    sobrenome      VARCHAR(100),
    local_id       INT,
    setor_id       INT,
    registro       VARCHAR(50)  UNIQUE NOT NULL,
    telefone       VARCHAR(20),
    dataregistro   DATETIME,
    senha          VARCHAR(255) NOT NULL,
    FOREIGN KEY (local_id)  REFERENCES locais(local_id),
    FOREIGN KEY (setor_id)  REFERENCES setores(setor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS vendas (
    venda_id     INT AUTO_INCREMENT PRIMARY KEY,
    codigo_venda VARCHAR(50)   NOT NULL,
    registro     VARCHAR(50)   NOT NULL,
    local_id     INT,
    pagamento_id INT,
    entrega_id   INT,
    cpf          VARCHAR(14),
    quantidade   INT,
    total        DECIMAL(10,2),
    data_venda   DATETIME,
    FOREIGN KEY (local_id)     REFERENCES locais(local_id),
    FOREIGN KEY (pagamento_id) REFERENCES pagamentos(pagamento_id),
    FOREIGN KEY (entrega_id)   REFERENCES entregas(entrega_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS transporte (
    transporte_id   INT AUTO_INCREMENT PRIMARY KEY,
    modelo_id       INT,
    quantidade      INT,
    local_id        INT,
    data_transporte DATETIME,
    FOREIGN KEY (modelo_id) REFERENCES modelos(modelo_id),
    FOREIGN KEY (local_id)  REFERENCES locais(local_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
