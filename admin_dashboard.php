<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // If not logged in, redirect to login page
    header("Location: admin_login.php");
    exit();
}
?>

<!-- Admin Dashboard HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your existing admin dashboard CSS here -->
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <p><a href="logout.php">Logout</a></p>
    <!-- Rest of the admin dashboard content -->
</body>
</html>
