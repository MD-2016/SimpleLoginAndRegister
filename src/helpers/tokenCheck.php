<?php

    function checkToken($token) {
        if(!$token || $token !== $_SESSION['token']) {
            echo "<p>","Invalid submission","</p>";
            header($_SERVER['SERVER_PROTOCOL'] . '405 Method not allowed');
            exit;
            return false;
        }

        return true;
    }