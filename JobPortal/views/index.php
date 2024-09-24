<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Application Portal</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
        }

        header {
            background-color: #4CAF50; /* Green background */
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 400px; /* Adjusted for consistency */
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            color: white;
            background-color: #4CAF50; /* Green */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049; /* Darker green */
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Job Application Portal</h1>
    </header>
    <main>
        <div class="container">
            <h2>Welcome to the Job Application Portal</h2>
            <a href="register.php" class="btn">Register</a> <!-- Link to register.php -->
            <a href="login.php" class="btn">Login</a> <!-- Link to login.php -->
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Job Application Portal</p>
    </footer>
</body>
</html>
