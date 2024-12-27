<?php
require 'config.php';

// Get the student ID 
$student_id = filter_var($_GET['student_id'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

// Check if student ID is valid
if ($student_id <= 0) {
    echo "Invalid student ID.";
    exit;
}

// Fetch all examination records for the student from the examinations table
$stmt = $conn->prepare("SELECT * FROM examinations WHERE student_id = :student_id");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->execute();
$examination_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle update form submission for examination records
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        echo "Invalid CSRF token.";
        exit;
    }

    if (isset($_POST['record_id'])) {
        $record_id = $_POST['record_id'];
        $examination_type = $_POST['examination_type'];
        $record_date = $_POST['record_date'];

        // Update examination record in the database
        $update_stmt = $conn->prepare("UPDATE examinations SET examination_type = :examination_type, record_date = :record_date WHERE id = :record_id");
        $update_stmt->bindParam(':examination_type', $examination_type);
        $update_stmt->bindParam(':record_date', $record_date);
        $update_stmt->bindParam(':record_id', $record_id, PDO::PARAM_INT);

        if ($update_stmt->execute()) {
            $_SESSION['message'] = "Examination record updated successfully!";
        } else {
            $_SESSION['message'] = "Failed to update examination record.";
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
    <title>Examination Records for Student</title>
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
            <h1>Examination Records</h1>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>

            <!-- Examination Records Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Examination Type</th>
                        <th>Record Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($examination_records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['examination_type']); ?></td>
                            <td><?php echo htmlspecialchars($record['record_date']); ?></td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $record['id']; ?>">Edit</button>
                                <!-- View button now redirects to a new page to show read-only data -->
                                <a href="view_dental_form.php?student_id=<?php echo $student_id; ?>&examination_id=<?php echo $record['id']; ?>" class="btn btn-info">View</a>
                            </td>
                        </tr>

                        <!-- Edit Examination Record Modal -->
                        <div class="modal fade" id="editModal<?php echo $record['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="view_health_records.php?student_id=<?php echo $student_id; ?>" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Examination Record</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="examination_type" class="form-label">Examination Type</label>
                                                <input type="text" class="form-control" name="examination_type" value="<?php echo htmlspecialchars($record['examination_type']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="record_date" class="form-label">Record Date</label>
                                                <input type="date" class="form-control" name="record_date" value="<?php echo htmlspecialchars($record['record_date']); ?>" required>
                                            </div>
                                            <input type="hidden" name="record_id" value="<?php echo $record['id']; ?>">
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
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
