<?php
    require_once '../src/credentials.php';
    require_once '../includes/utilities.php';
    require_once '../includes/validateFunctions.php';
    require_once '../includes/databaseFunctions.php';

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

            //TODO: Redirect to login page / Welcome page
    } else {
        echo $fail;
    }

    include 'registerForm.php';
?>