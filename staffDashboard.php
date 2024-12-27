<?php
session_start();

// Check if the user is logged in and if they are a staff member
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header('Location: login.php');
    exit;
}

// Prevent browser from caching the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Staff Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>Welcome to BCHRMS Staff Dashboard</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Records Review</h5>
                        <p class="card-text">15 records awaiting review</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Appointments</h5>
                        <p class="card-text">8 appointments scheduled</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Recent Staff Activities</h5>
                        <p class="card-text">20 activities logged</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Staff Announcements</h3>
            <ul class="list-group">
                <li class="list-group-item">Staff meeting scheduled for 2024-11-15</li>
                <li class="list-group-item">New guidelines for record management</li>
            </ul>
        </div>

        <div class="mt-4">
            <h3>Tasks Assigned to You</h3>
            <ul class="list-group">
                <li class="list-group-item">Review Dodong's dental exam records</li>
                <li class="list-group-item">Prepare reports for upcoming staff meeting</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>