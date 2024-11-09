<?php
require 'config.php';

$feedback = ""; // Variable to hold the feedback message

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Insert into the employee table (adjust column names as necessary)
    $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, age, gender, deleted_at) 
                            VALUES (:first_name, :last_name, :age, :gender, NULL)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);

    if ($stmt->execute()) {
        $feedback = "<div class='alert alert-success'>Employee added successfully!</div>";
    } else {
        $feedback = "<div class='alert alert-danger'>Error adding Employee.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px; /* Adjust margin to make space for the sidebar */
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-control:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .btn-success {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
        .btn-success:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <!-- Include sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="container mt-5">
            <h2>Add New Employee</h2>

            <!-- Display feedback message if available -->
            <?php echo $feedback; ?>

            <form method="POST" action="addEmployee.php">
                <div class="form-group">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Add Employee</button>
            </form>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
