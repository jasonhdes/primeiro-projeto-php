-- =============================================================================
-- Seed — jasonh_erp
-- Run after migrate.sql. Populates all lookup tables and creates demo data:
--   • 3 stores (locais)
--   • 4 user levels × 2 users each = 8 funcionarios
--   • Colors, sizes, fabrics, product models, and stock entries
-- Passwords are stored as MD5 (matches the login query in index.php).
-- =============================================================================

USE jasonh_erp;

-- -----------------------------------------------------------------------------
-- Estados (Brazilian states)
-- -----------------------------------------------------------------------------
INSERT INTO estados (estado) VALUES
    ('Acre'),
    ('Alagoas'),
    ('Amapá'),
    ('Amazonas'),
    ('Bahia'),
    ('Ceará'),
    ('Distrito Federal'),
    ('Espírito Santo'),
    ('Goiás'),
    ('Maranhão'),
    ('Mato Grosso'),
    ('Mato Grosso do Sul'),
    ('Minas Gerais'),
    ('Pará'),
    ('Paraíba'),
    ('Paraná'),
    ('Pernambuco'),
    ('Piauí'),
    ('Rio de Janeiro'),
    ('Rio Grande do Norte'),
    ('Rio Grande do Sul'),
    ('Rondônia'),
    ('Roraima'),
    ('Santa Catarina'),
    ('São Paulo'),
    ('Sergipe'),
    ('Tocantins');

-- -----------------------------------------------------------------------------
-- Setores (user permission levels — IDs match hardcoded constants in home.php)
-- $adm=1  $ger=2  $alm=3  $ven=4
-- -----------------------------------------------------------------------------
INSERT INTO setores (setor_id, nome) VALUES
    (1, 'Administrador'),
    (2, 'Gerente'),
    (3, 'Almoxarifado'),
    (4, 'Vendas');

-- -----------------------------------------------------------------------------
-- Locais / Lojas (stores)
-- estado_id 25 = São Paulo, 19 = Rio de Janeiro, 16 = Paraná
-- -----------------------------------------------------------------------------
INSERT INTO locais (nome, endereco, estado_id, numero, complemento, telefone, cidade) VALUES
    ('Matriz',        'Av. Paulista',          25, '1000', 'Loja 10',   '(11) 3000-0001', 'São Paulo'),
    ('Filial Centro', 'Rua das Flores',        19, '250',  'Sala 1',    '(21) 3000-0002', 'Rio de Janeiro'),
    ('Filial Norte',  'Rua Marechal Deodoro',  16, '85',   'Loja 3',    '(41) 3000-0003', 'Curitiba');

-- -----------------------------------------------------------------------------
-- Pagamentos
-- -----------------------------------------------------------------------------
INSERT INTO pagamentos (pagamento) VALUES
    ('Dinheiro'),
    ('Cartão de Crédito'),
    ('Cartão de Débito'),
    ('PIX'),
    ('Boleto');

-- -----------------------------------------------------------------------------
-- Entregas
-- -----------------------------------------------------------------------------
INSERT INTO entregas (entrega) VALUES
    ('Retirada na Loja'),
    ('Entrega Expressa'),
    ('Sedex'),
    ('PAC');

-- -----------------------------------------------------------------------------
-- Cores
-- -----------------------------------------------------------------------------
INSERT INTO cores (cor) VALUES
    ('Azul'),
    ('Branco'),
    ('Cinza'),
    ('Laranja'),
    ('Preto'),
    ('Rosa'),
    ('Vermelho'),
    ('Verde'),
    ('Amarelo'),
    ('Bege');

-- -----------------------------------------------------------------------------
-- Tamanhos
-- -----------------------------------------------------------------------------
INSERT INTO tamanhos (tamanho) VALUES
    ('PP'),
    ('P'),
    ('M'),
    ('G'),
    ('GG'),
    ('XGG');

-- -----------------------------------------------------------------------------
-- Tecidos
-- -----------------------------------------------------------------------------
INSERT INTO tecidos (tecido) VALUES
    ('Algodão'),
    ('Poliéster'),
    ('Viscose'),
    ('Jeans'),
    ('Malha'),
    ('Linho'),
    ('Seda'),
    ('Nylon');

