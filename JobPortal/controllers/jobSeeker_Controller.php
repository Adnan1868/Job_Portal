<?php
session_start();
require '../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
        $stmt = $pdo->prepare("INSERT INTO job_seekers (full_name, email, contact_no, gender, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $contact_no, $gender, $password]);
        header('Location: ../views/login.php');
    } else {
        echo "Invalid email format.";
    }
}
?>
