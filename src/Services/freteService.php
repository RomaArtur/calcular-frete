<?php

namespace App\Services;

use App\Config\Database;
use PDO;

class FreteService { 

    public function calcularFrete(string $cep, float $peso): array {
        $pdo = Database::getConnection();

        $sql = "SELECT 
                    t.nome as transportadora_nome, 
                    f.valor_kg_base, 
                    f.valor_kg_adicional, 
                    f.prazo_entrega
                FROM faixas_cep f
                INNER JOIN transportadoras t ON f.transportadora_id = t.id
                WHERE :cep >= f.cep_inicio AND :cep <= f.cep_fim";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cep' => $cep]);
        
        $resultados = $stmt->fetchAll();

        if (empty($resultados)) {
            return []; 
        }

        $resposta = [];

        foreach ($resultados as $regra) {

            $valorBase = (float)$regra['valor_kg_base'];
            $valorAdicional = (float)$regra['valor_kg_adicional'];
            
            $valorTotal = $valorBase + ($peso * $valorAdicional);

            $resposta[] = [
                "transportadora" => $regra['transportadora_nome'],
                "valor" => number_format($valorTotal, 2, ',', '.'), 
                "prazo" => $regra['prazo_entrega'] . " dias"
            ];
        }

        return $resposta;
    }
}