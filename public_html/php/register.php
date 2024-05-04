<?php
    require_once '../../src/credentials.php';
    require_once '../../includes/validateFunctions.php';
    require_once '../../includes/databaseFunctions.php';

    /* register.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to take the username, email, password, and confirm password from the registration form and
    * add it to the database if the information is validated.
    */

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $username = $email = $password = $confirmPassword = "";

    if (isset($_POST['username']))
        $username = fix_string($_POST['username']);
    if (isset($_POST['email']))
        $email = fix_string($_POST['email']);
    if (isset($_POST['password']))
        $password = fix_string($_POST['password']);
    if (isset($_POST['confirmPassword']))
        $confirmPassword = fix_string($_POST['confirmPassword']);

    $fail = validateUsername($pdo, $username);
    $fail .= validateEmail($email);
    $fail .= validatePassword($password);
    $fail .= validateConfirmPassword($password, $confirmPassword);

    if ($fail == "") {

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        addUser($pdo, $username, $email, $hashedPassword);

        echo "Registration successful! Please log in.";

        die ("<p><a href='../html/loginForm.php'>Click here to login</a></p>");
    } else {
        echo $fail;
        include '../html/registerForm.php'; // Brings you back to the registration page if there was an error.
    }
?>