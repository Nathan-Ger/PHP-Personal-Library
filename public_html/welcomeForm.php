<?php
    session_start();

    // Checks to make sure there is a session active.
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        die ("<p><a href='loginForm.php'>You are not logged in! Click here to login.</a></p>"); //TODO: Bring up a box that says something similar to the message! and be able to exit out of it and be at the login page.
    }

?>

<!DOCTYPE html>
<html>

<!-- welcomeForm.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the page a user enters after logging in.
    It is the home page of the project.
    The session is checked to make sure the user is actually logged in.
-->

<head>
    <title> Home Page - Welcome <?php echo $_SESSION['username']; ?> </title>
    <meta name="fileName" content="welcomeForm.html">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="box">
        BCS350 Capstone Project -- Nathanael Germain
    </div>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Test1:</label>
            <input type="text" name="username" id="username"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Test2:</label>
            <input type="password" name="password" id="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
            <button type="button" style="margin-left: 10px;" onclick="window.location.href='registerForm.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register Here!</button>
        </div>
        
    </form>

</body>

</html>