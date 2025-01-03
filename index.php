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

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bchrms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get viral disease cases by department
$sql = "SELECT s.department AS department, COUNT(*) AS case_count
        FROM students s
        WHERE EXISTS (
            SELECT 1 FROM health_checkup hc 
            WHERE hc.student_id = s.id 
            AND hc.evaluation = 'viral disease'
        )
        GROUP BY s.department";
        
$result = $conn->query($sql);

// Prepare data for the chart
$departments = [];
$caseCounts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row['department'];
        $caseCounts[] = $row['case_count'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Dashboard</title>
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

        .collapse-menu {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>Brokenshire College Health Record Management System</h1>

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

        <div class="row">
            <div class="col-md-6">
                <h3>Viral Disease Cases by Department</h3>
                <canvas id="diseaseChart"></canvas>
            </div>
        </div>

        <div class="mt-4">
            <h3>Recent Activities</h3>
            <ul class="list-group">
                <li class="list-group-item">Bogart had a physical exam on 2024-09-05</li>
                <li class="list-group-item">Dodong had a dental exam on 2024-09-04</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('diseaseChart').getContext('2d');
        const diseaseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($departments); ?>,
                datasets: [{
                    label: 'Cases',
                    data: <?php echo json_encode($caseCounts); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
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
</body>
</html>
