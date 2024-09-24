<?php
session_start();
require '../models/database.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'employer') {
    header('Location: login.php');
    exit();
}

// Fetch job listings for the logged-in employer
$stmt = $pdo->query("SELECT * FROM job_listings WHERE employer_id = " . $_SESSION['user_id']);
$job_listings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Employer Dashboard</h1>
    </header>

    <div class="sidebar">
        <a href="profile.php">Profile</a>
        <a href="postjob.php">Post Job</a> <!-- Redirect to postjob.php -->
        <a href="changepassword.php">Change Password</a> <!-- Change Password link -->
    </div>

    <div class="content">
        <h2>Job Listings</h2>
        <table>
            <tr>
                <th>Position Name</th>
                <th>Salary</th>
                <th>Working Hours</th>
            </tr>
            <?php foreach ($job_listings as $job): ?>
                <tr>
                    <td><?php echo htmlspecialchars($job['position_name']); ?></td>
                    <td><?php echo htmlspecialchars($job['salary']); ?></td>
                    <td><?php echo htmlspecialchars($job['working_hours']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <button id="viewApplications">View Applications</button>
        <div id="applications"></div>

        <script>
            document.getElementById('viewApplications').addEventListener('click', function() {
                fetch('../controllers/getApplications.php?job_id=1') // Replace 1 with the actual job ID
                    .then(response => response.json())
                    .then(data => {
                        let output = '<h2>Job Applications</h2><ul>';
                        data.forEach(application => {
                            output += `<li>${application.full_name} - Status: ${application.status}</li>`;
                        });
                        output += '</ul>';
                        document.getElementById('applications').innerHTML = output;
                    })
                    .catch(error => console.error('Error fetching applications:', error));
            });
        </script>
    </div>

    <footer>
        <p>Job Application Portal &copy; 2024</p>
    </footer>
</body>
</html>
