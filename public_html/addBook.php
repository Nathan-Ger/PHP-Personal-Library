<?php

    require_once '../src/credentials.php';
    require_once '../includes/validateFunctions.php';
    require_once '../includes/databaseFunctions.php';

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $ISBN = $title = $bookNumber = $publisherName = $formatName = $year = $haveRead = "";

    if (isset($_POST['ISBN']))
        $ISBN = fix_string($_POST['ISBN']);
    if (isset($_POST['title']))
        $title = fix_string($_POST['title']);
    if (isset($_POST['bookNumber']))
        $bookNumber = fix_string($_POST['bookNumber']);
    if (isset($_POST['publisherName']))
        $publisherName = fix_string($_POST['publisherName']);
    if (isset($_POST['formatName']))
        $formatName = fix_string($_POST['formatName']);
    if (isset($_POST['year']))
        $year = fix_string($_POST['year']);
    if (isset($_POST['haveRead']))
        $haveRead = fix_string($_POST['haveRead']);

    $fail = validateISBN($ISBN);
    $fail .= validateTitle($title);
    $fail .= validateBookNumber($bookNumber);
    $fail .= validatePubName($publisherName);
    $fail .= validateFormatName($formatName);
    $fail .= validateYear($year);
    $fail .= validateHaveRead($haveRead);

    if ($fail == "") {

        // TODO: Add code to add the book to the database.
        // This function will then check if the data is already there and do the checks in that file.

        echo "Book added succesfully!"; // TODO: Change it so it looks better
        die ("<p><a href='listDataModule.php'>Click here to return to you list of books!</a></p>");
        //TODO: Change it so it outputs a textblock saying registration successful.
    } else {
        echo $fail;
        die ("<p><a href='addBookModule.php'>Click here to return to the Add Book Module</a></p>"); //TODO: Bring up a box that says return here and be able to exit out of it and be at the add book page.
    }


?>