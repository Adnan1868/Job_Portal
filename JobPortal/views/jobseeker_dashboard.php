<?php
session_start();
require '../models/database.php';

// Debugging: Check if session variables are correctly set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    echo "Session variables are not set!";
    exit();
}

if ($_SESSION['user_type'] != 'job_seeker') {
    header('Location: login.php');
    exit();
}

// Fetch job applications for the logged-in job seeker
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM job_applications WHERE user_id = ?");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Job Seeker Dashboard</h1>
    </header>

    <div class="sidebar">
        <a href="profile.php">Profile</a>
        <a href="changepassword.php">Change Password</a>
        <a href="apply_for_job.php">Apply for Job</a>
    </div>

    <div class="content">
        <h2>Your Application Status</h2>
        <table>
            <tr>
                <th>Job Position</th>
                <th>Status</th>
            </tr>
            <?php if ($applications): ?>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['position_name']); ?></td>
                        <td><?php echo htmlspecialchars($application['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">No applications found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <footer>
        <p>Job Application Portal &copy; 2024</p>
    </footer>
</body>
</html>
