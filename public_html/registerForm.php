<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: homePageForm.php'); //TODO: Bring to the home page
    exit();
}
?>

<!DOCTYPE html>
<html>

<!-- registerForm.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the file for the register form.
-->

<head>
    <title> Registration Form </title>
    <meta name="fileName" content="registerForm.php">
    <meta name="author" content="Nathanael Germain">
    <meta name="integrityStatement" content="I certify that this submission is my own original work.">
    <link rel="stylesheet" href="style.css">
    <script src="registerValidation.js"></script>
</head>

<body>

    <div class="box">
        BCS350 Capstone Project -- Nathanael Germain
    </div>

    <form action="register.php" method="POST" onsubmit="return validate(this)">
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username:</label>
            <input type="text" name="username" id="username"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
            <input type="text" name="email" id="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
            <input type="password" name="password" id="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">Confirm Password:</label>
            <input type="password" name="confirmPassword" id="confirmPassword"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="form-group">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
            <button type="button" style="margin-left: 10px;" onclick="window.location.href='loginForm.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login Here!</button>
        </div>
    </form>

</body>

</html>