<?php
session_start(); // Start the session

// Check if the user is logged in (optional)
if (isset($_SESSION['user_id'])) {
    session_destroy(); // Destroy the session to log out the user
}

// Redirect to the main page (index.php)
header("Location: index.php");
exit(); // Ensure no further code is executed after redirection
?>
