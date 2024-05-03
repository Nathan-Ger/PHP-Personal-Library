<?php
    session_start();

    require_once '../src/credentials.php';
    require_once '../includes/validateFunctions.php';
    require_once '../includes/databaseFunctions.php';

    /* searchBook.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to take data from the search book form and set them as
    * session variables to be used in the listDataModule.php file.
    */

    try {
        $pdo = new PDO($attr, $user, $password, $opts);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $searchInput = $option = "";

    if (isset($_POST['searchInput']))
        $searchInput = fix_string($_POST['searchInput']);

    $option = $_POST['option'];

    $fail = validateSearchInput($searchInput);

    if ($fail == "") {

        $_SESSION['value'] = $searchInput;
        $_SESSION['field'] = $option;

        header("Location: listDataModule.php");
        exit;
    } else {
        echo $fail;
        die ("<p><a href='searchBookModule.php'>Click here to return to the Search Book Module</a></p>"); //TODO: Bring up a box that says return here and be able to exit out of it and be at the add book page.
    }


?>