<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    if ($stmt->execute([$new_password, $user_id])) {
        echo json_encode(['success' => true, 'message' => 'Password changed successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to change password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
