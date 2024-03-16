<?php

require_once __DIR__ . "/../inc/config.php";

class database
{
    public function query($sql)
    {
        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt;

        } catch (\PDOException $err) {
            
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ];
            
        }
    }
}