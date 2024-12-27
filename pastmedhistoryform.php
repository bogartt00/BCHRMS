<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bchrms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $examination_id = isset($_POST['examination_id']) ? $_POST['examination_id'] : NULL; // Get examination_id from form or set to NULL
    $allergy = isset($_POST['allergy']) ? $_POST['allergy'] : '';
    $asthma = isset($_POST['asthma']) ? $_POST['asthma'] : '';
    $diabetes = isset($_POST['diabetes']) ? $_POST['diabetes'] : '';
    $hypertension = isset($_POST['hypertension']) ? $_POST['hypertension'] : '';
    $heartdisease = isset($_POST['heartdisease']) ? $_POST['heartdisease'] : '';

    $allergy_remarks = isset($_POST['allergy-remarks']) ? $_POST['allergy-remarks'] : '';
    $asthma_remarks = isset($_POST['asthma-remarks']) ? $_POST['asthma-remarks'] : '';
    $diabetes_remarks = isset($_POST['diabetes-remarks']) ? $_POST['diabetes-remarks'] : '';
    $hypertension_remarks = isset($_POST['hypertension-remarks']) ? $_POST['hypertension-remarks'] : '';
    $heartdisease_remarks = isset($_POST['heartdisease-remarks']) ? $_POST['heartdisease-remarks'] : '';

    // Additional Medical History
    $chickenpox = isset($_POST['chickenpox']) ? $_POST['chickenpox'] : '';
    $measles = isset($_POST['measles']) ? $_POST['measles'] : '';
    $tuberculosis = isset($_POST['tuberculosis']) ? $_POST['tuberculosis'] : '';
    $stroke = isset($_POST['stroke']) ? $_POST['stroke'] : '';

    $chickenpox_remarks = isset($_POST['chickenpox-remarks']) ? $_POST['chickenpox-remarks'] : '';
    $measles_remarks = isset($_POST['measles-remarks']) ? $_POST['measles-remarks'] : '';
    $tuberculosis_remarks = isset($_POST['tuberculosis-remarks']) ? $_POST['tuberculosis-remarks'] : '';
    $stroke_remarks = isset($_POST['stroke-remarks']) ? $_POST['stroke-remarks'] : '';

    // OB/GYNE History (for females)
    $fmens = isset($_POST['fmens']) ? $_POST['fmens'] : '';
    $lmenperiod = isset($_POST['lmenperiod']) ? $_POST['lmenperiod'] : '';
    $cycle = isset($_POST['cycle']) ? $_POST['cycle'] : '';
    $irreg = isset($_POST['irreg']) ? $_POST['irreg'] : '';
    $flow_min = isset($_POST['flow_min']) ? $_POST['flow_min'] : '';
    $flow_mod = isset($_POST['flow_mod']) ? $_POST['flow_mod'] : '';
    $flow_max = isset($_POST['flow_max']) ? $_POST['flow_max'] : '';
    $gravid = isset($_POST['gravid']) ? $_POST['gravid'] : '';

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO medical_history (
        examination_id, allergy, asthma, diabetes, hypertension, heartdisease,
        allergy_remarks, asthma_remarks, diabetes_remarks, hypertension_remarks, heartdisease_remarks,
        chickenpox, measles, tuberculosis, stroke,
        chickenpox_remarks, measles_remarks, tuberculosis_remarks, stroke_remarks,
        fmens, lmenperiod, cycle, irreg, flow_min, flow_mod, flow_max, gravid
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters (make sure the number and type match the columns)
    $stmt->bind_param("issssssssssssssssssssssssss", 
        $examination_id, $allergy, $asthma, $diabetes, $hypertension, $heartdisease,
        $allergy_remarks, $asthma_remarks, $diabetes_remarks, $hypertension_remarks, $heartdisease_remarks,
        $chickenpox, $measles, $tuberculosis, $stroke,
        $chickenpox_remarks, $measles_remarks, $tuberculosis_remarks, $stroke_remarks,
        $fmens, $lmenperiod, $cycle, $irreg, $flow_min, $flow_mod, $flow_max, $gravid
    );

    if ($stmt->execute()) {
        echo "<script>alert('Medical history submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical History Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .table th, .table td { text-align: center; }
    .table td input[type="text"] { border: none; border-bottom: 1px solid black; outline: none; width: 150px; }
    .table-container { display: none; }
    .table-container.active { display: block; }
    #progress-indicator { text-align: center; margin: 10px; }
    .form-label { margin-bottom: 5px; }
    .input-group { margin-bottom: 15px; }
    .input-group input { margin-left: 10px; }
    .form-group { margin-bottom: 15px; }
    .form-control { margin-right: 10px; }
    button { margin: 10px; }
  </style>
</head>
<body>
  <div class="container mt-4">
    <h1 class="text-center">Part I: To be answered by Student/Faculty/Staff</h1>
    <form method="POST" action="">
      <!-- Page 1: Past Medical History -->
      <div id="table1" class="table-container active">
        <h2>Past Medical History</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Diseases</th>
              <th>No</th>
              <th>Yes</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Allergy</td>
              <td><input type="radio" name="allergy" value="No"></td>
              <td><input type="radio" name="allergy" value="Yes"></td>
              <td><input type="text" name="allergy-remarks"></td>
            </tr>
            <tr>
              <td>Asthma</td>
              <td><input type="radio" name="asthma" value="No"></td>
              <td><input type="radio" name="asthma" value="Yes"></td>
              <td><input type="text" name="asthma-remarks"></td>
            </tr>
            <tr>
              <td>Diabetes</td>
              <td><input type="radio" name="diabetes" value="No"></td>
              <td><input type="radio" name="diabetes" value="Yes"></td>
              <td><input type="text" name="diabetes-remarks"></td>
            </tr>
            <tr>
              <td>Hypertension</td>
              <td><input type="radio" name="hypertension" value="No"></td>
              <td><input type="radio" name="hypertension" value="Yes"></td>
              <td><input type="text" name="hypertension-remarks"></td>
            </tr>
            <tr>
              <td>Heart Disease</td>
              <td><input type="radio" name="heartdisease" value="No"></td>
              <td><input type="radio" name="heartdisease" value="Yes"></td>
              <td><input type="text" name="heartdisease-remarks"></td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Page 2: Additional Medical History -->
      <div id="table2" class="table-container">
        <h2>Additional Medical History</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Diseases</th>
              <th>No</th>
              <th>Yes</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Chickenpox</td>
              <td><input type="radio" name="chickenpox" value="No"></td>
              <td><input type="radio" name="chickenpox" value="Yes"></td>
              <td><input type="text" name="chickenpox-remarks"></td>
            </tr>
            <tr>
              <td>Measles</td>
              <td><input type="radio" name="measles" value="No"></td>
              <td><input type="radio" name="measles" value="Yes"></td>
              <td><input type="text" name="measles-remarks"></td>
            </tr>
            <tr>
              <td>Tuberculosis</td>
              <td><input type="radio" name="tuberculosis" value="No"></td>
              <td><input type="radio" name="tuberculosis" value="Yes"></td>
              <td><input type="text" name="tuberculosis-remarks"></td>
            </tr>
            <tr>
              <td>Stroke</td>
              <td><input type="radio" name="stroke" value="No"></td>
              <td><input type="radio" name="stroke" value="Yes"></td>
              <td><input type="text" name="stroke-remarks"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Page 3: OB/GYNE History -->
      <div id="table3" class="table-container">
        <h2>OB/GYNE History</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Questions</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Mens Period:</td>
              <td><input type="text" name="fmens"></td>
            </tr>
            <tr>
              <td>Last Menstrual Period:</td>
              <td><input type="date" name="lmenperiod"></td>
            </tr>
            <tr>
              <td>Cycle:</td>
              <td><input type="text" name="cycle"></td>
            </tr>
            <tr>
              <td>Irregular Periods:</td>
              <td><input type="text" name="irreg"></td>
            </tr>
            <tr>
              <td>Flow (Min):</td>
              <td><input type="text" name="flow_min"></td>
            </tr>
            <tr>
              <td>Flow (Mod):</td>
              <td><input type="text" name="flow_mod"></td>
            </tr>
            <tr>
              <td>Flow (Max):</td>
              <td><input type="text" name="flow_max"></td>
            </tr>
            <tr>
              <td>Gravida:</td>
              <td><input type="text" name="gravid"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Navigation Buttons -->
      <div id="progress-indicator">
        <button type="button" id="prevBtn" class="btn btn-secondary">Previous</button>
        <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
        <button type="submit" id="submitBtn" class="btn btn-success" style="display:none;">Submit</button>
      </div>
    </form>
  </div>

  <script>
    let currentTab = 0;
    showTab(currentTab);

    document.getElementById("nextBtn").addEventListener("click", function() {
      if (currentTab < document.querySelectorAll(".table-container").length - 1) {
        currentTab++;
        showTab(currentTab);
      }
    });

    document.getElementById("prevBtn").addEventListener("click", function() {
      if (currentTab > 0) {
        currentTab--;
        showTab(currentTab);
      }
    });

    function showTab(n) {
      let tabs = document.querySelectorAll(".table-container");
      tabs.forEach((tab, index) => {
        tab.classList.remove("active");
        if (index === n) tab.classList.add("active");
      });

      if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }

      if (n === tabs.length - 1) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "inline";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
        document.getElementById("submitBtn").style.display = "none";
      }
    }
  </script>
</body>
</html>
