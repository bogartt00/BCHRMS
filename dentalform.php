<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Patient Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .dental-chart table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .dental-chart th, .dental-chart td {
            text-align: center;
            padding: 5px;
            border: 1px solid #000;
        }
        .dental-chart input {
            width: 100%; /* Make input fill the cell */
            border: none;
            text-align: center;
            padding: 5px;
        }
        .dental-chart input:hover {
            background-color: #f0f0f0; /* Highlight input on hover */
        }
        .container-wrapper {
            display: flex;
            flex-wrap: nowrap;
        }
        .sidebar {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            padding: 20px;
            width: 250px;
            flex-shrink: 0;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }
        .main-content {
            padding: 20px;
            flex-grow: 1;
            margin-left: 270px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center">Dental Patient Record</h1>

    <div class="container-wrapper">
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>

        <div class="main-content">
            <?php
            // Enable error reporting for debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Database connection
            $servername = "localhost"; // or your server name
            $username = "root"; // replace with your username
            $password = ""; // replace with your password
            $dbname = "bchrms"; // replace with your database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve examination_id from URL
            $examination_id = isset($_GET['examination_id']) ? $_GET['examination_id'] : null;

            if ($examination_id) {
                // Fetch student_id based on examination_id
                $stmt = $conn->prepare("SELECT student_id FROM examinations WHERE id = ?");
                $stmt->bind_param("i", $examination_id);
                $stmt->execute();
                $stmt->bind_result($student_id);
                $stmt->fetch();
                $stmt->close();

                // If no student_id found, show error
                if (!$student_id) {
                    echo "<div class='alert alert-danger'>No patient found for the selected examination.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No examination selected.</div>";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $diagnosis = $_POST['diagnosis'];
                $treatment = $_POST['treatment'];
                $record_date = $_POST['record_date']; // Get record date
            
                // If record_date is empty, set it to the current date
                if (empty($record_date)) {
                    $record_date = date('Y-m-d'); // Set current date if empty
                }
            
                // Check if patient selection is valid
                if (empty($student_id)) {
                    echo "<div class='alert alert-danger'>Please select a patient.</div>";
                } else {
                    $teeth_chart = isset($_POST['teeth']) ? $_POST['teeth'] : array();
                    $teeth_chart_json = json_encode($teeth_chart);
            
                    // Prepare SQL for inserting dental record
                    $stmt = $conn->prepare("INSERT INTO dental_examinations (examination_id, diagnosis, treatment, teeth_chart, created_at) VALUES (?, ?, ?, ?, ?)");
            
                    // Bind the parameters (5 parameters in total)
                    $stmt->bind_param("issss", $examination_id, $diagnosis, $treatment, $teeth_chart_json, $record_date);
            
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record added successfully</div>";
                    } else {
                        echo "<div class='alert alert-danger'>An error occurred while adding the record: " . $stmt->error . "</div>";
                    }
            
                    $stmt->close();
                }
            }
            
            
            ?>

            <form action="" method="post">
                <!-- Select Patient (Display patient name from examination_id) -->

                <!-- Dental Chart -->
                <div class="form-section dental-chart">
                    <h3>Dental Chart</h3>
                    <!-- Upper Teeth -->
                    <h5>Upper Teeth</h5>
                    <table>
                        <thead>
                            <tr>
                                <th>Right</th>
                                <th>18</th><th>17</th><th>16</th><th>15</th><th>14</th><th>13</th><th>12</th><th>11</th>
                                <th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Left</td>
                                <td><input type="text" id="18" name="teeth[18]"></td>
                                <td><input type="text" id="17" name="teeth[17]"></td>
                                <td><input type="text" id="16" name="teeth[16]"></td>
                                <td><input type="text" id="15" name="teeth[15]"></td>
                                <td><input type="text" id="14" name="teeth[14]"></td>
                                <td><input type="text" id="13" name="teeth[13]"></td>
                                <td><input type="text" id="12" name="teeth[12]"></td>
                                <td><input type="text" id="11" name="teeth[11]"></td>
                                <td><input type="text" id="21" name="teeth[21]"></td>
                                <td><input type="text" id="22" name="teeth[22]"></td>
                                <td><input type="text" id="23" name="teeth[23]"></td>
                                <td><input type="text" id="24" name="teeth[24]"></td>
                                <td><input type="text" id="25" name="teeth[25]"></td>
                                <td><input type="text" id="26" name="teeth[26]"></td>
                                <td><input type="text" id="27" name="teeth[27]"></td>
                                <td><input type="text" id="28" name="teeth[28]"></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Lower Teeth -->
                    <h5>Lower Teeth</h5>
                    <table>
                        <thead>
                            <tr>
                                <th>Right</th>
                                <th>48</th><th>47</th><th>46</th><th>45</th><th>44</th><th>43</th><th>42</th><th>41</th>
                                <th>31</th><th>32</th><th>33</th><th>34</th><th>35</th><th>36</th><th>37</th><th>38</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Left</td>
                                <td><input type="text" id="48" name="teeth[48]"></td>
                                <td><input type="text" id="47" name="teeth[47]"></td>
                                <td><input type="text" id="46" name="teeth[46]"></td>
                                <td><input type="text" id="45" name="teeth[45]"></td>
                                <td><input type="text" id="44" name="teeth[44]"></td>
                                <td><input type="text" id="43" name="teeth[43]"></td>
                                <td><input type="text" id="42" name="teeth[42]"></td>
                                <td><input type="text" id="41" name="teeth[41]"></td>
                                <td><input type="text" id="31" name="teeth[31]"></td>
                                <td><input type="text" id="32" name="teeth[32]"></td>
                                <td><input type="text" id="33" name="teeth[33]"></td>
                                <td><input type="text" id="34" name="teeth[34]"></td>
                                <td><input type="text" id="35" name="teeth[35]"></td>
                                <td><input type="text" id="36" name="teeth[36]"></td>
                                <td><input type="text" id="37" name="teeth[37]"></td>
                                <td><input type="text" id="38" name="teeth[38]"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Additional Information -->
                <div class="form-section">
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" class="form-control" id="diagnosis" name="diagnosis">
                </div>

                <div class="form-section">
                    <label for="treatment">Treatment</label>
                    <input type="text" class="form-control" id="treatment" name="treatment">
                </div>

                <div class="form-section">
                    <label for="record_date">Record Date</label>
                    <input type="date" class="form-control" id="record_date" name="record_date">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
