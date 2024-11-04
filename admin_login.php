<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
            font-size: 2em;
        }
        label, input[type="text"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 1em;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .logo {
            display: block; /* Center the logo */
            margin: 0 auto 20px; /* Center and add space below */
            width: 150px; /* Adjust width as necessary */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="University Logo" class="logo"> <!-- Add your logo here -->
        <h1>Admin Login</h1>
        <form action="admin_login_process.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='error'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
        </form>
    </div>
</body>
</html>
