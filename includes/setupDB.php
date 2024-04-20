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

    $query = "CREATE TABLE IF NOT EXISTS users (
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) PRIMARY KEY
    )";

    try
    {
        $result = $pdo->query($query);
    }
    catch (PDOException $e)
    {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }


?>