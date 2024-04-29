<?php
    require_once '../src/credentials.php';
    require_once '../includes/utilities.php';

    #region Login and Registration Functions

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

?>