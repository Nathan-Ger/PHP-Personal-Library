<?php
    session_start();

    require_once '../../src/credentials.php';
    require_once '../../includes/databaseFunctions.php';

    /* delete.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to take data the ISBN from one of the dataList forms and
    * send it to a function that will delete the book from the database.
    */

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $ISBN = "";

    if (isset($_POST['ISBN']))
        $ISBN = $_POST['ISBN'];

    deleteBook($pdo, $ISBN);

    echo "Book deleted!";
    die ("<p><a href='../html/homePageForm.php'>Click here to return to home page</a></p>");
?>