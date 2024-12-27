<?php
session_start();
require 'config.php';

if (isset($_SESSION['user_id'])) {
    // Redirect based on role if already logged in
    switch ($_SESSION['role']) {
        case 'Doctor':
            header('Location: index.php');
            break;
        case 'Dentist':
            header('Location: dentist_dashboard.php');
            break;
        case 'Nurse':
            header('Location: nurse_dashboard.php');
            break;
        case 'User':
            header('Location: user_dashboard.php');
    }
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare statement to fetch user details based on username
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    // Verify password and role
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // store user's role

        // Redirect based on role
        switch ($user['role']) {
            case 'Doctor':
                header('Location: index.php');
                break;
            case 'Dentist':
                header('Location: dentist_dashboard.php');
                break;
            case 'Nurse':
                header('Location: nurse_dashboard.php');
                break;
            default:
                header('Location: user_dashboard.php');
        }
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .gradient-custom-2 {
            background: linear-gradient(rgba(40, 167, 69, 0.8), rgba(23, 162, 184, 0.8)),
                        url('background1.jpg') center/cover no-repeat;
            color: #fff;
        }
        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        .form-control {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            background: #17a2b8;
            color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        }
        .btn-custom:hover {
            background: #28a745;
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.5);
        }
    </style>
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="BCHRMS_Logo.png" style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Welcome to BCHRMS</h4>
                </div>
                <form action="" method="POST">
                  <?php if ($error): ?>
                      <p class="text-danger"><?php echo $error; ?></p>
                  <?php endif; ?>
                  <div class="form-outline mb-4">
                    <input type="text" name="username" id="form2Example11" class="form-control" placeholder="Enter your username" required />
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Enter your password" required />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-custom btn-block mb-3" type="submit">Log in</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Welcome to Brokenshire Health Record Management System (BCHRMS)</h4>
                <p class="small mb-0">This is a secure portal for accessing and managing student health records. Our system simplifies
                    health record maintenance, providing a centralized, streamlined solution for clinic staff to quickly view, update,
                and analyze vital health data. Through BCHRMS, we aim to support the health and well-being of our college
                community with efficiency, accuracy, and enhanced data security.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
