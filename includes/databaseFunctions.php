<?php
    require_once '../src/credentials.php';

    /* databaseFunctions.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used for all the functions that interact with the database.
    * This includes functions for adding, deleting, searching, and retrieving data.
    */

    #region Utility Functions

    function fix_string($string) {
        return htmlentities($string);
    }

    function sanitize($pdo, $string) {
        $string = fix_string($string);
        // Checks if it is an integer, if so then returns the number.
        if (is_numeric($string))
            return $string;
        else
            return $pdo->quote($string);
    }

    #endregion

    #region Login and Registration Functions

    function addUser($pdo, $username, $email, $hashedPassword) {
        $stmt = $pdo->prepare('INSERT INTO users VALUES (?, ?, ?)');

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);

        $stmt->execute([$username, $hashedPassword, $email]);
    }
    
    function duplicateUsername($pdo, $username) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->bindParam(1, $username);
        $stmt->execute([$username]);

        return $stmt->fetch() !== false;
    }

    function authorizeUser($pdo, $un_temp, $pw_temp) {

        $query = "SELECT * FROM users WHERE username=$un_temp";
        $result = $pdo->query($query);

        if (!$result->rowCount())
            die("User not found");

        $row = $result->fetch();
        $un = $row['username'];
        $em = $row['email'];
        $pw = $row['password'];

        if (password_verify(str_replace("'", "", $pw_temp), $pw)) {

            $_SESSION['username'] = $un;
            $_SESSION['email'] = $em;

        } else die("Invalid username/password combination");
    }

    #endregion

    #region Retrieving Data Functions

    function retrieveAllBooks($pdo, $field, $value) {
        // TODO: Make a new field for bookSeriesName and leave a series name as that, for example,
        // 'The Witcher' would be the bookSeriesName, while 'The Last Wish' would be the title
        // This would allow for a series to be grouped together, and allow for a series to be displayed in a more organized manner

        if ($field == 'none') {
            $stmt = $pdo->prepare('SELECT * FROM books WHERE username = ? ORDER BY title, bookNumber');
            $stmt->bindParam(1, $_SESSION['username']);
            $stmt->execute();
        }

        // TODO: Add more fields to search by, such as author, publisher, format, ISBN, title, and haveRead.
        // $value is the value that is being searched for. THIS DATA MUST BE SANITIZED BEFORE BEING PASSED TO THIS FUNCTION.

        return $stmt->fetchAll();
    }

    function retrieveAllAuthors($pdo, $ISBN) {
        $stmt = $pdo->prepare('SELECT author_ID FROM book_authors WHERE book_ISBN = ?');
        $stmt->bindParam(1, $ISBN);
        $stmt->execute();

        $authorIDs = $stmt->fetchAll();
        $authorNames = [];

        foreach ($authorIDs as $authorID) {
            $stmt = $pdo->prepare('SELECT firstName, lastName FROM authors WHERE ID = ?');
            $stmt->bindParam(1, $authorID['author_ID']);
            $stmt->execute();

            $author = $stmt->fetch();
            $authorNames[] = $author['firstName'] . ' ' . $author['lastName'];
        }

        return $authorNames;
    }

    function retrievePublisherName($pdo, $publisherID) {
        $stmt = $pdo->prepare('SELECT * FROM publishers WHERE ID = ?');
        $stmt->bindParam(1, $publisherID);
        $stmt->execute();
        
        return $stmt->fetch()['name'];
    }

    function retrieveFormatName($pdo, $formatID) {
        $stmt = $pdo->prepare('SELECT * FROM formats WHERE ID = ?');
        $stmt->bindParam(1, $formatID);
        $stmt->execute();

        return $stmt->fetch()['name'];
    }

    #endregion

    function deleteBook($pdo, $ISBN) {
        $stmt = $pdo->prepare('DELETE FROM books WHERE ISBN = ? AND username = ?');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();
    }

    function addBook($pdo, $ISBN, $title, $bookNumber, $authors, $publisherName, $formatName, $year, $haveRead, $username) {
        $haveRead = strtolower($haveRead);

        if($haveRead == 'yes' || $haveRead == 'y' || $haveRead == '1' || $haveRead == 'true' || $haveRead == 't')
            $haveRead = 1;
        else
            $haveRead = 0;

        // TODO: Explode the authors, then check whether they exist in the authors table, if not add them.

        $publisherID = retrieveOrAddID($pdo, $publisherName, 'publishers');
        $formatID = retrieveOrAddID($pdo, $formatName, 'formats');

        $stmt = $pdo->prepare('INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, haveRead, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $title);
        $stmt->bindParam(3, $bookNumber);
        $stmt->bindParam(4, $publisherID);
        $stmt->bindParam(5, $formatID);
        $stmt->bindParam(6, $year);
        $stmt->bindParam(7, $haveRead);
        $stmt->bindParam(8, $username);
        $stmt->execute();

        // TODO: Add to books_author table, make sure to check first
    }

    function bookDatabaseCheck($pdo, $ISBN, $username) {
        $stmt = $pdo->prepare('SELECT * FROM books WHERE ISBN = ? AND username = ?');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $username);
        $stmt->execute();

        // Returns true if book exists, false if it does not.
        return $stmt->rowCount() > 0;
    }

    function retrieveOrAddID($pdo, $name, $table) {
        $stmt = $pdo->prepare('SELECT ID FROM ' . $table . ' WHERE name = ?');
        $stmt->bindParam(1, $name);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $stmt = $pdo->prepare('INSERT INTO ' . $table . ' (name) VALUES (?)');
            $stmt->bindParam(1, $name);
            $stmt->execute([$name]);

            return $pdo->lastInsertId();
        } else {
            $result = $stmt->fetch();
            return $result['ID'];
        }
    }

    /*function retrievePublisherID($pdo, $publisherName) {
        $stmt = $pdo->prepare('SELECT ID FROM publishers WHERE name = ?');
        $stmt->bindParam(1, $publisherName);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $stmt = $pdo->prepare('INSERT INTO publishers (name) VALUES (?)');
            $stmt->bindParam(1, $publisherName);
            $stmt->execute([$publisherName]);

            return $pdo->lastInsertId();
        } else {
            $result = $stmt->fetch();
            return $result['ID'];
        }
    }*/

    /* retrieveOrAddID($pdo, $name, $table)
    *
    * This function is used to retrieve the ID of a given name from a given table.
    * It only works with tables that have an ID and name column (e.g. publishers, formats)
    * If the name is not found in the table, it will be added to the table and returned.
    */
    


    /*function retrieveFormatID($pdo, $formatName) {
        $stmt = $pdo->prepare('SELECT ID FROM formats WHERE name = ?');
        $stmt->bindParam(1, $formatName);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $stmt = $pdo->prepare('INSERT INTO formats (name) VALUES (?)');
            $stmt->bindParam(1, $formatName);
            $stmt->execute([$formatName]);

            return $pdo->lastInsertId();
        } else {
            $result = $stmt->fetch();
            return $result['ID'];
        }
    }*/


?>