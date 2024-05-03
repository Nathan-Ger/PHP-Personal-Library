<?php
    session_start();

    // Checks to make sure there is a session active.
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        die ("<p><a href='loginForm.php'>You are not logged in! Click here to login.</a></p>"); //TODO: Bring up a box that says something similar to the message! and be able to exit out of it and be at the login page.
    }
?>


<!DOCTYPE html>
<html>

<!-- addBookModule.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the form for adding a book to the database.
-->

<head>
    <title> Add Book </title>
    <meta name="fileName" content="addBookModule.php">
    <link rel="stylesheet" href="style.css">
    <script src="addBookValidation.js"></script>
</head>

<body>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div class="box">
            BCS350 Capstone Project -- Nathanael Germain
        </div>
        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <form action="logout.php" method="POST">
                <button type="submit" style="margin-left: 10px;" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
            </form>
        </div>
    </div>

    <!-- TODO: Add a way to go back to home page -->

    <form action="addBook.php" method="POST" onsubmit="return validate(this)">
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ISBN">ISBN-13:</label>
            <input type="text" name="ISBN" id="ISBN"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter ISBN, 0-9 only" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title:</label>
            <input type="text" name="title" id="title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter title" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="bookNumber">Number in Series:</label>
            <input type="text" name="bookNumber" id="bookNumber"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter the book number, 0-9 only" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="authors">Author(s):</label>
            <input type="text" name="authors" id="authors"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter author names, separated by commas" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="publisherName">Publisher Name:</label>
            <input type="text" name="publisherName" id="publisherName"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter publisher name" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="formatName">Format Type:</label>
            <input type="text" name="formatName" id="formatName"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter format name" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="year">Year Released:</label>
            <input type="text" name="year" id="year"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter year, in the format of 2001" required>
        </div>
        <div class="form-group">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="haveRead">Have You Read? (Yes or No):</label>
            <input type="text" name="haveRead" id="haveRead"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                style="max-width: 450px;" placeholder="Enter Yes or No" required>
        </div>
        <div class="form-group">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Book</button>
        </div>
    </form>

</body>

</html>