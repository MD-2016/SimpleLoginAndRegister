<?php

include("../config/db.php");

    // add admin role after testing

    class Admin {
        private $conn;

        public function addAdmin($email, $pass) {
            $conn = new Database();
            if($conn->connect() == null) {
                echo "connection has died";
            }
            $date = date('y-m-d H-m-sa');
            $sql = "INSERT INTO `Users`(`email`, `password`, `is_admin` , `joined`)VALUES(?,?,1,?)";
            $stmt = $conn->connect()->prepare($sql);
            return $stmt = $stmt->execute([$email, $pass, $date]);
        }

        public function removeAdmin($id) {
            $conn = new Database();
            if($conn->connect() == null) {
                echo "connection has died";
            }
            $sql = "DELETE FROM `Users` WHERE `user_id`=?";
            $stmt = $conn->connect()->prepare($sql);
            return $stmt->execute([$id]);
        }

        public function selectAdmin($id) {
            $conn = new Database();
            if($conn->connect() == null) {
                echo "connection has died";
            }
            $sql = "SELECT `email` `joined` WHERE `user_id`=?";
            $stmt = $conn->connect()->prepare($sql);
            $stmt->execute([$id]);
            $res = $stmt->fetchAll();
            return $res;
        }

        public function updateAdmin($id, $email, $pass) {
            $conn = new Database();
            if($conn->connect() == null) {
                echo "connection has died";
            }
            $sql = "UPDATE `email`, `password` WHERE `user_id`=?";
            $stmt = $conn->connect()->prepare($sql);
            $res = $stmt->execute([$email, $pass, $id]);
            return $res;
        }

        public function findAdmin($email, $pass) {
            $conn = new Database();
            if($conn->connect() == null) {
                echo "connection has died";
            }
            $sql = "SELECT `email` `password` FROM `Users` WHERE `email=:email`, `password=:password`";
            $stmt = $conn->connect()->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $pass, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }