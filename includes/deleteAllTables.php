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