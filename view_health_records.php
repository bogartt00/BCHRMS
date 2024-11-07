<?php
require 'config.php';

// Get the student ID 
$student_id = filter_var($_GET['student_id'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

// Debugging output
echo "Student ID: " . htmlspecialchars($student_id) . "<br>";

// Check if student ID is valid
if ($student_id <= 0) {
    echo "Invalid student ID.";
    exit;
}

// Fetch dental records for the student
$dental_stmt = $conn->prepare("SELECT * FROM dental_records WHERE student_id = :student_id");
$dental_stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$dental_stmt->execute();

// Fetch all records without any errors
$dental_records = $dental_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle update form submission for dental records
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        echo "Invalid CSRF token.";
        exit;
    }

    if (isset($_POST['dental_record_id'])) {
        $dental_record_id = $_POST['dental_record_id'];
        $dental_diagnosis = $_POST['dental_diagnosis'];
        $dental_treatment = $_POST['dental_treatment'];
        $dental_record_type = $_POST['dental_record_type'];
        $dental_record_date = $_POST['dental_record_date'];

        $update_stmt = $conn->prepare("UPDATE dental_records SET diagnosis = :diagnosis, treatment = :treatment, record_type = :record_type, record_date = :record_date WHERE id = :dental_record_id");
        $update_stmt->bindParam(':diagnosis', $dental_diagnosis);
        $update_stmt->bindParam(':treatment', $dental_treatment);
        $update_stmt->bindParam(':record_type', $dental_record_type);
        $update_stmt->bindParam(':record_date', $dental_record_date);
        $update_stmt->bindParam(':dental_record_id', $dental_record_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            $_SESSION['message'] = "Dental record updated successfully!";
        } else {
            $_SESSION['message'] = "Failed to update dental record.";
        }
    }

    header("Location: view_health_records.php?student_id=$student_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Records for Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background-color: #f8f9fa;
            padding: 20px;
            z-index: 1000;
        }
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <div class="main-content">
        <div class="container mt-5">
            <h1>Dental Records</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>

            <!-- Dental Records Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Record Type</th>
                        <th>Record Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dental_records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['record_type']); ?></td>
                            <td><?php echo htmlspecialchars($record['record_date']); ?></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $record['id']; ?>">Edit</button>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $record['id']; ?>">View</button>
                            </td>
                        </tr>

                        <!-- Edit Dental Record Modal -->
                        <div class="modal fade" id="editModal<?php echo $record['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="view_health_records.php?student_id=<?php echo $student_id; ?>" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Dental Record</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="dental_diagnosis" class="form-label">Diagnosis</label>
                                                <input type="text" class="form-control" name="dental_diagnosis" value="<?php echo htmlspecialchars($record['diagnosis']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dental_treatment" class="form-label">Treatment</label>
                                                <input type="text" class="form-control" name="dental_treatment" value="<?php echo htmlspecialchars($record['treatment']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dental_record_type" class="form-label">Record Type</label>
                                                <input type="text" class="form-control" name="dental_record_type" value="<?php echo htmlspecialchars($record['record_type']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dental_record_date" class="form-label">Record Date</label>
                                                <input type="date" class="form-control" name="dental_record_date" value="<?php echo htmlspecialchars($record['record_date']); ?>" required>
                                            </div>
                                            <input type="hidden" name="dental_record_id" value="<?php echo $record['id']; ?>">
                                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>"> <!-- CSRF Token -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- View Dental Record Modal -->
                        <div class="modal fade" id="viewModal<?php echo $record['id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Dental Record Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Diagnosis:</strong> <?php echo htmlspecialchars($record['diagnosis']); ?></p>
                                        <p><strong>Treatment:</strong> <?php echo htmlspecialchars($record['treatment']); ?></p>
                                        <p><strong>Record Type:</strong> <?php echo htmlspecialchars($record['record_type']); ?></p>
                                        <p><strong>Record Date:</strong> <?php echo htmlspecialchars($record['record_date']); ?></p>
                                        <p><strong>Teeth Chart:</strong> <?php echo htmlspecialchars($record['teeth_chart']); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
