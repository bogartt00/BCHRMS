<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>User added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding user.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensures full height of the page for centering */
        html, body {
            height: 100%; /* Ensure full height of the page */
            margin: 0; /* Remove default margin */
        }

        /* Flexbox for centering */
        .container {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Minimum height of viewport */
        }

        .form-box {
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%; /* Full width for smaller screens */
            max-width: 500px; /* Maximum width for larger screens */
        }
    </style>
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="form-box">
            <h2 class="text-center mb-4">Add New Admin</h2>

            <form method="POST" action="addUser.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Add User</button>
            </form>
        </div>
    </div>

</body>
</html>
