<?php
    require_once '../src/credentials.php';
    require_once '../includes/utilities.php';

    #region Utility Functions

    function fix_string($string) {
        return htmlentities($string);
    }

    function sanitize($pdo, $string) {
        $string = fix_string($string);
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

    function retrieveAllBooks($pdo) {
        // TODO: Make a new field for bookSeriesName and leave a series name as that, for example,
        // 'The Witcher' would be the bookSeriesName, while 'The Last Wish' would be the title
        // This would allow for a series to be grouped together, and allow for a series to be displayed in a more organized manner
        $stmt = $pdo->prepare('SELECT * FROM books WHERE username = ? ORDER BY title, bookNumber');
        $stmt->bindParam(1, $_SESSION['username']);
        $stmt->execute();

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

?>