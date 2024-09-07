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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(rgba(34, 193, 195, 0.5), rgba(34, 193, 195, 0.5)),
                    url('background1.jpg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .login-card {
        background-color: white;
        padding: 40px; /* Increased padding */
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1.2s ease-in-out;
        max-width: 400px; /* Adjusted width */
        width: 100%; /* Full width within max-width */
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
        box-shadow: 0 0 10px rgba(33, 150, 243, 0.5);
    }
    .btn-primary {
        background: #42a5f5;
        border: none;
    }
    .btn-primary:hover {
        background: #478ed1;
    }
    .form-group label {
        font-weight: bold;
    }
    .error {
        color: #ff3860;
    }
</style>

</head>
<body>
    <div class="login-card">
        <h2 class="text-center mb-4">Login</h2>
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
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>

