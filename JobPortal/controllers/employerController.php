<?php
session_start();
require '../models/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validation (Regex for email)
    if (preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
        $stmt = $pdo->prepare("INSERT INTO employers (company_name, email, contact_no, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$company_name, $email, $contact_no, $password]);
        header('Location: ../views/login.php');
    } else {
        echo "Invalid email format.";
    }
}
?>
