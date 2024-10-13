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

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $student_id = $_POST['student_id'];
                $diagnosis = $_POST['diagnosis'];
                $treatment = $_POST['treatment'];
                $record_type = $_POST['record_type']; // Get record type
                $record_date = $_POST['record_date']; // Get record date

                // Check if student_id is set and not empty
                if (empty($student_id)) {
                    echo "<div class='alert alert-danger'>Please select a patient.</div>";
                } else {
                    $teeth_chart = isset($_POST['teeth']) ? $_POST['teeth'] : array();
                    $teeth_chart_json = json_encode($teeth_chart);

                    // Prepare the SQL statement
                    $stmt = $conn->prepare("INSERT INTO dental_records (student_id, diagnosis, treatment, record_type, record_date, teeth_chart) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issssi", $student_id, $diagnosis, $treatment, $record_type, $record_date, $teeth_chart_json);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record added successfully</div>";
                    } else {
                        error_log("Error: " . $stmt->error);
                        echo "<div class='alert alert-danger'>An error occurred while adding the record.</div>";
                    }

                    $stmt->close();
                }
            }
            ?>

            <form action="" method="post">
    <!-- Select Patient -->
<div class="form-section">
    <h3>Select Patient</h3>
    <label for="search_patient" class="form-label">Search Patient</label>
    <input type="text" id="search_patient" class="form-control" placeholder="Search by name..." onkeyup="searchPatient()">
    
    <label for="student_id" class="form-label">Patient</label>
    <select class="form-control" id="student_id" name="student_id" required>
        <option value="">Select Patient</option>
        <?php
        // Fetch all students initially for dropdown
        $sql = "SELECT id, last_name, first_name FROM students";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Store students in an array
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['last_name'] . ', ' . $row['first_name']) . "</option>";
        }

        $stmt->close();
        ?>
    </select>
</div>

<script>
const students = <?php echo json_encode($students); ?>; // Pass PHP array to JavaScript

function searchPatient() {
    const input = document.getElementById('search_patient');
    const filter = input.value.toLowerCase();
    const select = document.getElementById('student_id');

    // Clear current options except for the first
    select.innerHTML = '<option value="">Select Patient</option>';

    // Filter and display matching options
    students.forEach(student => {
        const fullName = student.last_name + ', ' + student.first_name;
        if (fullName.toLowerCase().includes(filter)) {
            const option = document.createElement('option');
            option.value = student.id;
            option.textContent = fullName;
            select.appendChild(option);
        }
    });

    // If no matches, show "No patients found"
    if (select.options.length === 1) {
        const option = document.createElement('option');
        option.value = '';
        option.textContent = 'No patients found';
        select.appendChild(option);
    }
}
</script>




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
                                                <!-- Legends Section -->
                                                <div class="form-section">
    <h5>Legends</h5>
    <div>
        <strong>Present Tooth:</strong>
        <ul>
            <li>P = Present Tooth in good condition</li>
            <li>M = Missing Tooth</li>
            <li>IC = Incipient/Initial Caries</li>
            <li>C = Tooth Caries for Filling</li>
            <li>RC = Recurrent Caries</li>
            <li>F = Fracture</li>
            <li>X = Tooth Indicated for Extraction</li>
            <li>RF = Root Fragment</li>
            <li>Un = Unerupted Tooth</li>
            <li>Impact = Impacted Tooth</li>
        </ul>
    </div>
    <div>
        <strong>Treated Tooth:</strong>
        <ul>
            <li>Comp = Composite</li>
            <li>LC = Light Curing</li>
            <li>Sit = Sealant</li>
            <li>TF = Temporary Filling</li>
            <li>JC = Jacket Crown</li>
            <li>FB = Fixed Bridge</li>
            <li>P = Pontic</li>
            <li>A = Abutment</li>
            <li>Am = Amalgam</li>
        </ul>
    </div>
</div>

                <div class="form-section">
                    <h3>Diagnosis and Treatment</h3>
                    <div class="mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="treatment" class="form-label">Treatment</label>
                        <textarea class="form-control" id="treatment" name="treatment" rows="3" required></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <div class="mb-3">
                        <label for="record_date" class="form-label">Record Date</label>
                        <input type="date" class="form-control" id="record_date" name="record_date" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
