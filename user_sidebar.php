<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #014122, #046635);
            padding-top: 20px;
            color: white;
            overflow-y: auto;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3);
            transition: left 0.3s ease-in-out;
            z-index: 1000;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            transition: background-color 0.3s, color 0.3s;
            padding: 10px;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3c9c35;
        }

        .sidebar .text-center img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .sidebar .text-center h4 {
            font-size: 1.5rem;
            margin: 0;
        }

        /* Sidebar Toggle Button (for mobile screens) */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 200px;
                left: -200px;
            }

            .sidebar.open {
                left: 0;
            }
        }

        @media screen and (max-width: 576px) {
            .sidebar {
                width: 100%;
                left: -100%;
            }

            .sidebar.open {
                left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center" style="padding: 10px;">
            <img src="BCHRMS_Logo1.png" alt="Logo">
            <h4>User Dashboard</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="user_dashboard.php">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addStudent.php">
                    <i class="fa-solid fa-user-plus"></i> Add Patients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_medical_history.php">
                    <i class="fa-solid fa-notes-medical"></i> Add Medical History
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</body>

</html>
