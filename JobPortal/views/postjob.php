<?php
session_start();
require '../models/database.php';

// Check if the user is logged in as an employer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'employer') {
    header('Location: login.php');
    exit();
}

// Initialize message variable
$message = '';

// Check for any session messages from the controller
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear the message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Job</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }
        .btn {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #45a049; /* Darker green */
        }
        .message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Post a Job</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form action="../controllers/postjobController.php" method="POST">
            <input type="text" name="position_name" placeholder="Position Name" required>
            <input type="number" name="salary" placeholder="Salary" required>
            <input type="text" name="working_hours" placeholder="Working Hours" required>
            <button type="submit" class="btn">Post Job</button>
        </form>
    </div>
</body>
</html>
