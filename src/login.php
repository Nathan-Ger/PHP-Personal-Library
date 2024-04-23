<?php
session_start();

// Mock user credentials for validation
$valid_username = "admin";
$valid_password = "password123";

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // Redirect to welcome page
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
</head>
<body>
    <p><?php echo $error_message ?? ''; ?></p>
    <a href="index.html">Try Again</a>
</body>
</html>
