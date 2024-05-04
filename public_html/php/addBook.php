<?php
    session_start();

    require_once '../../src/credentials.php';
    require_once '../../includes/validateFunctions.php';
    require_once '../../includes/databaseFunctions.php';

    /* addBook.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to take data from the add book form and send it to a function
    * that will add the book to the database.
    */

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $ISBN = $title = $bookNumber =  $authors = $publisherName = $formatName = $year = $haveRead = "";

    if (isset($_POST['ISBN']))
        $ISBN = fix_string($_POST['ISBN']);
    if (isset($_POST['title']))
        $title = fix_string($_POST['title']);
    if (isset($_POST['bookNumber']))
        $bookNumber = fix_string($_POST['bookNumber']);
    if (isset($_POST['authors'])) {
        $authors = $_POST['authors']; // Authors gets the fix_string function in the parseAuthors function
        $authorDetails = parseAuthors($authors);
        $authors = fix_string($authors); // Only used for validation functions
    }
    if (isset($_POST['publisherName']))
        $publisherName = fix_string($_POST['publisherName']);
    if (isset($_POST['formatName']))
        $formatName = fix_string($_POST['formatName']);
    if (isset($_POST['year']))
        $year = fix_string($_POST['year']);
    if (isset($_POST['haveRead']))
        $haveRead = fix_string($_POST['haveRead']);

    $fail = validateISBN($pdo, $ISBN, $_SESSION['username']);
    $fail .= validateTitle($title);
    $fail .= validateBookNumber($bookNumber);
    $fail .= validateAuthors($authors);
    $fail .= validatePubName($publisherName);
    $fail .= validateFormatName($formatName);
    $fail .= validateYear($year);
    $fail .= validateHaveRead($haveRead);

    if ($fail == "") {

        addBook($pdo, $ISBN, $title, $bookNumber, $authorDetails, $publisherName, $formatName, $year, $haveRead, $_SESSION['username']);

        echo "Book added succesfully!";
        die ("<p><a href='../html/listDataModule.php'>Click here to return to you list of books!</a></p>");
    } else {
        echo $fail;
        die ("<p><a href='../html/addBookModule.php'>Click here to return to the Add Book Module</a></p>");
    }


?>