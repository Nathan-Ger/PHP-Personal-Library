<?php //session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <title> BCS350 Captsone Project -- Nathanael Germain </title>
    <meta name="fileName" content="registerForm.html">
    <meta name="author" content="Nathanael Germain">
    <meta name="integrityStatement" content="I certify that this submission is my own original work">
    <link rel="stylesheet" href="style.css">
    <script src="registerValidation.js"></script>

</head>

<body>

    <div class="box">
        BCS350 Captsone Project -- Nathanael Germain
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
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Log
                In</button>
        </div>
    </form>

</body>

</html>