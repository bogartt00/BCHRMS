<?php
require 'config.php';

// Get the page number and search query from the URL
$page = $_GET['page'] ?? 1; // Default to the first page
$records_per_page = 15; // Number of records per page
$offset = ($page - 1) * $records_per_page;
$query = $_GET['query'] ?? ''; // Get the search query if present
$search_by = $_GET['search_by'] ?? 'name'; // Get the selected search option (default to 'name')

// Fetch all students with pagination (excluding soft-deleted ones)
if ($search_by == 'name') {
    $stmt = $conn->prepare("SELECT id, first_name, last_name, department 
        FROM students 
        WHERE deleted_at IS NULL
        AND (first_name LIKE :query OR last_name LIKE :query)
        LIMIT :offset, :records_per_page");
} else {
    $stmt = $conn->prepare("SELECT id, first_name, last_name, department 
        FROM students 
        WHERE deleted_at IS NULL
        AND department LIKE :query
        LIMIT :offset, :records_per_page");
}

$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of students for pagination (excluding soft-deleted ones)
if ($search_by == 'name') {
    $stmt = $conn->prepare("SELECT COUNT(*) as total 
        FROM students 
        WHERE deleted_at IS NULL
        AND (first_name LIKE :query OR last_name LIKE :query)");
} else {
    $stmt = $conn->prepare("SELECT COUNT(*) as total 
        FROM students 
        WHERE deleted_at IS NULL
        AND department LIKE :query");
}

$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->execute();
$total_students = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_students / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            margin-left: 250px; /* Adjust based on sidebar width */
        }
        .main-content {
            margin: 20px auto;
            max-width: 1200px;
        }
        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Compact grid layout */
            gap: 15px; /* Space between cards */
            margin-top: 20px;
        }
        .student-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .student-name {
            font-size: 1rem;
            font-weight: 500;
            color:rgb(10, 149, 51);
            margin-bottom: 5px;
        }
        .student-department {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 10px;
        }
        .student-actions .btn {
            font-size: 0.75rem;
            margin: 3px;
            padding: 5px 10px;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px; /* Adjust this value if needed to avoid overlapping */
            background-color:rgb(10, 131, 60);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            font-size: 1.25rem;
            z-index: 1000; /* Ensure it stays on top of other elements */
        }
        .fab:hover {
            background-color:rgb(9, 110, 49);
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h1 class="text-center text-primary">All Students</h1>

        <!-- Search Form -->
        <div class="search-bar">
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="query" placeholder="Search by name or department" value="<?php echo htmlspecialchars($query); ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <select name="search_by" class="form-control">
                            <option value="name" <?php if ($search_by == 'name') echo 'selected'; ?>>Search by Name</option>
                            <option value="department" <?php if ($search_by == 'department') echo 'selected'; ?>>Search by Department</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Students List -->
        <div class="student-grid">
            <?php if (count($students) > 0): ?>
                <?php foreach ($students as $student): ?>
                    <div class="student-card">
                        <h5 class="student-name"><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h5>
                        <p class="student-department">Department: <?php echo htmlspecialchars($student['department']); ?></p>
                        <div class="student-actions">
                            <a href="view_health_records.php?student_id=<?php echo $student['id']; ?>" class="btn btn-primary">
                                <i class="fas fa-folder-open"></i> View
                            </a>
                            <form method="POST" action="soft_delete_student.php" style="display:inline;">
                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-muted">No students found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&query=<?php echo urlencode($query); ?>&search_by=<?php echo urlencode($search_by); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&query=<?php echo urlencode($query); ?>&search_by=<?php echo urlencode($search_by); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&query=<?php echo urlencode($query); ?>&search_by=<?php echo urlencode($search_by); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Floating Action Button -->
    <button class="fab" onclick="location.href='add_student.php'">
        <i class="fas fa-plus"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
