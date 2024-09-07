<?php
$host = 'localhost'; // Your database host
$dbname = 'bchrms'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
