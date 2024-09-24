<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

// Call this function on pages where login is required
// checkLogin();
?>
