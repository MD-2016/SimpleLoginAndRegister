<?php

include 'config.php';

    class Database {
      private $pdo;  
        public function connect() {
            try {
                $this->pdo = new PDO($dsn, $user, $pass);

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            return $this->pdo;
        }
    }