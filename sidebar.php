<head>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #014122, #046635); /* Updated Blue-Green Gradient */
            padding-top: 20px;
            color: white;
            overflow-y: auto;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.3); /* Pop-up shadow effect */
            border-radius: 0px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s;
            padding: 10px;
            width: 100%;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #3c9c35; /* Darker green for hover */
        }

        .collapse-menu {
            padding-left: 20px;
        }

        /* Sidebar logo styles */
        .sidebar .text-center img {
            width: 50px;
            height: 50px;
            margin-right: 10px; /* Margin between logo and text */
        }

        .sidebar .text-center h2 {
            font-size: 1.8em;
            margin: 0;
        }

        /* Dropdown styling */
        .nav-item a[data-bs-toggle="collapse"]:after {
            content: '\f0d7'; /* Font Awesome arrow-down icon */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            float: right;
        }

        .nav-item a[aria-expanded="true"]:after {
            content: '\f0d8'; /* Font Awesome arrow-up icon */
        }

        /* Form container styles */
        .form-container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            max-width: 700px;  /* Adjust to make the container smaller */
            margin: 20px auto;  /* Center the container */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for a modern look */
        }

        /* Optional: Ensure the content is not hidden behind the sidebar */
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<!-- Sidebar HTML (Always Visible) -->
<div class="sidebar">
    <div class="text-center" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
        <img src="BCHRMS_Logo1.png" alt="BCHRMS Logo">
        <h2>BCHRMS</h2>
    </div>
    <ul class="nav flex-column">
        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
                <i class="fa-solid fa-house"></i> Home
            </a>
        </li>

        <!-- Departments Dropdown -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#departmentCollapse" role="button" aria-expanded="false"
                aria-controls="departmentCollapse">
                <i class="fa-solid fa-building"></i> Departments
            </a>
            <div class="collapse" id="departmentCollapse">
                <ul class="nav flex-column collapse-menu">
                    <li><a class="nav-link" href="dept_nursing.php">Nursing</a></li>
                    <li>
                        <a class="nav-link" data-bs-toggle="collapse" href="#alliedHealthCollapse" role="button"
                            aria-expanded="false" aria-controls="alliedHealthCollapse">
                            Allied Health
                        </a>
                        <div class="collapse" id="alliedHealthCollapse">
                            <ul class="nav flex-column collapse-menu">
                                <li><a class="nav-link" href="dept_medtech.php">Medical Technology</a></li>
                                <li><a class="nav-link" href="dept_pharmacy.php">Pharmacy</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link" data-bs-toggle="collapse" href="#asbmCollapse" role="button" aria-expanded="false"
                            aria-controls="asbmCollapse">
                            ASBME
                        </a>
                        <div class="collapse" id="asbmCollapse">
                            <ul class="nav flex-column collapse-menu">
                                <li><a class="nav-link" href="dept_it.php">Information Technology</a></li>
                                <li><a class="nav-link" href="dept_ba.php">Business Administration</a></li>
                                <li><a class="nav-link" href="dept_education.php">Education</a></li>
                                <li><a class="nav-link" href="dept_psychology.php">Psychology</a></li>
                                <li><a class="nav-link" href="dept_theology.php">Theology</a></li>
                                <li><a class="nav-link" href="dept_hm.php">Hotel Management</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Patients (All Students) -->
        <li class="nav-item">
            <a class="nav-link active" href="all_students.php">
                <i class="fa-solid fa-users"></i> Patients
            </a>
        </li>

        <!-- Add Patients -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#addPatientsCollapse" role="button"
                aria-expanded="false" aria-controls="addPatientsCollapse">
                <i class="fa-solid fa-user-plus"></i> Add Patients
            </a>
            <div class="collapse" id="addPatientsCollapse">
                <ul class="nav flex-column collapse-menu">
                    <li><a class="nav-link" href="addStudent.php">Students</a></li>
                    <li><a class="nav-link" href="addEmployee.php">Employees</a></li>
                </ul>
            </div>
        </li>

        <!-- Add Health Records -->
        <li class="nav-item">
            <a class="nav-link" href="add_health_record.php">
                <i class="fa-solid fa-notes-medical"></i> Add Health Record
            </a>
        </li>

        <!-- Add Admin -->
        <li class="nav-item">
            <a class="nav-link" href="addUser.php">
                <i class="fa-brands fa-black-tie"></i> Add Admin
            </a>
        </li>

        <!-- Change Password -->
        <li class="nav-item">
            <a class="nav-link" href="changePassword.php">
                <i class="fa-solid fa-lock"></i> Change Password
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fa-solid fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</div>
