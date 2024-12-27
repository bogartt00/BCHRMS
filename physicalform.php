<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bchrms";  // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recordInserted = false;
$errorMessage = '';

// Handle form submission (Insert new record)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $blood_pressure = $_POST['blood_pressure'];
    $pulse_rate = $_POST['pulse_rate'];
    $temperature = $_POST['temperature'];
    $skin = $_POST['skin'];
    $head = $_POST['head'];
    $eyes_visual_acuity = $_POST['eyes_visual_acuity'];
    $ears_hearing_test = $_POST['ears_hearing_test'];
    $nose = $_POST['nose'];
    $throat = $_POST['throat'];
    $mouth_tongue = $_POST['mouth_tongue'];
    $teeth_gums = $_POST['teeth_gums'];
    $neck = $_POST['neck'];
    $chest_lungs = $_POST['chest_lungs'];
    $breasts = $_POST['breasts'];
    $heart = $_POST['heart'];
    $abdomen = $_POST['abdomen'];
    $testicular_exam = $_POST['testicular_exam'];
    $rectal_exam = $_POST['rectal_exam'];
    $extremities = $_POST['extremities'];

    // Prepare the insert SQL query
    $stmt = $conn->prepare("
        INSERT INTO physical_examinations 
        (weight, height, blood_pressure, pulse_rate, temperature, skin, head, 
        eyes_visual_acuity, ears_hearing_test, nose, throat, mouth_tongue, 
        teeth_gums, neck, chest_lungs, breasts, heart, abdomen, testicular_exam, 
        rectal_exam, extremities)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    // Bind parameters with correct data types
    $stmt->bind_param("sssssssssssssssssssss", 
        $weight, $height, $blood_pressure, $pulse_rate, $temperature, 
        $skin, $head, $eyes_visual_acuity, $ears_hearing_test, $nose, 
        $throat, $mouth_tongue, $teeth_gums, $neck, $chest_lungs, 
        $breasts, $heart, $abdomen, $testicular_exam, $rectal_exam, 
        $extremities
    );

    // Execute the query
    if ($stmt->execute()) {
        $recordInserted = true;
    } else {
        $errorMessage = "Error inserting record: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Physical Examination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
        }
        .container {
            max-width: 900px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-right: 170px;
        }
        h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: 500;
            color: #333;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: none;
            font-size: 1rem;
            padding: 0.8rem;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            margin-top: 20px;
        }
        .mb-3 {
            margin-bottom: 1.5rem;
        }
        .row {
            margin-bottom: 1.5rem;
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group-text {
            background-color: #f1f1f1;
        }
        .col-md-6 {
            padding-right: 15px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Physical Examination Form</h2>

    <?php if ($recordInserted): ?>
        <div class="alert alert-success">Record inserted successfully!</div>
    <?php elseif ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" required placeholder="Enter weight">
            </div>
            <div class="col-md-6 mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="number" class="form-control" id="height" name="height" required placeholder="Enter height">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="blood_pressure" class="form-label">Blood Pressure</label>
                <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" required placeholder="Enter blood pressure">
            </div>
            <div class="col-md-6 mb-3">
                <label for="pulse_rate" class="form-label">Pulse Rate</label>
                <input type="number" class="form-control" id="pulse_rate" name="pulse_rate" required placeholder="Enter pulse rate">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="temperature" class="form-label">Temperature</label>
                <input type="number" step="0.1" class="form-control" id="temperature" name="temperature" required placeholder="Enter temperature">
            </div>
            <div class="col-md-6 mb-3">
                <label for="skin" class="form-label">Skin</label>
                <input type="text" class="form-control" id="skin" name="skin" required placeholder="Skin condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="head" class="form-label">Head</label>
                <input type="text" class="form-control" id="head" name="head" required placeholder="Head condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="eyes_visual_acuity" class="form-label">Eyes (Visual Acuity)</label>
                <input type="text" class="form-control" id="eyes_visual_acuity" name="eyes_visual_acuity" required placeholder="Visual Acuity">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ears_hearing_test" class="form-label">Ears (Hearing Test)</label>
                <input type="text" class="form-control" id="ears_hearing_test" name="ears_hearing_test" required placeholder="Hearing Test">
            </div>
            <div class="col-md-6 mb-3">
                <label for="nose" class="form-label">Nose</label>
                <input type="text" class="form-control" id="nose" name="nose" required placeholder="Nose condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="throat" class="form-label">Throat</label>
                <input type="text" class="form-control" id="throat" name="throat" required placeholder="Throat condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="mouth_tongue" class="form-label">Mouth & Tongue</label>
                <input type="text" class="form-control" id="mouth_tongue" name="mouth_tongue" required placeholder="Mouth & Tongue condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="teeth_gums" class="form-label">Teeth & Gums</label>
                <input type="text" class="form-control" id="teeth_gums" name="teeth_gums" required placeholder="Teeth & Gums condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="neck" class="form-label">Neck</label>
                <input type="text" class="form-control" id="neck" name="neck" required placeholder="Neck condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="chest_lungs" class="form-label">Chest & Lungs</label>
                <input type="text" class="form-control" id="chest_lungs" name="chest_lungs" required placeholder="Chest & Lungs condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="breasts" class="form-label">Breasts</label>
                <input type="text" class="form-control" id="breasts" name="breasts" required placeholder="Breasts condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="heart" class="form-label">Heart</label>
                <input type="text" class="form-control" id="heart" name="heart" required placeholder="Heart condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="abdomen" class="form-label">Abdomen</label>
                <input type="text" class="form-control" id="abdomen" name="abdomen" required placeholder="Abdomen condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="testicular_exam" class="form-label">Testicular Exam</label>
                <input type="text" class="form-control" id="testicular_exam" name="testicular_exam" required placeholder="Testicular Exam condition">
            </div>
            <div class="col-md-6 mb-3">
                <label for="rectal_exam" class="form-label">Rectal Exam</label>
                <input type="text" class="form-control" id="rectal_exam" name="rectal_exam" required placeholder="Rectal Exam condition">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="extremities" class="form-label">Extremities</label>
                <input type="text" class="form-control" id="extremities" name="extremities" required placeholder="Extremities condition">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

</body>
</html>
