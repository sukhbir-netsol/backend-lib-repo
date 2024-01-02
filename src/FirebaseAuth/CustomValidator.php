<?php 
namespace FirebaseAuth;

class CustomValidator {
    public static function validateEmail($email) :bool
    {
        // Use PHP filter_var function to validate email
        $emailIsValid = false;
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailIsValid = true; // Valid email
        } 
        return $emailIsValid;
    }
    public static function validateName($name) : bool
    {
        // Use a regular expression to validate name (allowing only letters and spaces)
        $nameIsValid = false;
        if (!empty($name) && preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $nameIsValid = true;
        } 
        return $nameIsValid;
    }
}

