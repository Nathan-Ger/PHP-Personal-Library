<?php
    session_start();

    // Checks to make sure there is a session active.
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        die ("<p><a href='loginForm.php'>You are not logged in! Click here to login.</a></p>");
    }
?>

<!DOCTYPE html>
<html>

<!-- homePageForm.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the page a user enters after logging in.
    It is the home page of the project.
    The session is checked to make sure the user is actually logged in.
-->

<head>
    <title> Home Page - Welcome <?php echo $_SESSION['username']; ?> </title>
    <meta name="fileName" content="homePageForm.php">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div class="box">
            BCS350 Capstone Project -- Nathanael Germain
        </div>
        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <form action="../php/logout.php" method="POST">
                <button type="submit" style="margin-left: 10px;" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
            </form>
        </div>
    </div>
    <div class="form-group">
        <button type="button" style="margin-left: 10px;" onclick="window.location.href='listDataModule.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">List all Data</button>
        <button type="button" style="margin-left: 10px;" onclick="window.location.href='searchBookModule.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Search for Books</button>
        <button type="button" style="margin-left: 10px;" onclick="window.location.href='addBookModule.php'"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add a Book</button>
    </div>


</body>

</html>