-- -----------------------------------------------------------------------------
-- Modelos (clothing products)
-- References: tamanho_id, cor_id, tecido_id — see inserts above (sequential IDs)
-- Cores:   Azul=1 Branco=2 Cinza=3 Laranja=4 Preto=5 Rosa=6 Vermelho=7 Verde=8
-- Tamanhos: PP=1 P=2 M=3 G=4 GG=5 XGG=6
-- Tecidos: Algodão=1 Poliéster=2 Viscose=3 Jeans=4 Malha=5 Linho=6 Seda=7 Nylon=8
-- -----------------------------------------------------------------------------
INSERT INTO modelos (codigo, nome, referencia, foto, preco, tamanho_id, cor_id, tecido_id) VALUES
    ('MDL-001', 'Camiseta Básica',        'REF-CB-001', NULL,  49.90,  3, 2, 1),
    ('MDL-002', 'Camiseta Básica',        'REF-CB-002', NULL,  49.90,  3, 5, 1),
    ('MDL-003', 'Calça Jeans Slim',       'REF-CJ-001', NULL, 189.90,  4, 1, 4),
    ('MDL-004', 'Calça Jeans Wide Leg',   'REF-CJ-002', NULL, 199.90,  3, 5, 4),
    ('MDL-005', 'Blusa Viscose Floral',   'REF-BV-001', NULL,  89.90,  2, 6, 3),
    ('MDL-006', 'Blusa Viscose Lisa',     'REF-BV-002', NULL,  79.90,  3, 3, 3),
    ('MDL-007', 'Bermuda Moletom',        'REF-BM-001', NULL,  99.90,  4, 3, 5),
    ('MDL-008', 'Bermuda Moletom',        'REF-BM-002', NULL,  99.90,  4, 5, 5),
    ('MDL-009', 'Vestido Linho',          'REF-VL-001', NULL, 149.90,  2, 2, 6),
    ('MDL-010', 'Vestido Linho',          'REF-VL-002', NULL, 149.90,  2, 6, 6),
    ('MDL-011', 'Polo Piquet',            'REF-PP-001', NULL, 119.90,  3, 1, 1),
    ('MDL-012', 'Polo Piquet',            'REF-PP-002', NULL, 119.90,  4, 5, 1),
    ('MDL-013', 'Regata Dry-Fit',         'REF-RD-001', NULL,  59.90,  2, 7, 2),
    ('MDL-014', 'Regata Dry-Fit',         'REF-RD-002', NULL,  59.90,  3, 8, 2),
    ('MDL-015', 'Jaqueta Nylon Leve',     'REF-JN-001', NULL, 259.90,  4, 5, 8);

