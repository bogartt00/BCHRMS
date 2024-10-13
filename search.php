<?php
require 'config.php';

// Get the query and department from the URL
$query = $_GET['query'];
$department = 'Information Technology'; // Set this dynamically based on the department page

// Fetch students that match the query and belong to the specific department
$stmt = $conn->prepare("SELECT * FROM students WHERE department = :department AND (first_name LIKE :query OR last_name LIKE :query)");
$stmt->bindParam(':department', $department);
$stmt->bindParam(':query', $query, PDO::PARAM_STR);
$query = "%$query%"; // Add wildcards for partial matches
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Search Results</h1>

        <!-- Display Students -->
        <ul>
            <?php if (empty($students)): ?>
                <li>No students found.</li>
            <?php else: ?>
                <?php foreach ($students as $student): ?>
                    <li><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
