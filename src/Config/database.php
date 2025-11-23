<?php

namespace App\Config;

use PDO;
use PDOException;

class Database 
{
    private static $pdo = null;

    private function __construct()
    {
    }

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $host = 'ep-royal-cake-a4tu0vrx-pooler.us-east-1.aws.neon.tech';
            $db   = 'neondb';
            $user = 'neondb_owner';
            $pass = 'npg_wlI1toD2AsnG';
            $port = '5432';

            $endpoint_id = 'ep-royal-cake-a4tu0vrx';

            $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require;options=endpoint={$endpoint_id}";

            try {
                self::$pdo = new PDO($dsn, $user, $pass);
                
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {

                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["erro_critico" => "Falha ao conectar no PostgreSQL: " . $e->getMessage()]);
                exit;
            }
        }

        return self::$pdo;
    }
}
