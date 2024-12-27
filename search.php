<?php
require 'config.php';

// Get the search query and department
$query = $_GET['query'] ?? ''; 
$department = $_GET['department'] ?? 'Information Technology'; // Default to Information Technology

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
    <style>
        .search-container {
            margin-top: 20px;
            margin-bottom: 30px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h1>Search Results</h1>

        <!-- Search Form -->
        <div class="search-container">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="query" class="form-control" placeholder="Search by name" value="<?php echo htmlspecialchars($query); ?>">
                    </div>
                    <div class="col-md-4">
                        <select name="department" class="form-control">
                            <option value="Information Technology" <?php if ($department == 'Information Technology') echo 'selected'; ?>>Information Technology</option>
                            <option value="Computer Science" <?php if ($department == 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                            <!-- Add other departments here -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Display Students -->
        <ul class="list-group">
            <?php if (empty($students)): ?>
                <li class="list-group-item">No students found.</li>
            <?php else: ?>
                <?php foreach ($students as $student): ?>
                    <li class="list-group-item">
                        <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?> - 
                        <strong><?php echo htmlspecialchars($student['department']); ?></strong>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
