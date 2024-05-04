<?php
    session_start(); // Not sure if you need to start a session to destroy it.

    /* logout.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to log the user out of the session.
    */

    session_destroy();

    echo $_SESSION['username'] . " is now logged out!";
    die ("<p><a href='../html/loginForm.php'>Click here to login again</a></p>");
?>