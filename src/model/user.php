<?php

 include "../config/db.php";
 
 class User {
     public $conn;

    public function addUser($email, $pass){
        $conn = new Database;
        if($conn->connect() == null) {
            echo "connection has died";
        }
        $date = date('y-m-d H-m-sa');
        $sql = "INSERT INTO `Users`(`email`, `password`, `is_admin`,`joined`)VALUES(?,?,0,?)";
        $stmt = $conn->connect()->prepare($sql);
        return $stmt = $stmt->execute([$email, $pass, $date]);
    }
    public function removeUser($id){
        $conn = new Database;
        if($conn->connect() == null) {
            echo "connection has died";
        }
        $sql = "DELETE FROM `Users` WHERE `user_id`=?";
        $stmt = $conn->connect()->prepare($sql);
        return $stmt->execute([$id]); 
    }
    public function selectAllUser($id){
        $conn = new Database;
        if($conn->connect() == null) {
            echo "connection has died";
        }
        $sql = "SELECT `email`,`joined` WHERE user_id=?";
        $stmt = $conn->connect()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }
    public function updateUser($id, $email, $pass){
        $conn = new Database;
        if($conn->connect() == null) {
            echo "connection has died";
        }
        $sql = "UPDATE `email`, `password` WHERE `user_id`=?";
        $stmt = $conn->connect()->prepare($sql);
        $res = $stmt->execute([$email,$pass,$id]);
        return $res;
    }

 }