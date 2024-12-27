<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bchrms"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $examination_type = $_POST['examination_type']; // New field
    $record_date = $_POST['record_date'];

    // Check if `student_id` is selected
    if (empty($student_id)) {
        echo "<div class='alert alert-danger'>Please select a patient.</div>";
    } else {
        // Insert data into the 'examinations' table
// Insert data into the 'examinations' table
$stmt = $conn->prepare("INSERT INTO examinations (student_id, examination_type, record_date, created_at) VALUES (?, ?, ?, NOW())");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("iss", $student_id, $examination_type, $record_date);

if ($stmt->execute()) {
    $examination_id = $stmt->insert_id; // Get the ID of the inserted record
    // Redirect based on the examination type
    switch ($examination_type) {
        case "Immunization History":
            header("Location: immunizationhistory.php?examination_id=$examination_id");
            break;
        case "Past Medical History":
            header("Location: pastmedhistoryform.php?examination_id=$examination_id");
            break;
        case "Psychosocial History":
            header("Location: psychosocialhistory.php?examination_id=$examination_id");
            break;
        default:
            echo "<div class='alert alert-warning'>Unknown examination type.</div>";
            break;
    }
    exit(); // Ensure no further code executes after the redirect
} else {
    echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($stmt->error) . "</div>";
}
$stmt->close();

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medical History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            background-color: #f5f8fa;
        }
        .container {
            max-width: 800px;
            max-height: 1500px;
            margin-right: 230px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-size: 16px;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'user_sidebar.php'; ?>
<div class="container">
    <h1>Add Medical History</h1>
    <form action="" method="post">
        <!-- Select Examination Type -->
        <div class="form-group">
            <label for="examination_type" class="form-label">Select Medical History Form</label>
            <select class="form-control" id="examination_type" name="examination_type" required>
                <option value="">Select Form</option>
                <option value="Immunization History">Immunization History</option>
                <option value="Past Medical History">Past Medical History</option>
                <option value="Psychosocial History">Psychosocial History</option>
            </select>
        </div>

        <!-- Select Patient -->
        <div class="form-group">
            <label for="student_id" class="form-label">Select Patient</label>
            <select class="form-control" id="student_id" name="student_id" required>
                <option value="">Select Patient</option>
                <?php
                // Fetch students for dropdown
                $sql = "SELECT id, last_name, first_name FROM students";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>" . htmlspecialchars($row['last_name'] . ', ' . $row['first_name']) . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Record Date -->
        <div class="form-group">
            <label for="record_date" class="form-label">Record Date</label>
            <input type="date" id="record_date" name="record_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Proceed to Form</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
