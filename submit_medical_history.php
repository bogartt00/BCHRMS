<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bchrms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$allergy = isset($_POST['allergy']) ? $_POST['allergy'] : '';
$asthma = isset($_POST['asthma']) ? $_POST['asthma'] : '';
$diabetes = isset($_POST['diabetes']) ? $_POST['diabetes'] : '';
$hypertension = isset($_POST['hypertension']) ? $_POST['hypertension'] : '';
$heartdisease = isset($_POST['heartdisease']) ? $_POST['heartdisease'] : '';

$allergy_remarks = isset($_POST['allergy-remarks']) ? $_POST['allergy-remarks'] : '';
$asthma_remarks = isset($_POST['asthma-remarks']) ? $_POST['asthma-remarks'] : '';
$diabetes_remarks = isset($_POST['diabetes-remarks']) ? $_POST['diabetes-remarks'] : '';
$hypertension_remarks = isset($_POST['hypertension-remarks']) ? $_POST['hypertension-remarks'] : '';
$heartdisease_remarks = isset($_POST['heartdisease-remarks']) ? $_POST['heartdisease-remarks'] : '';

// Additional Medical History
$chickenpox = isset($_POST['chickenpox']) ? $_POST['chickenpox'] : '';
$measles = isset($_POST['measles']) ? $_POST['measles'] : '';
$tuberculosis = isset($_POST['tuberculosis']) ? $_POST['tuberculosis'] : '';
$stroke = isset($_POST['stroke']) ? $_POST['stroke'] : '';

$chickenpox_remarks = isset($_POST['chickenpox-remarks']) ? $_POST['chickenpox-remarks'] : '';
$measles_remarks = isset($_POST['measles-remarks']) ? $_POST['measles-remarks'] : '';
$tuberculosis_remarks = isset($_POST['tuberculosis-remarks']) ? $_POST['tuberculosis-remarks'] : '';
$stroke_remarks = isset($_POST['stroke-remarks']) ? $_POST['stroke-remarks'] : '';

// OB/GYNE History (for females)
$fmens = isset($_POST['fmens']) ? $_POST['fmens'] : '';
$lmenperiod = isset($_POST['lmenperiod']) ? $_POST['lmenperiod'] : '';
$cycle = isset($_POST['cycle']) ? $_POST['cycle'] : '';
$irreg = isset($_POST['irreg']) ? $_POST['irreg'] : '';
$flow_min = isset($_POST['flow_min']) ? $_POST['flow_min'] : '';
$flow_mod = isset($_POST['flow_mod']) ? $_POST['flow_mod'] : '';
$flow_max = isset($_POST['flow_max']) ? $_POST['flow_max'] : '';
$gravid = isset($_POST['gravid']) ? $_POST['gravid'] : '';

// Prepare the SQL statement to insert into the database
$stmt = $conn->prepare("INSERT INTO medical_history (
    allergy, asthma, diabetes, hypertension, heartdisease,
    allergy_remarks, asthma_remarks, diabetes_remarks, hypertension_remarks, heartdisease_remarks,
    chickenpox, measles, tuberculosis, stroke,
    chickenpox_remarks, measles_remarks, tuberculosis_remarks, stroke_remarks,
    fmens, lmenperiod, cycle, irreg, flow_min, flow_mod, flow_max, gravid
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssssssssssssssssssss", 
    $allergy, $asthma, $diabetes, $hypertension, $heartdisease,
    $allergy_remarks, $asthma_remarks, $diabetes_remarks, $hypertension_remarks, $heartdisease_remarks,
    $chickenpox, $measles, $tuberculosis, $stroke,
    $chickenpox_remarks, $measles_remarks, $tuberculosis_remarks, $stroke_remarks,
    $fmens, $lmenperiod, $cycle, $irreg, $flow_min, $flow_mod, $flow_max, $gravid
);

// Execute the query and check for errors
if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
} else {
    echo "Medical history submitted successfully!";
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
