<?php

require_once 'backend/database.php';

try {
    $pdo = database::getConnection();
    echo "Conexão bem-sucedida.";
} catch (Exception $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}


