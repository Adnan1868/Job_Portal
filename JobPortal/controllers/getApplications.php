<?php
session_start();
require '../models/database.php';

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $stmt = $pdo->prepare("SELECT ja.*, js.full_name FROM job_applications ja JOIN job_seekers js ON ja.job_seeker_id = js.id WHERE ja.job_listing_id = ?");
    $stmt->execute([$job_id]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($applications);
}
?>
