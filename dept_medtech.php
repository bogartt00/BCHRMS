<?php
require 'config.php';

// Get the department and page number from the URL
$department = 'Medical Technology'; // Set dynamically based on the department page
$page = $_GET['page'] ?? 1; // Default to the first page
$records_per_page = 10; // Number of records per page
$offset = ($page - 1) * $records_per_page;
$query = $_GET['query'] ?? ''; // Get the search query if present

// Fetch students from the specific department with pagination (excluding soft-deleted ones)
$stmt = $conn->prepare("
    SELECT id, first_name, last_name 
    FROM students 
    WHERE department = :department
    AND deleted_at IS NULL -- Exclude soft-deleted students
    AND (first_name LIKE :query OR last_name LIKE :query)
    LIMIT :offset, :records_per_page
");
$stmt->bindParam(':department', $department);
$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of students for pagination (excluding soft-deleted ones)
$stmt = $conn->prepare("
    SELECT COUNT(*) as total 
    FROM students 
    WHERE department = :department
    AND deleted_at IS NULL -- Exclude soft-deleted students
    AND (first_name LIKE :query OR last_name LIKE :query)
");
$stmt->bindParam(':department', $department);
$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->execute();
$total_students = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_students / $records_per_page);

// Handle case where page number exceeds total pages
if ($page < 1) {
    $page = 1;
} elseif ($page > $total_pages && $total_pages > 0) {
    $page = $total_pages;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department of <?php echo htmlspecialchars($department); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="deptStyle.css"> <!-- Link to the external CSS -->
</head>
<body>

    <!-- Include the sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main content -->
    <div class="main-content">
        <div class="container mt-5">
            <h1>Students in <?php echo htmlspecialchars($department); ?></h1>

            <!-- Search Form -->
            <form method="get" action="" class="mb-3">
                <input type="text" class="form-control" name="query" value="<?php echo htmlspecialchars($query); ?>" placeholder="Search by name">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <div class="student-list mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($students) > 0): ?>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                                    <td>
                                        <!-- Button to view health records of the student -->
                                        <a href="view_health_records.php?student_id=<?php echo $student['id']; ?>" class="btn btn-primary">View Health Records</a>
                                        
                                        <!-- Button to soft-delete the student -->
                                        <form method="POST" action="soft_delete_student.php" style="display:inline;">
                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&query=<?php echo urlencode($query); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&query=<?php echo urlencode($query); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&query=<?php echo urlencode($query); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
