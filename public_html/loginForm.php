<?php //session_start(); ?>

<!DOCTYPE html>
<html>

<!-- loginForm.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the file for the login form.
-->

<head>
    <title> Login Form </title>
    <meta name="fileName" content="loginForm.html">
    <link rel="stylesheet" href="style.css">
    <!-- <script src="loginValidation.js"></script> --> <!-- TODO: create a loginValidation file -->

</head>

<body>

    <div class="box">
        BCS350 Capstone Project -- Nathanael Germain
    </div>

    <form action="login.php" method="POST"> <!-- onsubmit="return validate(this)" --> <!-- TODO: create a loginValidation file -->
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
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
            <a href="registerForm.php"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</a>
        </div>
        
    </form>

</body>

</html>