-- -----------------------------------------------------------------------------
-- Estoque (inventory per store)
-- local_id: Matriz=1  Filial Centro=2  Filial Norte=3
-- Columns: codigo, nome, quantidade, preco, total, local_id, cor_id, tamanho_id, tecido_id
-- -----------------------------------------------------------------------------
INSERT INTO estoque (codigo, nome, quantidade, preco, total, local_id, cor_id, tamanho_id, tecido_id) VALUES
    -- Matriz
    ('MDL-001', 'Camiseta Básica',      30, 49.90,  1497.00, 1, 2, 3, 1),
    ('MDL-002', 'Camiseta Básica',      25, 49.90,  1247.50, 1, 5, 3, 1),
    ('MDL-003', 'Calça Jeans Slim',     15, 189.90, 2848.50, 1, 1, 4, 4),
    ('MDL-004', 'Calça Jeans Wide Leg', 12, 199.90, 2398.80, 1, 5, 3, 4),
    ('MDL-009', 'Vestido Linho',        10, 149.90, 1499.00, 1, 2, 2, 6),
    ('MDL-011', 'Polo Piquet',          20, 119.90, 2398.00, 1, 1, 3, 1),
    ('MDL-015', 'Jaqueta Nylon Leve',    8, 259.90, 2079.20, 1, 5, 4, 8),
    -- Filial Centro
    ('MDL-001', 'Camiseta Básica',      20, 49.90,   998.00, 2, 2, 3, 1),
    ('MDL-005', 'Blusa Viscose Floral', 18, 89.90,  1618.20, 2, 6, 2, 3),
    ('MDL-006', 'Blusa Viscose Lisa',   22, 79.90,  1757.80, 2, 3, 3, 3),
    ('MDL-007', 'Bermuda Moletom',      14, 99.90,  1398.60, 2, 3, 4, 5),
    ('MDL-013', 'Regata Dry-Fit',       30, 59.90,  1797.00, 2, 7, 2, 2),
    ('MDL-012', 'Polo Piquet',          10, 119.90, 1199.00, 2, 5, 4, 1),
    -- Filial Norte
    ('MDL-002', 'Camiseta Básica',      18, 49.90,   898.20, 3, 5, 3, 1),
    ('MDL-004', 'Calça Jeans Wide Leg',  9, 199.90, 1799.10, 3, 5, 3, 4),
    ('MDL-008', 'Bermuda Moletom',      16, 99.90,  1598.40, 3, 5, 4, 5),
    ('MDL-010', 'Vestido Linho',        11, 149.90, 1648.90, 3, 6, 2, 6),
    ('MDL-014', 'Regata Dry-Fit',       25, 59.90,  1497.50, 3, 8, 3, 2),
    ('MDL-015', 'Jaqueta Nylon Leve',    5, 259.90, 1299.50, 3, 5, 4, 8);

-- -----------------------------------------------------------------------------
-- Funcionarios (employees / system users)
--
-- Passwords are stored as MD5 — matches the WHERE clause in index.php:
--   WHERE registro = '{$registro}' and senha = md5('{$senha}')
--
-- Plaintext passwords for login testing:
--   registro 1001 → Admin@1      (setor: Administrador, loja: Matriz)
--   registro 1002 → Admin@2      (setor: Administrador, loja: Filial Centro)
--   registro 2001 → Gerente@1    (setor: Gerente,       loja: Matriz)
--   registro 2002 → Gerente@2    (setor: Gerente,       loja: Filial Centro)
--   registro 3001 → Almoxa@1     (setor: Almoxarifado,  loja: Matriz)
--   registro 3002 → Almoxa@2     (setor: Almoxarifado,  loja: Filial Norte)
--   registro 4001 → Vendas@1     (setor: Vendas,        loja: Filial Centro)
--   registro 4002 → Vendas@2     (setor: Vendas,        loja: Filial Norte)
-- -----------------------------------------------------------------------------
INSERT INTO funcionarios (nome, sobrenome, local_id, setor_id, registro, telefone, dataregistro, senha) VALUES
    -- Administradores (setor_id = 1)
    ('Carlos',  'Souza',     1, 1, '1001', '(11) 99000-0001', NOW(), MD5('Admin@1')),
    ('Fernanda','Lima',      2, 1, '1002', '(21) 99000-0002', NOW(), MD5('Admin@2')),
    -- Gerentes (setor_id = 2)
    ('Roberto', 'Alves',     1, 2, '2001', '(11) 99000-0003', NOW(), MD5('Gerente@1')),
    ('Juliana', 'Martins',   2, 2, '2002', '(21) 99000-0004', NOW(), MD5('Gerente@2')),
    -- Almoxarifado (setor_id = 3)
    ('Marcos',  'Ferreira',  1, 3, '3001', '(11) 99000-0005', NOW(), MD5('Almoxa@1')),
    ('Patricia','Costa',     3, 3, '3002', '(41) 99000-0006', NOW(), MD5('Almoxa@2')),
    -- Vendas (setor_id = 4)
    ('Lucas',   'Oliveira',  2, 4, '4001', '(21) 99000-0007', NOW(), MD5('Vendas@1')),
    ('Amanda',  'Rodrigues', 3, 4, '4002', '(41) 99000-0008', NOW(), MD5('Vendas@2'));
