DROP TABLE IF EXISTS faixas_cep;
DROP TABLE IF EXISTS transportadoras;


CREATE TABLE transportadoras (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE faixas_cep (
    id SERIAL PRIMARY KEY,
    transportadora_id INT NOT NULL,
    
    cep_inicio VARCHAR(8) NOT NULL,
    cep_fim VARCHAR(8) NOT NULL,
    
    valor_kg_base DECIMAL(10, 2) NOT NULL,      
    valor_kg_adicional DECIMAL(10, 2) NOT NULL, 
    prazo_entrega INT NOT NULL,                
    

    CONSTRAINT fk_transportadora
      FOREIGN KEY(transportadora_id) 
      REFERENCES transportadoras(id)
      ON DELETE CASCADE
);

INSERT INTO transportadoras (nome) VALUES ('Correios');
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (1, '01000000', '99999999', 10.00, 3.00, 5);

INSERT INTO transportadoras (nome) VALUES ('Loggi');
INSERT INTO faixas_cep (transportadora_id, cep_inicio, cep_fim, valor_kg_base, valor_kg_adicional, prazo_entrega)
VALUES (2, '01000000', '99999999', 12.00, 2.00, 2);