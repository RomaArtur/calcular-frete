<?php

class database
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

           $dsn = "pgsql:host={$host};port={$port};dbname={$db};sslmode=require;options=endpoint=ep-royal-cake-a4tu0vrx";

            try {
                self::$pdo = new PDO($dsn, $user, $pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("ERRO: Falha ao conectar no PostgreSQL" . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

