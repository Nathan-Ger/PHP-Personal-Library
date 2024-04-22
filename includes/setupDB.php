<?php
    require_once 'login.php';

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
            name VARCHAR(128) NOT NULL
        )",

        "CREATE TABLE IF NOT EXISTS authors (
            ID SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstName VARCHAR(128) NOT NULL,
            lastName VARCHAR(128) NOT NULL
        )",

        "CREATE TABLE IF NOT EXISTS formats (
            ID SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(128) NOT NULL
        )",

        "CREATE TABLE IF NOT EXISTS books (
            ISBN VARCHAR(13) NOT NULL PRIMARY KEY,
            title VARCHAR(128) NOT NULL,
            publisherID SMALLINT NOT NULL,
            formatID SMALLINT,
            year SMALLINT,
            haveRead BOOLEAN DEFAULT FALSE,
            INDEX(title(20)),
            FOREIGN KEY (publisherID) REFERENCES publishers(ID),
            FOREIGN KEY (formatID) REFERENCES formats(ID)
        )",
        "CREATE TABLE IF NOT EXISTS book_authors (
            book_ISBN VARCHAR(13) NOT NULL,
            author_ID SMALLINT NOT NULL,
            PRIMARY KEY (book_ISBN, author_ID),
            FOREIGN KEY (book_ISBN) REFERENCES books(ISBN),
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

    $queries = [
        
        // Inserting The Witcher: The Last Wish paperback book by Andrzej Sapkowski
        "INSERT INTO publishers (name) VALUES('Orbit')",
        "INSERT INTO authors (firstName, lastName) VALUES('Andrzej', 'Sapkowski')",
        "INSERT INTO formats (name) VALUES('Paperback')",
        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9780316438964, 'The Witcher: The Last Wish', 1, 1, 2017)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780316438964, 1)",

        // Inserting The Witcher: Sword of Destiny hardcover book by Andrzej Sapkowski
        "INSERT INTO formats (name) VALUES('Hardcover')",
        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9780316453264, 'The Witcher: Sword of Destiny', 1, 2, 2022)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9780316453264, 1)",

        // Inserting Grandmaster of Demonic Cultivation 1 paperback book by Mo Xiang Tong Xiu
        "INSERT INTO publishers (name) VALUES('Seven Seas Entertainment')",
        "INSERT INTO authors (firstName, lastName) VALUES('Mo Xiang', 'Tong Xiu')",
        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781648279195, 'Grandmaster of Demonic Cultivation 1', 2, 1, 2021)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781648279195, 2)",

        // Inserting the first 11 books of the Fairy Tale manga by Hiro Mashima
        "INSERT INTO publishers (name) VALUES('Kodansha Comics')",
        "INSERT INTO authors (firstName, lastName) VALUES('Hiro', 'Mashima')",
        "INSERT INTO formats (name) VALUES('Manga')",
        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622767, 'Fairy Tail 1', 3, 3, 2008)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622767, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622774, 'Fairy Tail 2', 3, 3, 2008)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622774, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622781, 'Fairy Tail 3', 3, 3, 2008)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622781, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622798, 'Fairy Tail 4', 3, 3, 2008)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622798, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612620985, 'Fairy Tail 5', 3, 3, 2008)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612620985, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612620992, 'Fairy Tail 6', 3, 3, 2009)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612620992, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612621005, 'Fairy Tail 7', 3, 3, 2009)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612621005, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612621012, 'Fairy Tail 8', 3, 3, 2009)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612621012, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622804, 'Fairy Tail 9', 3, 3, 2009)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622804, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622811, 'Fairy Tail 10', 3, 3, 2010)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622811, 3)",

        "INSERT INTO books (ISBN, title, publisherID, formatID, year) VALUES(9781612622828, 'Fairy Tail 11', 3, 3, 2010)",
        "INSERT INTO book_authors (book_ISBN, author_ID) VALUES(9781612622828, 3)"

    ];

    foreach ($queries as $query) {
        try {
            $result = $pdo->query($query);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    

?>