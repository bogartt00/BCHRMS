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
        $stmt = $conn->prepare("INSERT INTO examinations (student_id, examination_type, record_date) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("iss", $student_id, $examination_type, $record_date);

        if ($stmt->execute()) {
            $examination_id = $stmt->insert_id; // Get the ID of the inserted record
            // Redirect based on the examination type
            switch ($examination_type) {
                case "Dental":
                    header("Location: dentalform.php?examination_id=$examination_id");
                    break;
                case "Laboratory":
                    header("Location: laboratoryform.php?examination_id=$examination_id");
                    break;
                case "Check-up":
                    header("Location: checkupform.php?examination_id=$examination_id");
                    break;
                case "Physical Examination":
                    header("Location: physicalform.php?examination_id=$examination_id");
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
    <title>Patient Examination Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;;
            margin: 0;
            padding: 15px;
            padding-left: 250px;
            background-color: #f5f8fa;
        }

         .navbar {
            padding-top: 2px; /* Adjust as needed */
            padding-bottom: 10px; /* Adjust as needed */
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }

        .container-wrapper {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .sidebar {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .main-content {
            flex-grow: 1;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h3 {
            font-size: 24px;
            font-weight: 600;
            color: #444;
            margin-bottom: 15px;
        }

        .form-label {
            font-size: 16px;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #4d90fe;
            box-shadow: 0 0 8px rgba(77, 144, 254, 0.2);
        }

        button {
            background-color: #4d90fe;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357ae8;
        }

        .alert {
            border-radius: 8px;
            font-size: 16px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #e0f7e9;
            color: #388e3c;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-container input {
            padding-right: 30px;
        }

        .search-container .search-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .search-container input:focus + .search-icon {
            color: #4d90fe;
        }

        .sidebar a {
            text-decoration: none;
            color: #444;
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #4d90fe;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Patient Examination Record</h1>

    <div class="container-wrapper">
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
            <?php include 'navbar.php'; ?>
        </div>

        <div class="main-content">
            <form action="" method="post">
                <!-- Select Examination Type -->
                <div class="form-section">
                    <h3>Select Examination Type</h3>
                    <div class="form-group">
                        <label for="examination_type" class="form-label">Examination Type</label>
                        <select class="form-control" id="examination_type" name="examination_type" required>
                            <option value="">Select Examination Type</option>
                            <option value="Dental">Dental</option>
                            <option value="Laboratory">Laboratory</option>
                            <option value="Check-up">Check-up</option>
                            <option value="Physical Examination">Physical Examination</option>
                        </select>
                    </div>
                </div>

                <!-- Select Patient -->
                <div class="form-section">
                    <h3>Select Patient</h3>
                    <label for="search_patient" class="form-label">Search Patient</label>
                    <div class="search-container">
                        <input type="text" id="search_patient" class="form-control" placeholder="Search by name..." onkeyup="searchPatient()">
                        <i class="search-icon fas fa-search"></i>
                    </div>
                    
                    <label for="student_id" class="form-label">Patient</label>
                    <select class="form-control" id="student_id" name="student_id" required>
                        <option value="">Select Patient</option>
                        <?php
                        // Fetch all students for dropdown
                        $sql = "SELECT id, last_name, first_name FROM students";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['last_name'] . ', ' . $row['first_name']) . "</option>";
                        }

                        $stmt->close();
                        ?>
                    </select>
                </div>

                <!-- Record Date -->
                <div class="form-section">
                    <h3>Record Date</h3>
                    <div class="form-group">
                        <label for="record_date" class="form-label">Record Date</label>
                        <input type="date" id="record_date" name="record_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Proceed to form</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    function searchPatient() {
        let input = document.getElementById('search_patient').value.toLowerCase();
        let select = document.getElementById('student_id');
        let options = select.options;

        for (let i = 0; i < options.length; i++) {
            let text = options[i].text.toLowerCase();
            options[i].style.display = text.includes(input) ? '' : 'none';
        }
    }
</script>

</body>
</html>
