<?php
session_start();
require '../models/database.php';
require '../controllers/applyforjobsController.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'job_seeker') {
    header('Location: login.php');
    exit();
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Jobs</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Available Jobs</h1>
    </header>

    <div class="sidebar">
        <a href="jobseeker_dashboard.php">Dashboard</a>
        <a href="profile.php">Profile</a>
        <a href="changepassword.php">Change Password</a>
    </div>

    <div class="content">
        <h2>Jobs You Can Apply For</h2>
        <table>
            <tr>
                <th>Job Position</th>
                <th>Salary</th>
                <th>Working Hours</th>
                <th>Action</th>
            </tr>
            <?php if ($available_jobs): ?>
                <?php foreach ($available_jobs as $job): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($job['position_name']); ?></td>
                        <td><?php echo htmlspecialchars($job['salary']); ?></td>
                        <td><?php echo htmlspecialchars($job['working_hours']); ?></td>
                        <td>
                            <form method="POST" action="applyforjobs.php">
                                <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                                <button type="submit" name="apply" class="apply-btn">Apply</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No jobs available at the moment.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <footer>
        <p>Job Application Portal &copy; 2024</p>
    </footer>
</body>
</html>
