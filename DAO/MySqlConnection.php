<?php

class MySqlConnection
{
    private static $connection;

    public function getConnection()
    {
       if (!self::$connection)
           self::$connection = new PDO('mysql:host=127.0.0.1;dbname=camagru', 'root', '75g03f24');
       self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$connection;
    }
}