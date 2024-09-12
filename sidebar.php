<!-- sidebar.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(135deg, #00c851, #007e33);
        padding-top: 20px;
        color: white;
        overflow-y: auto;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 10px;
        width: 100%;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .sidebar a:hover {
        background-color: #495057;
    }

    .collapse-menu {
        padding-left: 20px;
    }
</style>

<div class="sidebar">
    <h2 class="text-center">BCHRMS</h2>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="index.php">
                <i class="fa-solid fa-house"></i> Home
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#departmentCollapse" role="button" aria-expanded="false"
                aria-controls="departmentCollapse">
                <i class="fa-solid fa-building"></i> Departments
            </a>
            <div class="collapse" id="departmentCollapse">
                <ul class="nav flex-column collapse-menu">
                    <li><a class="nav-link" href="dept_nursing.php">Nursing</a></li>
                    <li><a class="nav-link" href="dept_medtech.php">Medical Technology</a></li>
                    <li><a class="nav-link" href="dept_it.php">Information Technology</a></li>
                    <li><a class="nav-link" href="dept_pharmacy.php">Pharmacy</a></li>
                    <li><a class="nav-link" href="dept_hm.php">Hotel Management</a></li>
                    <li><a class="nav-link" href="dept_ba.php">Business Administration</a></li>
                </ul>
            </div>
        </li>

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
