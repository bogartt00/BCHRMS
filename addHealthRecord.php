<?php
require 'config.php';

// Handle form submission for health records
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_first_name = $_POST['student_first_name'];
    $student_last_name = $_POST['student_last_name'];
    $record_type = $_POST['record_type'];
    $record_date = $_POST['record_date'];

    // Find student_id by first_name and last_name
    $stmt = $conn->prepare("SELECT id, department, age, gender FROM students WHERE first_name = :first_name AND last_name = :last_name");
    $stmt->bindParam(':first_name', $student_first_name);
    $stmt->bindParam(':last_name', $student_last_name);
    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        $student_id = $student['id'];
        $student_department = $student['department'];
        $student_age = $student['age'];
        $student_gender = $student['gender'];

        // Insert into health_records
        $stmt = $conn->prepare("INSERT INTO health_records (student_id, record_type, record_date) VALUES (:student_id, :record_type, :record_date)");
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':record_type', $record_type);
        $stmt->bindParam(':record_date', $record_date);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Health record added successfully!</div>";
        } else {
            $errorInfo = $stmt->errorInfo();
            $message = "<div class='alert alert-danger'>Error adding health record: " . htmlspecialchars($errorInfo[2]) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Student not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Health Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
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
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="container mt-5">
            <h1>Add Health Record</h1>

            <?php if (isset($message)) echo $message; ?>

            <form id="healthRecordForm" action="addHealthRecord.php" method="post">
                <div class="form-group">
                    <label for="student_first_name" class="form-label">Student First Name</label>
                    <input type="text" class="form-control" id="student_first_name" name="student_first_name" required>
                </div>
                <div class="form-group">
                    <label for="student_last_name" class="form-label">Student Last Name</label>
                    <input type="text" class="form-control" id="student_last_name" name="student_last_name" required>
                </div>
                <div class="form-group">
                    <label for="record_type" class="form-label">Record Type</label>
                    <select class="form-control" id="record_type" name="record_type" required>
                        <option value="">Select Record Type</option>
                        <option value="Medical">Medical</option>
                        <option value="Dental">Dental</option>
                        <option value="Optical">Optical</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="record_date" class="form-label">Record Date</label>
                    <input type="date" class="form-control" id="record_date" name="record_date" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Record</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
