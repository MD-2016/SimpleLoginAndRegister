<?php

 require "../config/db.php";
 
 class User {
     public $conn;

    public function addUser($email, $pass){
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $date = date('y-m-d');
        $sql = "INSERT INTO `Users`(`email`, `password`, `is_admin`,`joined`)VALUES(?,?,0,?)";
        $stmt = $conn->prepare($sql);
        return $stmt = $stmt->execute([$email, $pass, $date]);
    }
    public function removeUser($id){
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "DELETE FROM `Users` WHERE `user_id`=?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]); 
    }
    public function selectUser($id){
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "SELECT `email`,`joined` WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetchAll();
        return $res;
    }
    public function updateUser($id, $email, $pass){
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "UPDATE `email`, `password` WHERE `user_id`=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$email,$pass,$id]);
        return $res;
    }

    public function addUserCookie($id, $cookie, $expire) {
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "UPDATE Users SET cookie=:cookie, cookieexpire=:expire WHERE user_id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cookie', $cookie, PDO::PARAM_STR);
        $stmt->bindParam(':expire', $expire, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function findUserByCookie($cookie) { 
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "SELECT cookie, user_id, email FROM Users WHERE cookie=:cookie";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cookie', $cookie, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    
    public function deleteUserCookie($id) {
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "UPDATE `Users` SET cookie=:cookie, cookieexpire=:expire WHERE cookie=:session";
        $cookie = null;
        $expire = null;

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cookie', $cookie, PDO::PARAM_STR);
        $stmt->bindParam(':expire', $expire, PDO::PARAM_STR);
        $stmt->bindParam(':session', $);
        $stmt->execute();
        return $stmt;

    }
    
    
    public function findUser($email) {
        $db = new DB();
        $conn = $db->connect();
        if($conn == null) {
            echo "connection has died";
        }
        $sql = "SELECT user_id, email, password FROM Users WHERE email=:email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

 }