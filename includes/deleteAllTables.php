<?php
    require_once 'login.php';

    /* deleteAllTables.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to drop all tables, purely used for testing purposes.
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
        "DROP TABLE IF EXISTS book_authors",
        "DROP TABLE IF EXISTS books",
        "DROP TABLE IF EXISTS formats",
        "DROP TABLE IF EXISTS authors",
        "DROP TABLE IF EXISTS publishers",
        "DROP TABLE IF EXISTS users"
    ];

    foreach ($queries as $query) {
        try {
            $result = $pdo->query($query);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
?>