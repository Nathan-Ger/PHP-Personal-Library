<?php
session_start();
session_destroy();

echo $_SESSION['username'] . " is now logged out!";
// TODO: Lead user back to login pagem with above error message.

?>