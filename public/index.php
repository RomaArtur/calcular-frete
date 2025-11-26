<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\FreteController;
use App\Utils\Response;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && $uri === '/') {
    echo json_encode(["status" => "API Online", "uso" => "Envie uma requisição POST para /calcular_frete com os parâmetros necessários."]);
    exit;
}

if ($method === 'POST' && ($uri === '/calcular_frete' || $uri === '/')) {
    $controller = new FreteController();
    $controller->calcular();
} else {
    if ($method !== 'GET') {
        http_response_code(404);
        echo json_encode(['erro' => 'Rota não encontrada']);
    }
}