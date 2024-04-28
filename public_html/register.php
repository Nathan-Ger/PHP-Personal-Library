<?php
    require_once '../src/login.php';
    require_once '../includes/utilities.php';
    require_once '../includes/validateFunctions.php';

    $username = $email = $password = $confirmPassword = "";

    if (isset($_POST['username']))
        $username = fix_string($_POST['username']);
    if (isset($_POST['email']))
        $email = fix_string($_POST['email']);
    if (isset($_POST['password']))
        $password = fix_string($_POST['password']);
    if (isset($_POST['confirmPassword']))
        $confirmPassword = fix_string($_POST['confirmPassword']);

    $fail = validateUsername($username);
    $fail .= validateEmail($email);
    $fail .= validatePassword($password);
    $fail .= validateConfirmPassword($password, $confirmPassword);

    if ($fail == "") {
        
        echo "</head><body>Form data successfully validated:
            $username, $email, $password, $confirmPassword.</body></html>";

        //TODO: Add user to database

        //TODO: Redirect to login page / Welcome page
    } else {
        echo $fail;
    }

    include 'registerForm.php';
?>