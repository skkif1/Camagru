<?php

require_once(root . '/config/database.php');

class MySqlConnection
{
    private static $connection;

    public function getConnection()
    {
        if (!self::$connection) {
            try {
                self::$connection = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                $conn = new PDO(ROOT_DB_DSN, DB_USER, DB_PASSWORD);
                $conn->query("CREATE DATABASE IF NOT EXISTS camagru");
                $conn = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                $conn->query(file_get_contents(root . '/config/dump.sql'));
            }
        }
        return self::$connection;
    }
}
