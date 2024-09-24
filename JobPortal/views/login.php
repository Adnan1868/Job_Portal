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
    <title>Login - Job Application Portal</title>
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
            max-width: 400px; /* Consistent width */
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        input[type="email"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background: #4CAF50; /* Green */
            color: #ffffff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #45a049; /* Darker green */
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

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Job Application Portal</h1>
    </header>
    <main>
        <div class="container">
            <h2>Login</h2>
            <form action="../controllers/loginController.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Job Application Portal</p>
    </footer>
</body>
</html>
