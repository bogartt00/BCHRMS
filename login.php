<?php
session_start();
require 'config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BCHRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(rgba(34, 193, 195, 0.7), rgba(34, 193, 195, 0.7)),
                    url('background1.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .login-card {
        background-color: #fff;
        padding: 50px; /* Adjusted padding */
        border-radius: 20px; /* More rounded corners */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2); /* Softer shadow */
        max-width: 400px; /* Increased width */
        width: 100%;
        animation: fadeIn 1.2s ease-in-out;
    }
    .login-card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .form-control:focus {
        border-color: #42a5f5;
        box-shadow: 0 0 10px rgba(66, 165, 245, 0.3);
    }
    .btn-primary {
        background: linear-gradient(90deg, #42a5f5 0%, #478ed1 100%);
        border: none;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(66, 165, 245, 0.3);
        padding: 10px 20px; /* More padding */
        margin-top: 10px; /* Space above button */
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #478ed1 0%, #42a5f5 100%);
    }
    .form-group label {
        font-weight: 600;
        color: #333;
    }
    .error {
        color: #ff3860;
    }
    h2 {
        font-weight: 600;
        color: #333;
    }
</style>
</head>
<body>
    <div class="login-card">
        <h2 class="text-center mb-4">BCHRMS</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button> <!-- Login Button -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
