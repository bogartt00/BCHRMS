<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCHRMS Navbar</title>
    <style>
            /* Navbar Style */
            nav {
            background-color: #014122;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 250px; /* Sidebar space */
            width: calc(100% - 250px); /* Make the navbar take up the rest of the width */
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
        }
    </style>
</head>
<body>
    <!-- Navbar content -->
    <nav>
        <div class="navbar">
            <div class="logo">
               
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Patient Records</a></li>
                <li><a href="#">Appointments</a></li>
                <li><a href="#">Doctors</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>
