<?php

class DB {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;

    public function connect() {
        try {
            $host = "localhost";
            $db = "logindb";
            $user = "md";
            $pass = "wwe";
            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $pdo = new PDO($dsn,$user,$pass);
            return $pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}