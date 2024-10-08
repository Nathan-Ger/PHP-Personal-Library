<?php
    session_start();

    // Checks to make sure there is a session active.
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        die ("<p><a href='loginForm.php'>You are not logged in! Click here to login.</a></p>");
    }

    if (isset($_SESSION['field']) && isset($_SESSION['value'])) {
        $field = $_SESSION['field'];
        $value = $_SESSION['value'];
        unset($_SESSION['field']);
        unset($_SESSION['value']);
    } else {
        $field = $value = 'none';
    }

?>

<!DOCTYPE html>
<html>

<!-- listDataModule.php
    @author Nathanael Germain
    I certify that this submission is my own original work.

    This is the page for listing data.
    It is the list data module of the project.
    The session is checked to make sure the user is actually logged in.
-->

<head>
    <title> Book List </title>
    <meta name="fileName" content="listDataModule.php">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div class="box">
            BCS350 Capstone Project -- Nathanael Germain
        </div>
        <div class="form-group" style="display: flex; justify-content: flex-end;">
            <form action="../php/returnToMainMenu.php" method="POST">
                <button type="submit" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Main Menu</button>
            </form>
            <form action="../php/logout.php" method="POST">
                <button type="submit" class="bg-green-500 hover:bg-green-700
                text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</button>
            </form>
        </div>
    </div>

    <!-- TODO: Add a way to edit book data -->
    <!-- You would have the user make a selection of what to edit, then bring up a form to edit the data -->
    <!-- This will not be added for final end product -->

    <table>
        <tr>
            <th>Book Title</th>
            <th>Book #</th>
            <th>Author(s)</th>
            <th>Publisher</th>
            <th>Format</th>
            <th>Year of Release</th>
            <th>Have Read?</th>
        </tr>
        <?php
            require_once '../../src/credentials.php';
            require_once '../../includes/databaseFunctions.php';

            try {
                $pdo = new PDO($attr, $user, $password, $opts);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        ?>
        <tr>
            <?php
            $books = retrieveBooks($pdo, $field, $value);

            foreach ($books as $book) {

                // Get ISBN, not displayed but used for other parts of the page.
                $ISBN = fix_string($book['ISBN']);

                echo "<tr>";
                echo "<td>" . sanitize($pdo, $book['title']) . "</td>";
                echo "<td>" . sanitize($pdo, $book['bookNumber']) . "</td>";

                // Retrieves all authors for given ISBN, sanitizes them, then displays them all (comma separated).
                $authors = retrieveAllAuthors($pdo, $ISBN);
                $authors = sanitize($pdo, implode(', ', $authors));
                echo "<td>" . $authors . "</td>";

                $publisherID = fix_string($book['publisherID']);
                $formatID = fix_string($book['formatID']);
                
                // Retrieves the publisher name and format name using the respective IDs.
                $publisherName = retrievePublisherName($pdo, $publisherID);
                $formatName = retrieveFormatName($pdo, $formatID);

                echo "<td>" . $pdo->quote($publisherName) . "</td>";
                echo "<td>" . $pdo->quote($formatName) . "</td>";
                echo "<td>" . sanitize($pdo, $book['year']) . "</td>";
                $read = (int)sanitize($pdo, $book['haveRead']) == 1 ? "Yes" : "No";
                echo "<td>" . $read . "</td>";

                // Adds a delete button to each row
                echo "<td>";
                echo "<form action='../php/delete.php' method='POST'>";
                echo "<input type='hidden' name='ISBN' value='" . $ISBN . "'>";
                echo "<input type='submit' value='Delete' class='delete-button'>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";

            }
            ?>
        </tr>

    </table>

</body>

</html>