<?php
    session_start();

    // Checks to make sure there is a session active.
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        die ("<p><a href='loginForm.php'>You are not logged in! Click here to login.</a></p>"); //TODO: Bring up a box that says something similar to the message! and be able to exit out of it and be at the login page.
    }
?>

<!DOCTYPE html>
<html>

<!-- searchBookModule.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the page for searching for books.
-->

<head>
    <title> Book Search </title>
    <meta name="fileName" content="searchBookModule.php">
    <link rel="stylesheet" href="style.css">
</head>

<script>
    function validate(form) {
        fail = validateSearchInput(form.searchInput.value);
        if (fail == "") {
            return true;
        } else {
            alert(fail);
            return false;
        }
    }

    function validateSearchInput(field) {
        if (field == "") return "No search input was entered.\n";
            return "";
    }

</script>

<body>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div class="box">
            BCS350 Capstone Project -- Nathanael Germain
        </div>
        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <form action="returnToMainMenu.php" method="POST">
                <button type="submit" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Main Menu</button>
            </form>
            <form action="logout.php" method="POST">
                <button type="submit" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
            </form>
        </div>
    </div>
    <!-- TODO: Create searchBook.php, create session variables and send to listDataModule -->
    <form action="searchBook.php" method="POST" class="form-group-search" onsubmit="return validate(this)">
        <select name="option" style="margin-right: 10px;">
            <option value="ISBN">Search by ISBN</option>
            <option value="title">Search by Title</option>
            <option value="publisherName">Search by Publisher Name</option>
            <option value="formatName">Search by Format Name</option>
            <option value="haveRead">Search by if you Have Read the Book</option>
        </select>
        <input type="text" name="searchInput" id="searchInput" placeholder="Enter what you want to search for here"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                leading-tight focus:outline-none focus:shadow-outline" required>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded
                focus:outline-none focus:shadow-outline">Search</button>
    </form>

</body>

</html>