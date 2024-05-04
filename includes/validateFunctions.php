<?php
    /* validateFunctions.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used for validation functions,
    * such as validating the registration form and the add book form.
    */

    #region Registration Validation

    function validateUsername($pdo, $username) {
        if (duplicateUsername($pdo, $username))
            return "Username already exists.\\n";
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

    #endregion

    #region Add Book Validation

    /*
    * Below are the functions used for validating the add book form. They do not check for duplicates in the database,
    * as otherwise we would have to return IDs for authors and such. This code will be done in databaseFunctions.php,
    * as it is makes sense to have functions dedicated to returning IDs for the specific columns.
    */

    function validateISBN($pdo, $ISBN, $username) {
        if (bookDatabaseCheck($pdo, $ISBN, $username))
            return "ISBN already exists.\\n";
        if ($ISBN == "")
            return "No ISBN was entered.\\n";
        else if (strlen($ISBN) != 13)
            return "ISBN must be 13 characters.\\n";
        else if (preg_match("/[^0-9]/", $ISBN))
            return "Only 0-9 allowed in ISBN.\\n";
        return "";
    }

    function validateTitle($title) {
        if ($title == "")
            return "No Title was entered.\\n";
        return "";
    }

    function validateBookNumber($bookNumber) {
        if ($bookNumber == "")
            return "No Book Number was entered.\\n";
        else if (preg_match("/[^0-9]/", $bookNumber))
            return "Only 0-9 allowed in Book Number.\\n";
        return "";
    }

    function validateAuthors($authors) {
        if ($authors == "")
            return "No Author was entered.\\n";
        return "";
    }

    function validatePubName($publisherName) {
        if ($publisherName == "")
            return "No Publisher Name was entered.\\n";
        return "";
    }

    function validateFormatName($formatName) {
        if ($formatName == "")
            return "No Format Name was entered.\\n";
        return "";
    }

    function validateYear($year) {
        if ($year == "")
            return "No Year was entered.\\n";
        else if (strlen($year) != 4)
            return "Year must be 4 characters.\\n";
        else if (preg_match("/[^0-9]/", $year))
            return "Only 0-9 allowed in Year.\\n";
        return "";
    }

    function validateHaveRead($haveRead) {
        if ($haveRead == "")
            return "No Have Read was entered.\\n";

        // Convert to lowercase for comparison
        $haveRead = strtolower($haveRead);

        if ($haveRead != "yes" && $haveRead != "no"
                && $haveRead != "true" && $haveRead != "false"
                && $haveRead != "1" && $haveRead != "0"
                && $haveRead != "y" && $haveRead != "n"
                && $haveRead != "t" && $haveRead != "f")
            return "Only Yes or No allowed in Have Read.\\n";
        return "";
    }

    #endregion

    function validateSearchInput($searchInput) {
        if ($searchInput == "")
            return "No search input was entered.\\n";
        return "";
    }

?>