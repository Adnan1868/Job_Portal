<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'employer') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Add your CSS styles here */
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
        input[type="password"] {
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
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form id="changePasswordForm">
            <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
            <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
            <input type="password" id="retype_password" name="retype_password" placeholder="Retype New Password" required>
            <button type="submit" class="btn">Change Password</button>
        </form>
        <div id="message" class="message"></div>
    </div>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const oldPassword = document.getElementById('old_password').value;
            const newPassword = document.getElementById('new_password').value;
            const retypePassword = document.getElementById('retype_password').value;
            const messageDiv = document.getElementById('message');

            // Validate passwords match
            if (newPassword !== retypePassword) {
                messageDiv.textContent = "New passwords do not match.";
                return;
            }

            // Check old password
            const formData = new FormData();
            formData.append('old_password', oldPassword);

            fetch('../controllers/checkOldPassword.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Proceed to change the password
                    const changeData = new FormData();
                    changeData.append('new_password', newPassword);

                    return fetch('../controllers/changepasswordController.php', {
                        method: 'POST',
                        body: changeData
                    });
                } else {
                    messageDiv.textContent = data.message;
                }
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.textContent = data.message;
                if (data.success) {
                    // Redirect after successful change
                    setTimeout(() => {
                        window.location.href = 'employer_dashboard.php';
                    }, 2000);
                }
            })
            .catch(error => {
                messageDiv.textContent = "An error occurred. Please try again.";
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
