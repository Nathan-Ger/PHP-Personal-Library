<?php

    /* credentials.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to store the credentials for the database.
    */

    $host = 'localhost';
    $data = 'bcs350sp24';
    $user = 'usersp24';
    $password = 'pwdsp24';
    $chrs = 'utf8mb4';
    $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
    $opts =
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

?>