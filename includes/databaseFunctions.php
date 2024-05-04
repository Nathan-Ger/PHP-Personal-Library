<?php

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

    function retrieveBooks($pdo, $field, $value) {
        // TODO: Make a new field for bookSeriesName and leave a series name as that, for example,
        // 'The Witcher' would be the bookSeriesName, while 'The Last Wish' would be the title
        // This would allow for a series to be grouped together, and allow for a series to be displayed in a more organized manner

        $books = [];

        if ($field == 'ISBN')
            $books = retrieveBooksByISBN($pdo, $value);
        else if ($field == 'title')
            $books = retrieveBooksByTitle($pdo, $value);
        else if ($field == 'haveRead')
            $books = retrieveBooksByHaveRead($pdo, $value);
        else if ($field == 'formatName' || $field == 'publisherName')
            $books = retrieveBooksByFormatPublisher($pdo, $field, $value);
        else { // Defualt; Will get all books
            $stmt = $pdo->prepare('SELECT * FROM books WHERE username = ? ORDER BY title, bookNumber');
            $stmt->bindParam(1, $_SESSION['username']);
            $stmt->execute();
            $books = $stmt->fetchAll();
        }

        // TODO: Search by authors.

        return $books;
    }

    function retrieveBooksByISBN($pdo, $ISBN) {
        $stmt = $pdo->prepare('SELECT * FROM books WHERE ISBN = ? AND username = ? ORDER BY title, bookNumber');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();
        return $stmt->fetch();
    }

    function retrieveBooksByTitle($pdo, $title) {
        $title = '%' . $title . '%';
        $stmt = $pdo->prepare('SELECT * FROM books WHERE title LIKE ? AND username = ? ORDER BY title, bookNumber');
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function retrieveBooksByHaveRead($pdo, $haveRead) {
        $haveRead = strtolower($haveRead);
        if ($haveRead == 'yes' || $haveRead == 'y' || $haveRead == '1' || $haveRead == 'true' || $haveRead == 't')
            $haveRead = 1;
        else
            $haveRead = 0;

        $stmt = $pdo->prepare('SELECT * FROM books WHERE haveRead = ? AND username = ? ORDER BY title, bookNumber');
        $stmt->bindParam(1, $haveRead);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function retrieveBooksByFormatPublisher($pdo, $field, $value) {
        $table = '';
        $books = [];

        if ($field == 'formatName') {
            $table = 'formats';
            $fieldName = 'formatID';
        }
        else if ($field == 'publisherName') {
            $table = 'publishers';
            $fieldName = 'publisherID';
        }

        $IDs = retrieveID($pdo, $value, $table);

        if (!$IDs)
            return [];

        // Makes it an array if it only returns one ID,
        // this is just to make sure it is an array for the following foreach loop.
        if (!is_array($IDs))
            $IDs = [$IDs];

        foreach ($IDs as $ID) {
            $stmt = $pdo->prepare('SELECT * FROM books WHERE ' . $fieldName . ' = ?
                                    AND username = ? ORDER BY title, bookNumber');
            $stmt->bindParam(1, $ID['ID']); // $ID is an array, because $IDs is an array of arrays because of how I returned it from the retrieveID function.
            $stmt->bindParam(2, $_SESSION['username']);
            $stmt->execute();

            // Merge the newly gotten away into the books array
            $books = array_merge($books, $stmt->fetchAll());
        }
        return $books;
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

    #region Add Book Functions

    function addBook($pdo, $ISBN, $title, $bookNumber, $authorDetails, $publisherName,
                        $formatName, $year, $haveRead, $username) {
        $haveRead = strtolower($haveRead);

        if($haveRead == 'yes' || $haveRead == 'y' || $haveRead == '1' || $haveRead == 'true' || $haveRead == 't')
            $haveRead = 1;
        else
            $haveRead = 0;

        // Will get the list of authorDetails and add any to authors table if they do not exist.
        $authorIDs = [];
        $j = 0;
        for ($i = 0; $i < count($authorDetails); $i += 2) {
            $firstName = $authorDetails[$i];
            $lastName = $authorDetails[$i + 1];

            $authorID = retrieveOrAddAuthor($pdo, $firstName, $lastName);
            $authorIDs[$j] = $authorID;
            $j++;
        }

        $publisherID = retrieveOrAddID($pdo, $publisherName, 'publishers');
        $formatID = retrieveOrAddID($pdo, $formatName, 'formats');

        $stmt = $pdo->prepare('INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID,
                                year, haveRead, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $title);
        $stmt->bindParam(3, $bookNumber);
        $stmt->bindParam(4, $publisherID);
        $stmt->bindParam(5, $formatID);
        $stmt->bindParam(6, $year);
        $stmt->bindParam(7, $haveRead);
        $stmt->bindParam(8, $username);
        $stmt->execute();

        foreach ($authorIDs as $authorsID)
            checkBookAuthors($pdo, $ISBN, $authorsID);
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
            $stmt->execute();

            return $pdo->lastInsertId();
        } else {
            $result = $stmt->fetch();
            return $result['ID'];
        }
    }

    function checkBookAuthors($pdo, $ISBN, $authorID) {
        $stmt = $pdo->prepare('SELECT * FROM book_authors WHERE book_ISBN = ? AND author_ID = ?');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $authorID);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $stmt = $pdo->prepare('INSERT INTO book_authors (book_ISBN, author_ID) VALUES (?, ?)');
            $stmt->bindParam(1, $ISBN);
            $stmt->bindParam(2, $authorID);
            $stmt->execute();
        }

    }

    function retrieveID($pdo, $name, $table) {
        $name = '%' . $name . '%';
        $stmt = $pdo->prepare('SELECT ID FROM ' . $table . ' WHERE name LIKE ?');
        $stmt->bindParam(1, $name);
        $stmt->execute();

        $result = $stmt->fetchAll();
        
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    function retrieveOrAddAuthor($pdo, $firstName, $lastName) {
        $stmt = $pdo->prepare('SELECT ID FROM authors WHERE firstName = ? AND lastName = ?');
        $stmt->bindParam(1, $firstName);
        $stmt->bindParam(2, $lastName);
        $stmt->execute();

        if (!$stmt->rowCount()) {
            $stmt = $pdo->prepare('INSERT INTO authors (firstName, lastName) VALUES (?, ?)');
            $stmt->bindParam(1, $firstName);
            $stmt->bindParam(2, $lastName);
            $stmt->execute([$firstName, $lastName]);

            return $pdo->lastInsertId();
        } else {
            $result = $stmt->fetch();
            return $result['ID'];
        }
    }

    /* parseAuthors($authors)
    *
    * This function is used to parse the authors string into an array of first and last names.
    * It first separates the authors by the comma.
    * Then it separates the first and last names by the space and adds them in the order of first name, last name
    * to an array and returns it.
    *
    * @param $authors - The string of authors to be parsed.
    * @return $authorsDetails - The array of first and last names of the authors.
    */
    function parseAuthors($authors) {
        $authorArray = explode(", ", $authors);

        $authorsDetails = [];

        $j = 0;
        for ($i = 0; $i < count($authorArray); $i++) {
            $authorsNames = explode(" ", $authorArray[$i]);

            $firstName = $authorsNames[0];
            $authorsDetails[$j] = $firstName;
            $j++;

            if (isset($authorsNames[1])) {
                $lastName = $authorsNames[1];
            } else {
                $lastName = "";
            }
            $authorsDetails[$j] = $lastName;
            $j++;
        }

        for ($i = 0; $i < count($authorsDetails); $i++) {
            $authorsDetails[$i] = fix_string($authorsDetails[$i]);
        }

        return $authorsDetails;
    }

    #endregion

    function searchBook($pdo, $searchInput, $option) {
        $stmt = $pdo->prepare('SELECT * FROM books WHERE ' . $option . ' = ? AND username = ?');
        $stmt->bindParam(1, $searchInput);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function deleteBook($pdo, $ISBN) {
        $stmt = $pdo->prepare('DELETE FROM books WHERE ISBN = ? AND username = ?');
        $stmt->bindParam(1, $ISBN);
        $stmt->bindParam(2, $_SESSION['username']);
        $stmt->execute();
    }

?>