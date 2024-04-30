<?php
    require_once '../src/credentials.php';
    require_once '../includes/databaseFunctions.php';
    require_once '../includes/utilities.php';

    /* setupDB.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to create the tables for the book database then create some sample data.
    */

    try
    {
        $pdo = new PDO($attr, $user, $password, $opts);
    }
    catch (PDOException $e)
    {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $queries = [

        "CREATE TABLE IF NOT EXISTS users (
            username VARCHAR(50) NOT NULL PRIMARY KEY,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE
        )",

        "CREATE TABLE IF NOT EXISTS publishers (
            ID SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(128) NOT NULL UNIQUE
        )",

        "CREATE TABLE IF NOT EXISTS authors (
            ID SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstName VARCHAR(128) NOT NULL,
            lastName VARCHAR(128) NOT NULL,
            FULLTEXT(firstName, lastName)
        )",

        "CREATE TABLE IF NOT EXISTS formats (
            ID SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(128) NOT NULL UNIQUE
        )",

        "CREATE TABLE IF NOT EXISTS books (
            bookID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            ISBN VARCHAR(13) NOT NULL,
            title VARCHAR(128) NOT NULL,
            bookNumber SMALLINT,
            publisherID SMALLINT,
            formatID SMALLINT,
            year SMALLINT,
            haveRead BOOLEAN DEFAULT FALSE,
            username VARCHAR(50) NOT NULL,
            FULLTEXT(title),
            INDEX(ISBN),
            INDEX(publisherID),
            INDEX(formatID),
            INDEX(username),
            FOREIGN KEY (publisherID) REFERENCES publishers(ID),
            FOREIGN KEY (formatID) REFERENCES formats(ID),
            FOREIGN KEY (username) REFERENCES users(username)
        )",
        "CREATE TABLE IF NOT EXISTS book_authors (
            book_ISBN VARCHAR(13) NOT NULL,
            author_ID SMALLINT NOT NULL,
            PRIMARY KEY (book_ISBN, author_ID),
            INDEX(book_ISBN),
            FOREIGN KEY (author_ID) REFERENCES authors(ID)
        )"

    ];

    foreach ($queries as $query) {
        try {
            $result = $pdo->query($query);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Creating a test user admin, this is because our books table requires a username, only people with a given username can access their books

    $username = 'admin';
    $password = password_hash('mysql', PASSWORD_BCRYPT);
    $email = 'admin@admin.org';

    $stmt = $pdo->prepare('INSERT INTO users VALUES (?, ?, ?)');

    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);

    $stmt->execute([$username, $password, $email]);

    $queries = [
        
        // Inserting The Witcher: The Last Wish paperback book by Andrzej Sapkowski
        "INSERT INTO publishers (name) VALUES('Orbit')",
        "INSERT INTO authors (firstName, lastName) VALUES('Andrzej', 'Sapkowski')",
        "INSERT INTO formats (name) VALUES('Paperback')",
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9780316438964, 'The Witcher: The Last Wish', 1, 1, 1, 2017, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780316438964, 1)",

        // Inserting The Witcher: Sword of Destiny hardcover book by Andrzej Sapkowski
        "INSERT INTO formats (name) VALUES('Hardcover')",
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9780316453264, 'The Witcher: Sword of Destiny', 2, 1, 2, 2022, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780316453264, 1)",

        // Inserting Grandmaster of Demonic Cultivation 1 paperback book by Mo Xiang Tong Xiu
        "INSERT INTO publishers (name) VALUES('Seven Seas Entertainment')",
        "INSERT INTO authors (firstName, lastName) VALUES('Mo Xiang', 'Tong Xiu')",
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781648279195, 'Grandmaster of Demonic Cultivation', 1, 2, 1, 2021, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781648279195, 2)",

        // Inserting the first 11 books of the Fairy Tale manga by Hiro Mashima,
        // This allows us to test multiple books in the same series.
        "INSERT INTO publishers (name) VALUES('Kodansha Comics')",
        "INSERT INTO authors (firstName, lastName) VALUES('Hiro', 'Mashima')",
        "INSERT INTO formats (name) VALUES('Manga')",

        // Book 1
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622767, 'Fairy Tail', 1, 3, 3, 2008, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622767, 3)",

        // Book 2
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622774, 'Fairy Tail', 2, 3, 3, 2008, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622774, 3)",

        // Book 3
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622781, 'Fairy Tail', 3, 3, 3, 2008, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622781, 3)",

        // Book 4
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622798, 'Fairy Tail', 4, 3, 3, 2008, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622798, 3)",

        // Book 5
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612620985, 'Fairy Tail', 5, 3, 3, 2008, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612620985, 3)",

        // Book 6
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612620992, 'Fairy Tail', 6, 3, 3, 2009, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612620992, 3)",

        // Book 7
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612621005, 'Fairy Tail', 7, 3, 3, 2009, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612621005, 3)",

        // Book 8
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612621012, 'Fairy Tail', 8, 3, 3, 2009, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612621012, 3)",

        // Book 9
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622804, 'Fairy Tail', 9, 3, 3, 2009, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622804, 3)",

        // Book 10
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622811, 'Fairy Tail', 10, 3, 3, 2010, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622811, 3)",

        // Book 11
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9781612622828, 'Fairy Tail ', 11, 3, 3, 2010, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622828, 3)",

        // Inserting The Copper Gauntlet book by Cassandra Clare and Holly Black, this allows us to test multiple authors
        "INSERT INTO publishers (name) VALUES('Scholastic')",
        "INSERT INTO authors (firstName, lastName) VALUES('Cassandra', 'Clare')",
        "INSERT INTO authors (firstName, lastName) VALUES('Holly', 'Black')",
        "INSERT INTO books (ISBN, title, bookNumber, publisherID, formatID, year, username) VALUES(9780545522298, 'The Copper Gauntlet', 2, 4, 1, 2015, 'admin')",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780545522298, 4)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780545522298, 5)"

    ];

    foreach ($queries as $query) {
        try {
            $result = $pdo->query($query);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
?>