<?php
session_start();

// Enable detailed error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
require '../models/database.php';

try {
    // Check if request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check if email and password are set in POST data
        if (!isset($_POST['email'], $_POST['password'])) {
            throw new Exception("Email or password not provided.");
        }

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Check if email or password is empty
        if (empty($email) || empty($password)) {
            throw new Exception("Email or password cannot be empty.");
        }

        // Check if the database connection ($pdo) is successful
        if (!$pdo) {
            throw new Exception("Database connection failed.");
        }

        // Prepare and execute SQL to check if the user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        // Check if the user is found
        if ($stmt->rowCount() == 0) {
            throw new Exception("No user found with the provided email.");
        }

        $user = $stmt->fetch();

        // Verify if the provided password matches the hashed password in the database
        if (!password_verify($password, $user['password'])) {
            throw new Exception("Incorrect password.");
        }

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        // Check user type and redirect accordingly
        if ($user['user_type'] == 'employer') {
            header('Location: ../views/employer_dashboard.php');
        } elseif ($user['user_type'] == 'job_seeker') {
            header('Location: ../views/jobseeker_dashboard.php');
        } else {
            throw new Exception("Unknown user type.");
        }

        // Exit to prevent further code execution after redirection
        exit();
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    // Display detailed error message for debugging purposes
    echo "<h2>Error: " . htmlspecialchars($e->getMessage()) . "</h2>";
    echo "<p>File: " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p>Line: " . htmlspecialchars($e->getLine()) . "</p>";
    error_log("Login error: " . $e->getMessage());
}

?>
