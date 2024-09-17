<?php
require 'config.php';

// Get the student ID from the URL
$student_id = $_GET['student_id'] ?? 0;

// Fetch student and health records based on the student ID
$stmt = $conn->prepare("
    SELECT s.first_name, s.last_name, hr.record_type, hr.record_date, hr.id AS record_id
    FROM students s
    LEFT JOIN health_records hr ON s.id = hr.student_id
    WHERE s.id = :student_id
");
$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
$stmt->execute();
$student_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if records exist
if (empty($student_records)) {
    echo "No records found for this student.";
    exit;
}

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update a specific health record
    $record_id = $_POST['record_id'];
    $new_record_type = $_POST['record_type'];
    $new_record_date = $_POST['record_date'];

    $stmt = $conn->prepare("
        UPDATE health_records 
        SET record_type = :record_type, record_date = :record_date
        WHERE id = :record_id
    ");
    $stmt->bindParam(':record_type', $new_record_type);
    $stmt->bindParam(':record_date', $new_record_date);
    $stmt->bindParam(':record_id', $record_id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Record updated successfully!";
    // Reload the page to reflect the updated data
    header("Location: view_health_records.php?student_id=$student_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Records for <?php echo htmlspecialchars($student_records[0]['first_name'] . ' ' . $student_records[0]['last_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px; /* Adjust this if your sidebar width changes */
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .modal {
            margin-top: 100px;
        }
        .modal-dialog {
            max-width: 500px;
        }
        .modal-content {
            padding: 20px;
        }
        .modal-header {
            background-color: #f0f0f0;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-footer {
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main content for the specific student -->
    <div class="main-content">
        <div class="container mt-5">
            <h1>Health Records for <?php echo htmlspecialchars($student_records[0]['first_name'] . ' ' . $student_records[0]['last_name']); ?></h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Record Type</th>
                        <th>Record Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student_records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['record_type']); ?></td>
                            <td><?php echo htmlspecialchars($record['record_date']); ?></td>
                            <td>
                                <!-- Button to edit the health record -->
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $record['record_id']; ?>">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal to edit health record -->
                        <div class="modal fade" id="editModal<?php echo $record['record_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="view_health_records.php?student_id=<?php echo $student_id; ?>" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Health Record</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="record_type" class="form-label">Record Type</label>
                                                <input type="text" class="form-control" name="record_type" value="<?php echo htmlspecialchars($record['record_type']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="record_date" class="form-label">Record Date</label>
                                                <input type="date" class="form-control" name="record_date" value="<?php echo htmlspecialchars($record['record_date']); ?>">
                                            </div>
                                            <input type="hidden" name="record_id" value="<?php echo $record['record_id']; ?>">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
