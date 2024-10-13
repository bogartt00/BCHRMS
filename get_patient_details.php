<?php
$servername = "localhost"; // or your server name
$username = "root"; // replace with your username
$password = ""; // replace with your password
$dbname = "bchrms"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient details based on ID
if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT age, sex, course FROM students WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        echo json_encode($patient);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}

$conn->close();
?>
