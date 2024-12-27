<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Examination Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        .form-section {
            margin-bottom: 30px;
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
    <h1 class="text-center">Laboratory Examination Record</h1>

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

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $symptoms = $_POST['symptoms'];
                $diagnosis = $_POST['diagnosis'];
                $prescription = $_POST['prescription'];
                $cbc = $_POST['cbc'];
                $urinalysis = $_POST['urinalysis'];
                $fecalysis = $_POST['fecalysis'];
                $chest_xray = $_POST['chest_xray'];
                $hepa_b_antigen = $_POST['hepa_b_antigen'];
                $hepa_b_antibody = $_POST['hepa_b_antibody'];
                $occult_blood = $_POST['occult_blood'];
                $psa = $_POST['psa'];
                $mammo = $_POST['mammo'];
                $pap_test = $_POST['pap_test'];
                $fbs = $_POST['fbs'];
                $creatinine = $_POST['creatinine'];
                $uric_acid = $_POST['uric_acid'];
                $non_fasting_cholesterol = $_POST['non_fasting_cholesterol'];
                $ecg = $_POST['ecg'];
                $record_date = $_POST['record_date']; // Get record date

                // If record_date is empty, set it to the current date
                if (empty($record_date)) {
                    $record_date = date('Y-m-d'); // Set current date if empty
                }

                // Check if patient selection is valid
                if (empty($student_id)) {
                    echo "<div class='alert alert-danger'>Please select a patient.</div>";
                } else {
                    // Prepare SQL for inserting laboratory record
                    $stmt = $conn->prepare("INSERT INTO laboratory_examinations (examination_id, symptoms, diagnosis, prescription, cbc, urinalysis, fecalysis, chest_xray, hepa_b_antigen, hepa_b_antibody, occult_blood, psa, mammo, pap_test, fbs, creatinine, uric_acid, non_fasting_cholesterol, ecg, record_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    // Bind the parameters
                    $stmt->bind_param("isssssssssssssssssss", $examination_id, $symptoms, $diagnosis, $prescription, $cbc, $urinalysis, $fecalysis, $chest_xray, $hepa_b_antigen, $hepa_b_antibody, $occult_blood, $psa, $mammo, $pap_test, $fbs, $creatinine, $uric_acid, $non_fasting_cholesterol, $ecg, $record_date);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record added successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                    }

                    $stmt->close();
                }
            }
            ?>

            <form action="" method="post">
                <div class="form-section">
                    <label for="symptoms">Symptoms</label>
                    <input type="text" class="form-control" id="symptoms" name="symptoms" required>
                </div>

                <div class="form-section">
                    <label for="diagnosis">Diagnosis</label>
                    <input type="text" class="form-control" id="diagnosis" name="diagnosis" required>
                </div>

                <div class="form-section">
                    <label for="prescription">Prescription</label>
                    <input type="text" class="form-control" id="prescription" name="prescription" required>
                </div>

                <!-- Laboratory Tests -->
                <div class="form-section">
                    <label for="cbc">CBC</label>
                    <input type="text" class="form-control" id="cbc" name="cbc">
                </div>

                <div class="form-section">
                    <label for="urinalysis">Urinalysis</label>
                    <input type="text" class="form-control" id="urinalysis" name="urinalysis">
                </div>

                <div class="form-section">
                    <label for="fecalysis">Fecalysis</label>
                    <input type="text" class="form-control" id="fecalysis" name="fecalysis">
                </div>

                <div class="form-section">
                    <label for="chest_xray">Chest X-Ray</label>
                    <input type="text" class="form-control" id="chest_xray" name="chest_xray">
                </div>

                <div class="form-section">
                    <label for="hepa_b_antigen">Hepa B Antigen</label>
                    <input type="text" class="form-control" id="hepa_b_antigen" name="hepa_b_antigen">
                </div>

                <div class="form-section">
                    <label for="hepa_b_antibody">Hepa B Antibody</label>
                    <input type="text" class="form-control" id="hepa_b_antibody" name="hepa_b_antibody">
                </div>

                <div class="form-section">
                    <label for="occult_blood">Occult Blood</label>
                    <input type="text" class="form-control" id="occult_blood" name="occult_blood">
                </div>

                <div class="form-section">
                    <label for="psa">PSA</label>
                    <input type="text" class="form-control" id="psa" name="psa">
                </div>

                <div class="form-section">
                    <label for="mammo">Mammo</label>
                    <input type="text" class="form-control" id="mammo" name="mammo">
                </div>

                <div class="form-section">
                    <label for="pap_test">Pap Test</label>
                    <input type="text" class="form-control" id="pap_test" name="pap_test">
                </div>

                <div class="form-section">
                    <label for="fbs">FBS</label>
                    <input type="text" class="form-control" id="fbs" name="fbs">
                </div>

                <div class="form-section">
                    <label for="creatinine">Creatinine</label>
                    <input type="text" class="form-control" id="creatinine" name="creatinine">
                </div>

                <div class="form-section">
                    <label for="uric_acid">Uric Acid</label>
                    <input type="text" class="form-control" id="uric_acid" name="uric_acid">
                </div>

                <div class="form-section">
                    <label for="non_fasting_cholesterol">Non-Fasting Cholesterol</label>
                    <input type="text" class="form-control" id="non_fasting_cholesterol" name="non_fasting_cholesterol">
                </div>

                <div class="form-section">
                    <label for="ecg">ECG</label>
                    <input type="text" class="form-control" id="ecg" name="ecg">
                </div>

                <div class="form-section">
                    <label for="record_date">Record Date</label>
                    <input type="date" class="form-control" id="record_date" name="record_date">
                </div>

                <div class="form-section text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
