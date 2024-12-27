<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bchrms"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve examination_id from URL
$examination_id = isset($_GET['examination_id']) ? $_GET['examination_id'] : null;

if ($examination_id) {
    // Fetch student_id based on examination_id
    $stmt = $conn->prepare("SELECT student_id FROM examinations WHERE id = ?");
    $stmt->bind_param("i", $examination_id);
    $stmt->execute();
    $stmt->bind_result($student_id);
    $stmt->fetch();
    $stmt->close();

    if (!$student_id) {
        echo "<div class='alert alert-danger'>No patient found for the selected examination.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>No examination selected.</div>";
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure examination_id is passed with the form
    $examination_id = $_POST['examination_id'];
    if (empty($examination_id)) {
        echo "<div class='alert alert-danger'>No examination selected.</div>";
        exit;
    }

    // Collect other form data
    $date_time = $_POST['date_time'];
    $cues = $_POST['cues'];
    $nursing_diagnosis = $_POST['nursing_diagnosis'];
    $medical_diagnosis = $_POST['medical_diagnosis'];
    $evaluation = $_POST['evaluation'];

    // Insert the check-up record into the database
    $stmt = $conn->prepare("INSERT INTO health_checkup (examination_id, date_time, cues, nursing_diagnosis, medical_diagnosis, evaluation) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("iissss", $examination_id, $date_time, $cues, $nursing_diagnosis, $medical_diagnosis, $evaluation);

    if ($stmt->execute()) {
        // Show success modal
        $success_message = "Check-up record added successfully!";
    } else {
        // Show error modal
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Up Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 900px;
            margin-right: 198px; /* Centers the container horizontally */
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section label {
            font-weight: bold;
            font-size: 16px;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: none;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-section input[type="datetime-local"] {
            padding: 7px 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-primary:focus {
            outline: none;
        }

        .form-section.text-center {
            text-align: center;
        }

        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-right: 30px;
        }

        .sidebar a {
            display: block;
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            margin: 10px 0;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #0056b3;
        }

        /* Grid layout adjustments */
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-md-4, .col-md-8 {
            padding: 15px;
        }

        .col-md-4 {
            flex: 1 1 0%; /* Sidebar should take about 30% of the space */
        }

        .col-md-8 {
            flex: 1 1 100%; /* Form should take about 60% of the space */
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Check-Up Record</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="sidebar">
                <?php include 'sidebar.php'; ?>
            </div>
        </div>

        <div class="col-md-8">
            <form action="" method="post">
                <!-- Hidden field to pass examination_id with the form submission -->
                <input type="hidden" name="examination_id" value="<?php echo $examination_id; ?>">

                <div class="form-section">
                    <label for="date_time">Date and Time</label>
                    <input type="datetime-local" class="form-control" id="date_time" name="date_time" required>
                </div>

                <div class="form-section">
                    <label for="cues">Cues</label>
                    <input type="text" class="form-control" id="cues" name="cues" required>
                </div>

                <div class="form-section">
                    <label for="nursing_diagnosis">Nursing Diagnosis</label>
                    <input type="text" class="form-control" id="nursing_diagnosis" name="nursing_diagnosis" required>
                </div>

                <div class="form-section">
                    <label for="medical_diagnosis">Medical Diagnosis</label>
                    <input type="text" class="form-control" id="medical_diagnosis" name="medical_diagnosis" required>
                </div>

                <div class="form-section">
                    <label for="evaluation">Evaluation</label>
                    <input type="text" class="form-control" id="evaluation" name="evaluation" required>
                </div>

                <div class="form-section text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<?php if (isset($success_message)) : ?>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $success_message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Error Modal -->
<?php if (isset($error_message)) : ?>
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $error_message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Show success modal if message is set
    <?php if (isset($success_message)) : ?>
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
    <?php endif; ?>

    // Show error modal if message is set
    <?php if (isset($error_message)) : ?>
    var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
    myModal.show();
    <?php endif; ?>
</script>

</body>
</html>
