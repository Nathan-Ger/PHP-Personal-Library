<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: homePageForm.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<!-- loginForm.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the file for the login form.
    Checks if a user is logged in and if they are, they are redirected to the home page.
-->

<head>
    <title> Login Form </title>
    <meta name="fileName" content="loginForm.php">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="box">
        BCS350 Capstone Project -- Nathanael Germain
    </div>

    <form action="../php/login.php" method="POST">
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username:</label>
            <input type="text" name="username" id="username"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
            <input type="password" name="password" id="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
            <button type="button" style="margin-left: 10px;" onclick="window.location.href='registerForm.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register Here!</button>
        </div>
        
    </form>

</body>

</html>