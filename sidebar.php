<style>
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(135deg, #46b046, #268c26);
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
        background-color: #3c9c35;
    }

    .collapse-menu {
        padding-left: 20px;
    }
</style>

<div class="sidebar">
    <div class="text-center" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
        <img src="BCHRMS_Logo1.png" alt="BCHRMS Logo" style="width: 50px; height: 50px;">
        <h2 style="font-size: 1.8em; margin: 0;">BCHRMS</h2>
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
            <a class="nav-link" href="all_students.php">
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

        <!-- Add Health Records Dropdown -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#examinationCollapse" role="button"
                aria-expanded="false" aria-controls="examinationCollapse">
                <i class="fa-solid fa-notes-medical"></i> Add Health Records
            </a>
            <div class="collapse" id="examinationCollapse">
                <ul class="nav flex-column collapse-menu">
                    <li><a class="nav-link" href="medicalForm.php">Medical Examination</a></li>
                    <li><a class="nav-link" href="dentalForm.php">Dental Examination</a></li>
                    <li><a class="nav-link" href="opticalForm.php">Optical Examination</a></li>
                </ul>
            </div>
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
