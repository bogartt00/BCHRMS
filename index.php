<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;  
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .dropdown-menu {
            background-color: #343a40;
            border: none; /* Removes the border */
            width:100%; /* Makes the dropdown width match the sidebar width */
            padding: 0; /* Removes extra padding to fit within the sidebar */
        }
        .dropdown-item {
            color: white;
            padding-left: 40px; /* Indents the text for better alignment */
        }
        .dropdown-item:hover {
            background-color: #495057;
        }

        .collapse.show {
            display: block !important;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center">BCHRMS</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>

            <!-- Dropdown for Department List -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#deptDropdown" role="button" aria-expanded="false" aria-controls="deptDropdown">
                    <i class="fa-solid fa-building"></i> Departments
                </a>
                <ul class="collapse" id="deptDropdown">
                    <li><a class="dropdown-item" href="dept_nursing.php">Nursing</a></li>
                    <li><a class="dropdown-item" href="dept_medtech.php">Medical Technology</a></li>
                    <li><a class="dropdown-item" href="dept_it.php">Information Technology</a></li>
                    <li><a class="dropdown-item" href="dept_pharmacy.php">Pharmacy</a></li>
                    <li><a class="dropdown-item" href="dept_hrm.php">Hotel & Restaurant Management</a></li>
                    <li><a class="dropdown-item" href="dept_ba.php">Business Administration</a></li>
                </ul>
            </li>

            <!-- Dropdown for Adding Patients -->
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#patientsDropdown" role="button" aria-expanded="false" aria-controls="patientsDropdown">
                    <i class="fa-solid fa-user-plus"></i> Add Patients
                </a>
                <ul class="collapse" id="patientsDropdown">
                    <li><a class="dropdown-item" href="addStudent.php">Students</a></li>
                    <li><a class="dropdown-item" href="addEmployee.php">Employees</a></li>
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="addUser.php">
                    <i class="fa-brands fa-black-tie"></i> Add admin
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="changePassword.php">
                    <i class="fa-solid fa-lock"></i> Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Brokenshire College Health Record Management System</h1>
        
        <!-- Medical Records Summary -->
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Recent Check-Ups</h5>
                        <p class="card-text">45 records</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Physical Exams</h5>
                        <p class="card-text">30 records</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Dental Exams</h5>
                        <p class="card-text">20 records</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts -->
        <div class="row">
            <div class="col-md-6">
                <h3>Viral Disease Cases by Department</h3>
                <canvas id="diseaseChart"></canvas>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="mt-4">
            <h3>Recent Activities</h3>
            <ul class="list-group">
                <li class="list-group-item">bogart had a physical exam on 2024-09-05</li>
                <li class="list-group-item">dodong had a dental exam on 2024-09-04</li>
            </ul>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctxDisease = document.getElementById('diseaseChart').getContext('2d');
        new Chart(ctxDisease, {
            type: 'bar',
            data: {
                labels: ['Department A', 'Department B', 'Department C'],
                datasets: [{
                    label: 'Cases of Viral Diseases',
                    data: [12, 19, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });   
    });
    </script>
</body>
</html>
