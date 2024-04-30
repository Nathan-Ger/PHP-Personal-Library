<?php
    session_start();

    require_once '../src/credentials.php';
    require_once '../includes/databaseFunctions.php';

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $ISBN = "";

    if (isset($_POST['ISBN']))
        $ISBN = $_POST['ISBN'];

    deleteBook($pdo, $ISBN);

    echo "Book deleted!"; // TODO: Change it so it looks better
    die ("<p><a href='welcomeForm.php'>Click here to return</a></p>"); //TODO: Bring up a box that says Book Deleted! with a button to saying OK and be able to exit out of it and be at the home page.
?>