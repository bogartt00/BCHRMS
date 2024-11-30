<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Navbar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Add FontAwesome for icons -->
    <style>
        /* Navbar Style */
        nav {
            background-color: #014122;
            height: 70px;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 250px; /* Sidebar space */
            width: calc(100% - 250px); /* Adjust width to take the remaining space */
            z-index: 10; /* Ensure it stays on top of other content */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow to make the navbar appear elevated */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin: 0 15px;
            position: relative; /* To position the dropdown */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #d4d4d4;
        }

        .logo {
            font-size: 24px;
            color: white;
            font-weight: bold;
            margin-right: auto; /* Ensures the logo stays on the left side */
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #014122;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            top: 40px;
            right: 0;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            color: #014122;
        }

        .user-logo {
            font-size: 25px; /* Increase icon size */
            margin-right: 10px;
            vertical-align: middle;
        }

        /* Notification Bell */
        .notification-bell {
            font-size: 20px;
            color: white;
            cursor: pointer;
            position: relative;
        }

        .notification-bell i {
            font-size: 24px;
        }

        .notification-bell .badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            padding: 5px;
        }

        /* Prevent content from being covered by the navbar */
        body {
            margin-top: 80px; /* Adjust to match the height of the navbar */
        }
    </style>
</head>
<body>
    <!-- Navbar content -->
    <nav>
        <div class="navbar">
            <div class="logo">
                BCHRMS
            </div>
            <ul>
                <!-- Notification Bell -->
                <li>
                    <a href="#" class="notification-bell">
                        <i class="fas fa-bell"></i> <!-- FontAwesome bell icon -->
                        <span class="badge">5</span> <!-- Example notification count -->
                    </a>
                </li>

                <!-- User Dropdown -->
                <li class="dropdown">
                    <a href="#" class="user-link" id="user-logo">
                        <i class="fas fa-user user-logo"></i> <!-- FontAwesome user icon -->
                    </a>
                    <div class="dropdown-content" id="dropdown-menu">
                        <a href="addUser.php" id="add-user">Add User</a>
                        <a href="changePassword.php" id="change-password">Change Password</a>
                        <a href="logout.php" id="log-out">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- JavaScript for Dropdown -->
    <script>
        // Get elements
        const userLogo = document.getElementById('user-logo');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Toggle dropdown visibility on click
        userLogo.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });

        // Close dropdown if clicked outside
        window.addEventListener('click', function(event) {
            if (!userLogo.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none'; // Hide dropdown if clicked outside
            }
        });
    </script>
</body>
</html>
