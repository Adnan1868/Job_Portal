<?php
session_start();

require '../models/database.php';

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['email'], $_POST['password'])) {
            throw new Exception("Email or password not provided.");
        }

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            throw new Exception("Email or password cannot be empty.");
        }

        if (!$pdo) {
            throw new Exception("Database connection failed.");
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() == 0) {
            throw new Exception("No user found with the provided email.");
        }

        $user = $stmt->fetch();

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Incorrect password.");
        }

        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        if ($user['user_type'] == 'employer') {
            header('Location: ../views/employer_dashboard.php');
        } elseif ($user['user_type'] == 'job_seeker') {
            header('Location: ../views/jobseeker_dashboard.php');
        } else {
            throw new Exception("Unknown user type.");
        }

        exit();
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {

    echo "<h2>Error: " . htmlspecialchars($e->getMessage()) . "</h2>";
    echo "<p>File: " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p>Line: " . htmlspecialchars($e->getLine()) . "</p>";
    error_log("Login error: " . $e->getMessage());
}

?>
