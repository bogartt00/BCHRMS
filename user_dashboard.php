<?php
session_start(); 

// Check if the user is logged in. If not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Prevent browser from caching the page.
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS - User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Content styles */
        .content-wrapper {
            margin-left: 250px; /* Matches the sidebar width */
            padding: 20px;
            min-height: 100vh;
            background-color: #f8f9fa;
            width: calc(100% - 250px); /* Adjusts width dynamically */
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .content-wrapper {
                margin-left: 200px; /* Adjust for smaller sidebar width */
                width: calc(100% - 200px);
            }
        }

        @media screen and (max-width: 576px) {
            .content-wrapper {
                margin-left: 0; /* Remove margin for mobile view */
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Include the sidebar -->
    <?php include 'user_sidebar.php'; ?>

    <!-- Main content -->
    <div class="content-wrapper">
        <h1>Welcome to the User Dashboard</h1>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Patient Records</h5>
                        <p class="card-text">100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Appointments</h5>
                        <p class="card-text">3 upcoming</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3>Recent Activities</h3>
            <ul class="list-group">
                <li class="list-group-item">Your check-up on 2024-12-10 has been completed</li>
                <li class="list-group-item">Your vaccination on 2024-12-09 is due for follow-up</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
