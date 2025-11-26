-- ===================================================
-- 1. LIMPEZA DO AMBIENTE (RESET)
-- ===================================================
DROP TABLE IF EXISTS faixas_cep;
DROP TABLE IF EXISTS transportadoras;

-- ===================================================
-- 2. ESTRUTURA (DDL)
-- ===================================================

-- Tabela de Transportadoras
CREATE TABLE transportadoras (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de Regras de Frete (Faixas de CEP)
CREATE TABLE faixas_cep (
    id SERIAL PRIMARY KEY,
    transportadora_id INT NOT NULL,
    cep_inicio VARCHAR(8) NOT NULL,
    cep_fim VARCHAR(8) NOT NULL,
    
    -- Definição das Colunas de Valor para nossa Lógica Condicional:
    -- valor_kg_base: Preço fixo para o 1º KG
    -- valor_kg_adicional: Preço para cada KG excedente
    valor_kg_base DECIMAL(10, 2) NOT NULL,
    valor_kg_adicional DECIMAL(10, 2) NOT NULL,
    
    prazo_entrega INT NOT NULL,
    
    CONSTRAINT fk_transportadora
      FOREIGN KEY(transportadora_id) 
      REFERENCES transportadoras(id)
      ON DELETE CASCADE
);

-- ===================================================
-- 3. DADOS INICIAIS (SEED)
-- ===================================================

-- Criar as Empresas
INSERT INTO transportadoras (nome) VALUES ('Correios'), ('Loggi');

-- --- REGRAS DOS CORREIOS (ID 1) ---
-- Lógica de Preço: Base R$ 22,00 (1º Kg) + R$ 2,00 (Kg Extra) para bater R$ 25,00 em 2.5kg

-- Região 1: Sudeste/Sul (CEPs 0 a 3) -> Entrega Rápida (3 dias)
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (1, '00000000', '39999999', 22.00, 2.00, 3);

-- Região 2: Norte/Nordeste/Centro (CEPs 4 a 9) -> Entrega Lenta (8 dias)
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (1, '40000000', '99999999', 22.00, 2.00, 8);


-- --- REGRAS DA LOGGI (ID 2) ---
-- Lógica de Preço: Base R$ 18,50 (1º Kg) + R$ 5,00 (Kg Extra) para bater R$ 26,00 em 2.5kg

-- Região 1: Sudeste/Sul (CEPs 0 a 3) -> Entrega Relâmpago (1 dia)
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (2, '00000000', '39999999', 18.50, 5.00, 1);

-- Região 2: Norte/Nordeste/Centro (CEPs 4 a 9) -> Entrega Padrão (4 dias)
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (2, '40000000', '99999999', 18.50, 5.00, 4);