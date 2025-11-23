<?php

namespace App\Controllers;

use App\Services\FreteService;
use App\Utils\Response;

class FreteController {
    
    public function calcular() {

        $jsonRecebido = file_get_contents("php://input");
        $dados = json_decode($jsonRecebido, true);

        if (!isset($dados['cep']) || !isset($dados['peso'])) {
            return Response::json([
                'erro' => 'Requisição inválida',
                'detalhes' => 'Os campos "cep" e "peso" são obrigatórios.'
            ], 400); 
        }

        $cep = preg_replace('/[^0-9]/', '', $dados['cep']);
        
        $peso = (float) $dados['peso'];

        try {
            $servico = new FreteService();
            $resultado = $servico->calcularFrete($cep, $peso);

            if (empty($resultado)) {
                return Response::json(['mensagem' => 'Nenhuma transportadora atende este CEP.'], 404);
            }

            return Response::json($resultado, 200);

        } catch (\Exception $e) {
            return Response::json([
                'erro_interno' => 'Não foi possível calcular o frete.',
                'debug' => $e->getMessage() 
            ], 500);
        }
    }
}

