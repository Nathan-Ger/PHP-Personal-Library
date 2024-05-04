<?php
    session_start();

    require_once '../../src/credentials.php';
    require_once '../../includes/databaseFunctions.php';

    /* login.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to take the username and password from the login form and
    * add it to the session and log them in if the information is correct.
    */

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $un_temp = sanitize($pdo, $_POST['username']);
        $pw_temp = sanitize($pdo, $_POST['password']);

        authorizeUser($pdo, $un_temp, $pw_temp);

        echo htmlspecialchars("Welcome " . $_SESSION['username']);

        die ("<p><a href='../html/homePageForm.php'>Click here to continue</a></p>");
    } else {
        die ("Please enter your username and password");
    }
?>