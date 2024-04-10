<?php

class Validate {
    
    public static function validateEmail($input) {
        $errors = [];
        if(empty($input)) {
            $errors[] = 'Email is required';
        }

        
        if(!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email must be in proper format with name @ domain';
        }

        return $errors;
    }

    public static function validatePassword($password) {
        $errors = "";
        if(empty($password)) {
            $errors = 'Password cannot be blank';
        }

        return $errors;
    }

    public static function validateRepeatPassword($firstpass, $secondpass) {
        $errors = [];
        if(empty($firstpass) || empty($secondpass)) {
            $errors[] = 'Both password fields must be filled out';
        }

        if(strncmp($firstpass, $secondpass, count($firstpass)) != 0) {
            $errors[] = 'Passwords do not match';
        }

        return $errors;
    }
}