<?php
// search.php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bchrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

// Prepare and execute the SQL query
$sql = "SELECT * FROM health_records WHERE student_name LIKE '%$query%' OR record_name LIKE '%$query%'";
$result = $conn->query($sql);

// Check if any results were returned
if ($result->num_rows > 0) {
    $records = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $records = [];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="your-sidebar-styles.css"> <!-- Link to your sidebar CSS -->
    <style>
        .main-content {
            margin-left: 250px; /* Should match the width of your sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container mt-4">
            <h1>Search Results</h1>
            <p>Results for: "<?php echo htmlspecialchars($query); ?>"</p>

            <?php if (count($records) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Record Name</th>
                            <th>Department</th>
                            <th>Check-Up Date</th>
                            <th>Physical Exam Date</th>
                            <th>Dental Exam Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($record['id']); ?></td>
                                <td><?php echo htmlspecialchars($record['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($record['record_name']); ?></td>
                                <td><?php echo htmlspecialchars($record['department']); ?></td>
                                <td><?php echo htmlspecialchars($record['check_up_date']); ?></td>
                                <td><?php echo htmlspecialchars($record['physical_exam_date']); ?></td>
                                <td><?php echo htmlspecialchars($record['dental_exam_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
