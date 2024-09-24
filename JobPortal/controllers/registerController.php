<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize user input
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $gender = $_POST['gender'];
    $user_type = $_POST['user_type']; // Get user type from form
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation checks
    if (empty($full_name) || empty($email) || empty($contact_number) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: ../views/register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: ../views/register.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: ../views/register.php');
        exit();
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Email already exists.";
        header('Location: ../views/register.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database based on user type
    try {
        if ($user_type === 'employer') {
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, gender, contact_number, user_type) VALUES (?, ?, ?, ?, ?, 'employer')");
            $stmt->execute([$full_name, $email, $hashed_password, $gender, $contact_number]);
        } else {
            // Assume user_type can be job_seeker
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, gender, contact_number, user_type) VALUES (?, ?, ?, ?, ?, 'job_seeker')");
            $stmt->execute([$full_name, $email, $hashed_password, $gender, $contact_number]);
        }

        $_SESSION['success'] = "Registration successful! You can now log in.";
        header('Location: ../views/login.php'); // Redirect to login page
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Registration failed: " . $e->getMessage();
        header('Location: ../views/register.php');
        exit();
    }
}
?>
