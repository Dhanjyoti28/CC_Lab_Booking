<?php
include 'db.php';
session_start();

// Define admin credentials
$default_username = "admin";
$default_password = "admin123";

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Verify the credentials
if ($username === $default_username && $password === $default_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_page.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid username or password.";
    header("Location: admin_login.php");
    exit();
}
?>
