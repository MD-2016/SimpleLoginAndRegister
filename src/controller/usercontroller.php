<?php
include('../model/user.php');

class UserController extends User {
    public function add_User($email, $pass) {
        return $this->addUser($email, $pass);
    }

    public function remove_User($id) {
        return $this->removeUser($id);
    }

    public function update_User($id, $email, $pass) {
        return $this->updateUser($id, $email, $pass);
    }

    public function select_User($id) {
        return $this->selectAllUser($id);
    }
}