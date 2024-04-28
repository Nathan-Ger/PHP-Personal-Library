<?php
    /* validateFunctions.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used for validation functions, that are used in the registration purpose of the project.
    * Truthfully this code is not necessary, but I just generally prefer more "abstraction" in my code.
    * But this project in particular has no need for it.
    */

    function validateUsername($pdo, $username) {


        if ($username == "")
            return "No Username was entered.\\n";
        else if (strlen($username) < 6)
            return "Usernames must be at least 6 characters.\\n";
        else if (preg_match("/[^a-zA-Z0-9_-]/", $username))
            return "Only a-Z, A-Z 0-9, - and _ allowed in Usernames.\\n";
        return "";
    }

    function validateEmail($email) {
        if ($email == "")
            return "No Email was entered.\\n";
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return "The Email Address is invalid.\\n";
        return "";
    }
    
    function validatePassword($password) {
        if ($password == "")
            return "No Password was entered.\\n";
        else if (strlen($password) < 8)
            return "Passwords must be at least 8 characters.\\n";
        else if (!preg_match("/[a-z]/", $password) ||
                !preg_match("/[A-Z]/", $password) ||
                !preg_match("/[0-9]/", $password))
            return "Passwords require 1 each of a-z, A-Z and 0-9.\\n";
        return "";
    }

    function validateConfirmPassword($password, $confirmPassword) {
        if ($password != $confirmPassword)
            return "Passwords do not match.\\n";
        return "";
    }

?>