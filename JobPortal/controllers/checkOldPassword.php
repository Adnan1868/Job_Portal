<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $old_password = $_POST['old_password'];

    // Fetch the current password from the database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user && password_verify($old_password, $user['password'])) {
        echo json_encode(['success' => true, 'message' => 'Old password is correct.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Old password is incorrect.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
