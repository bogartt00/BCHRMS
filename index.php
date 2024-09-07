<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BCHRMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="changePassword.php">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Brokenshire College Health Record Management System</h1>
        
        <!-- Medical Records Summary -->
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Recent Check-Ups</h5>
                        <p class="card-text">45 records</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Physical Exams</h5>
                        <p class="card-text">30 records</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Dental Exams</h5>
                        <p class="card-text">20 records</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts -->
        <div class="row">
            <div class="col-md-6">
                <h3>Viral Disease Cases by Department</h3>
                <canvas id="diseaseChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Recent Health Records</h3>
                <canvas id="recordsChart"></canvas>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="mt-4">
            <h3>Recent Activities</h3>
            <ul class="list-group">
                <li class="list-group-item">bogart had a physical exam on 2024-09-05</li>
                <li class="list-group-item">dodong had a dental exam on 2024-09-04</li>
            </ul>
        </div>
    </div>
    <script>
    var ctx = document.getElementById('diseaseChart').getContext('2d');
    var diseaseChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Department A', 'Department B', 'Department C'],
            datasets: [{
                label: 'Cases of Viral Diseases',
                data: [12, 19, 3],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
