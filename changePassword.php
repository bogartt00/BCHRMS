<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Fetch the current hashed password from the database
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($current_password, $user['password'])) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':id', $_SESSION['user_id']);

            if ($stmt->execute()) {
                $success = "Password changed successfully!";
            } else {
                $error = "Error changing password.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Change Password</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" action="change_password.php">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-success">Change Password</button>
        </form>
    </div>
</body>
</html>
            