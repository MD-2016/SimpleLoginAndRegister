<?php
include("../model/admin.php");

class AdminController extends Admin {
    public function add_Admin($email, $pass) {
        return $this->addAdmin($email, $pass);
    }

    public function remove_Admin($id) {
        return $this->removeAdmin($id);
    }

    public function update_Admin($id, $email, $pass) {
        return $this->updateAdmin($id, $email, $pass);
    }

    public function select_Admin($id) {
        return $this->selectAdmin($id);
    }

    public function find_Admin($email, $pass) {
        return $this->find_Admin($email, $pass);
    }
}

