<?php
require 'config.php';

$username = 'admin'; // Example username
$password = password_hash('admin123', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
?>
