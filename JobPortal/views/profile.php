<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT full_name, email, gender, contact_number, user_type FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];

    $updateStmt = $pdo->prepare("UPDATE users SET full_name = ?, contact_number = ? WHERE id = ?");
    $updateStmt->execute([$full_name, $contact_number, $user_id]);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['success'] = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049; 
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profile</h2>
        <form method="POST">
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
            <label>Email:</label>
            <p><?= htmlspecialchars($user['email']) ?></p>
            <label>Gender:</label>
            <p><?= htmlspecialchars($user['gender']) ?></p>
            <label>Contact Number:</label>
            <input type="text" name="contact_number" value="<?= htmlspecialchars($user['contact_number']) ?>" required>
            <label>Status:</label>
            <p><?= htmlspecialchars(ucfirst($user['user_type'])) ?></p>

            <button type="submit">Update Profile</button>
        </form>
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p style='color:green;'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2024 Job Application Portal</p>
    </footer>
</body>
</html>
