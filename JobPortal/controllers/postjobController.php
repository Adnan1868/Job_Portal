<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'employer') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve job details from the form
    $position_name = trim($_POST['position_name']);
    $salary = trim($_POST['salary']);
    $working_hours = trim($_POST['working_hours']);
    $employer_id = $_SESSION['user_id']; // Assuming this is set during login

    if (empty($position_name) || empty($salary) || empty($working_hours)) {
        $_SESSION['error'] = "All fields are required.";
        header('Location: ../views/postjob.php');
        exit();
    }

    try {
        // Prepare and execute the insertion query
        $stmt = $pdo->prepare("INSERT INTO job_listings (employer_id, position_name, salary, working_hours) VALUES (?, ?, ?, ?)");
        $stmt->execute([$employer_id, $position_name, $salary, $working_hours]);

        $_SESSION['success'] = "Job posted successfully!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Failed to post job: " . $e->getMessage();
    }

    // Redirect back to the post job page
    header('Location: ../views/postjob.php');
    exit();
}

// Optional: if no POST request was made, you could redirect back
header('Location: ../views/postjob.php');
exit();
?>
