<?php
    require_once '../src/credentials.php';
    require_once '../includes/utilities.php';

    function addUser($pdo, $username, $email, $hashedPassword) {

        $stmt = $pdo->prepare('INSERT INTO users VALUES (?, ?, ?)');

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);

        $stmt->execute([$username, $hashedPassword, $email]);

    }

    function sanitize($pdo, $string) {
        $string = fix_string($string);
        return $pdo->quote($string);
    }

?>