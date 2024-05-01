<?php
    session_start();

    require_once '../src/credentials.php';
    require_once '../includes/databaseFunctions.php';

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

        die ("<p><a href='homePageForm.php'>Click here to continue</a></p>"); //TODO: Bring up a box that says Welcome $_SESSION['username'] and be able to exit out of it and be at the home page.
    } else {
        die ("Please enter your username and password");
    }
?>