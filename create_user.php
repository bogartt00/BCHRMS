<?php
require 'config.php';

// Define the username, password, and role
$username = 'nurse'; // New Nurse username
$password = password_hash('nurse123', PASSWORD_DEFAULT); // Securely hashed password
$role = 'Nurse'; // Role for the Nurse

// Prepare the SQL query to insert the user into the 'users' table
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");

// Bind the parameters
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':role', $role);

// Execute the statement
$stmt->execute();

echo "Nurse added successfully!";
?>
