<?php

class DBConnect
{
    private static $host = 'localhost';
    private static $username = 'root';
    private static $password = 'Ziffity@15';
    private static $database = 'myDB';

    private static $connection = null;
    public static function getConnection()
    {
        $conn = new mysqli(self::$host, self::$username, self::$password, self::$database);
        if ($conn->connect_error) {
            die("Connection failed: " .$conn->connect_error);
        }else{
            return $conn;
        }
    }
}

