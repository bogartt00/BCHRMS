<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department of Pharmacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="your-sidebar-styles.css"> <!-- Link to your sidebar CSS -->
    <style>
        .main-content {
            margin-left: 250px; /* Adjust this if your sidebar width changes */
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main content for the Department of Pharmacy -->
    <div class="main-content">
        <div class="container mt-5">
            <h1>Department of Pharmacy</h1>
            <p>Health-related data for the Pharmacy Department:</p>

            <div class="row">
                <div class="col-md-6">
                    <h3>Medical Records Summary</h3>
                    <ul>
                        <li>Recent Check-Ups: 50 records</li>
                        <li>Physical Exams: 25 records</li>
                        <li>Dental Exams: 23 records</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>Viral Disease Cases</h3>
                    <ul>
                        <li>Flu: 3 cases</li>
                        <li>COVID-19: 2 cases</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
