<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];

    // Soft delete by setting the deleted_at field to the current timestamp
    $stmt = $conn->prepare("UPDATE students SET deleted_at = NOW() WHERE id = :student_id");
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the student list with a success message
        header("Location: dept_it.php?success=Student+soft+deleted");
        exit;
    } else {
        // Handle failure
        echo "Failed to soft delete the student.";
    }
}
