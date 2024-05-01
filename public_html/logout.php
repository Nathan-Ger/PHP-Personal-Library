<?php
    session_start(); // Not sure if you need to start a session to destroy it.

    /* logout.php
    * @author Nathanael Germain
    * I certify that this submission is my own original work.
    *
    * This file is used to log the user out of the session.
    */

    session_destroy();

    echo $_SESSION['username'] . " is now logged out!"; // TODO: Change it so it looks better
    die ("<p><a href='loginForm.php'>Click here to login again</a></p>"); //TODO: Bring up a box that says username is now logged out!  and be able to exit out of it and be at the home page.
?>