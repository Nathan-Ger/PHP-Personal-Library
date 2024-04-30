<?php
    session_start();
    session_destroy();

    echo $_SESSION['username'] . " is now logged out!"; // TODO: Change it so it looks better
    die ("<p><a href='loginForm.php'>Click here to login again</a></p>"); //TODO: Bring up a box that says username is now logged out!  and be able to exit out of it and be at the home page.
?>