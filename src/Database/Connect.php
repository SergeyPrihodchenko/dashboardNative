<?php

namespace S\P\Database;

final class Connect {

    private static ?\PDO $pdo = null;
    private static ?string $driver = null;
    private static ?string $domain = null;
    private static ?string $dbName = null;
    private static ?string $username = null;
    private static ?string $password = null;


    private function __construct()
    {
        
    }

    public static function setAttributs(
        string $driver,
        string $domain,
        string $dbName,
        string $username,
        string $password,
    )
    {
        self::$driver = $driver; 
        self::$domain = $domain; 
        self::$dbName = $dbName; 
        self::$username = $username; 
        self::$password = $password; 
    }

    public static function getInstance()
    {
        if(is_null(self::$pdo)) {

            $driver = self::$driver;
            $domain = self::$domain;
            $dbName = self::$dbName;
            $username = self::$username;
            $password = self::$password;

            self::$pdo = new \PDO("$driver:host=$domain;dbname=$dbName", $username, $password);
        }

        return self::$pdo;
    }
}