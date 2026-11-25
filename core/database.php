<?php

require_once __DIR__ . '/config.php';

class Database
{
    public function connect()
    {
        try {
            $connection = new PDO(
                "mysql:host=" . DB_HOST .
                ";dbname=" . DB_NAME .
                ";charset=utf8mb4",
                DB_USER,
                DB_PASS
            );

            $connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $connection;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("Database connection failed.");
        }
    }
}