<!DOCTYPE html>
<html>
<head>
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 8px;
      text-align: center;
      width: 100%;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      outline: none;
      width: 150px; /* Adjusted width for larger inputs */
      vertical-align: middle;
      margin-right: 10px; /* Add spacing between inputs */
    }

    form {
      margin: 20px;
    }

    label {
      display: inline-block;
      margin-bottom: 10px; /* Add spacing between rows */
    }

    .table-container {
      display: none;
    }

    .table-container.active {
      display: block;
    }

    button {
      margin: 10px;
      padding: 8px 16px;
    }

    #progress-indicator {
      text-align: center;
      margin: 10px;
    }
  </style>
</head>
<body>
  <h1>Part I: To be answered by Student/Faculty/Staff</h1>

  <!-- Page 1 -->
  <div id="table1" class="table-container active">
    <h2>Past Medical History</h2>
    <table>
      <tr>
        <th>Diseases</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
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
        <td>Anemia</td>
        <td><input type="radio" name="anemia" value="No"></td>
        <td><input type="radio" name="anemia" value="Yes"></td>
        <td><input type="text" name="anemia-remarks"></td>
      </tr>
      <tr>
        <td>Fainting</td>
        <td><input type="radio" name="fainting" value="No"></td>
        <td><input type="radio" name="fainting" value="Yes"></td>
        <td><input type="text" name="fainting-remarks"></td>
      </tr>
      <tr>
        <td>Behavioral Problem</td>
        <td><input type="radio" name="behavioralproblem" value="No"></td>
        <td><input type="radio" name="behavioralproblem" value="Yes"></td>
        <td><input type="text" name="behavioralproblem-remarks"></td>
      </tr>
      <tr>
        <td>Hearing Problem</td>
        <td><input type="radio" name="hearingproblem" value="No"></td>
        <td><input type="radio" name="hearingproblem" value="Yes"></td>
        <td><input type="text" name="hearingproblem-remarks"></td>
      </tr>
      <tr>
        <td>Pneumonia</td>
        <td><input type="radio" name="pneumonia" value="No"></td>
        <td><input type="radio" name="pneumonia" value="Yes"></td>
        <td><input type="text" name="pneumonia-remarks"></td>
      </tr>
      <tr>
        <td>Scoliosis</td>
        <td><input type="radio" name="scoliosis" value="No"></td>
        <td><input type="radio" name="scoliosis" value="Yes"></td>
        <td><input type="text" name="scoliosis-remarks"></td>
      </tr>
      <tr>
        <td>Fractures</td>
        <td><input type="radio" name="fractures" value="No"></td>
        <td><input type="radio" name="fractures" value="Yes"></td>
        <td><input type="text" name="fractures-remarks"></td>
      </tr>
      <tr>
        <td>Hospitalization</td>
        <td><input type="radio" name="hospitalization" value="No"></td>
        <td><input type="radio" name="hospitalization" value="Yes"></td>
        <td><input type="text" name="hospitalization-remarks"></td>
      </tr>
      <tr>
        <td>Operation</td>
        <td><input type="radio" name="operation" value="No"></td>
        <td><input type="radio" name="operation" value="Yes"></td>
        <td><input type="text" name="operation-remarks"></td>
      </tr>
    </table>
  </div>

  <!-- Page 2 -->
  <div id="table2" class="table-container">
    <h2>Past Medical History</h2>
    <table>
      <tr>
        <th>Diseases</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Chicken Pox</td>
        <td><input type="radio" name="chickenpox" value="No"></td>
        <td><input type="radio" name="chickenpox" value="Yes"></td>
        <td><input type="text" name="chickenpox-remarks"></td>
      </tr>
      <tr>
        <td>Dysmenorrhea</td>
        <td><input type="radio" name="dysmenorrhea" value="No"></td>
        <td><input type="radio" name="dysmenorrhea" value="Yes"></td>
        <td><input type="text" name="dysmenorrhea-remarks"></td>
      </tr>
      <tr>
        <td>Epilepsy</td>
        <td><input type="radio" name="epilepsy" value="No"></td>
        <td><input type="radio" name="epilepsy" value="Yes"></td>
        <td><input type="text" name="epilepsy-remarks"></td>
      </tr>
      <tr>
        <td>Measles</td>
        <td><input type="radio" name="measles" value="No"></td>
        <td><input type="radio" name="measles" value="Yes"></td>
        <td><input type="text" name="measles-remarks"></td>
      </tr>
      <tr>
        <td>Primary Complex</td>
        <td><input type="radio" name="primarycomplex" value="No"></td>
        <td><input type="radio" name="primarycomplex" value="Yes"></td>
        <td><input type="text" name="primarycomplex-remarks"></td>
      </tr>
      <td>Ear Discharge</td>
        <td><input type="radio" name="eardischarge" value="No"></td>
        <td><input type="radio" name="eardischarge" value="Yes"></td>
        <td><input type="text" name="eardischarge-remarks"></td>
      </tr>
      <tr>
        <td>Mumps</td>
        <td><input type="radio" name="mumps" value="No"></td>
        <td><input type="radio" name="mumps" value="Yes"></td>
        <td><input type="text" name="mumps-remarks"></td>
      </tr>
      <tr>
        <td>Diabetes</td>
        <td><input type="radio" name="diabetes" value="No"></td>
        <td><input type="radio" name="diabetes" value="Yes"></td>
        <td><input type="text" name="diabetes-remarks"></td>
      </tr>
      <tr>
        <td>Tonsillitis</td>
        <td><input type="radio" name="tonsillitis" value="No"></td>
        <td><input type="radio" name="tonsillitis" value="Yes"></td>
        <td><input type="text" name="tonsillitis-remarks"></td>
      </tr>
      <tr>
        <td>Hypertension</td>
        <td><input type="radio" name="hypertension" value="No"></td>
        <td><input type="radio" name="hypertension" value="Yes"></td>
        <td><input type="text" name="hypertension-remarks"></td>
      </tr>
      <tr>
        <td>Insomnia</td>
        <td><input type="radio" name="insomnia" value="No"></td>
        <td><input type="radio" name="insomnia" value="Yes"></td>
        <td><input type="text" name="insomnia-remarks"></td>
      </tr>
    </table>
  </div>

  <!-- Page 3 -->
  <div id="table3" class="table-container">
    <h2>Past Medical History</h2>
    <table>
      <tr>
        <th>Diseases</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Heart Disease</td>
        <td><input type="radio" name="heartdisease" value="No"></td>
        <td><input type="radio" name="heartdisease" value="Yes"></td>
        <td><input type="text" name="heartdisease-remarks"></td>
      </tr>
      <tr>
        <td>Kidney Disease</td>
        <td><input type="radio" name="kidneydisease" value="No"></td>
        <td><input type="radio" name="kidneydisease" value="Yes"></td>
        <td><input type="text" name="kidneydisease-remarks"></td>
      </tr>
      <tr>
        <td>Dengue Fever</td>
        <td><input type="radio" name="denguefever" value="No"></td>
        <td><input type="radio" name="denguefever" value="Yes"></td>
        <td><input type="text" name="denguefever-remarks"></td>
      </tr>
      <tr>
        <td>Typhoid Fever</td>
        <td><input type="radio" name="typhoidfever" value="No"></td>
        <td><input type="radio" name="typhoidfever" value="Yes"></td>
        <td><input type="text" name="typhoidfever-remarks"></td>
      </tr>
      <tr>
        <td>Migraine</td>
        <td><input type="radio" name="migraine" value="No"></td>
        <td><input type="radio" name="migraine" value="Yes"></td>
        <td><input type="text" name="migraine-remarks"></td>
      </tr>
      <tr>
        <td>Bleeding Problem</td>
        <td><input type="radio" name="bleedingproblem" value="No"></td>
        <td><input type="radio" name="bleedingproblem" value="Yes"></td>
        <td><input type="text" name="bleedingproblem-remarks"></td>
      </tr>
      <tr>
        <td>Speech Problem</td>
        <td><input type="radio" name="speechproblem" value="No"></td>
        <td><input type="radio" name="speechproblem" value="Yes"></td>
        <td><input type="text" name="speechproblem-remarks"></td>
      </tr>  
      <tr>
        <td>Eating Disorder</td>
        <td><input type="radio" name="eatingdisorder" value="No"></td>
        <td><input type="radio" name="eatingdisorder" value="Yes"></td>
        <td><input type="text" name="eatingdisorder-remarks"></td>
      </tr>     
      <tr>
        <td>Jaundice</td>
        <td><input type="radio" name="jaundice" value="No"></td>
        <td><input type="radio" name="jaundice" value="Yes"></td>
        <td><input type="text" name="jaundice-remarks"></td>
      </tr>     
      <tr>
        <td>Visual Problem</td>
        <td><input type="radio" name="visualproblem" value="No"></td>
        <td><input type="radio" name="visualproblem" value="Yes"></td>
        <td><input type="text" name="visualproblem-remarks"></td>
      </tr>    
      <tr>
        <td>Others</td>
        <td><input type="radio" name="others" value="No"></td>
        <td><input type="radio" name="others" value="Yes"></td>
        <td><input type="text" name="others-remarks"></td>
      </tr>     
    </table>
  </div>
  <!-- Page 4 -->
  <div id="table4" class="table-container">
    <h2>OBGYNE HISTORY (for females)</h2>
    <form>
      <label for="fmens">Menstrual History, Menarche, Age:</label>
      <input type="text" id="fmens" name="fmens"><br><br>

      <label for="lmenperiod">Last Menstrual Period:</label>
      <input type="text" id="lmenperiod" name="lmenperiod"><br><br>

      <label for="cycle">Cycle - Regular:</label>
      <input type="text" id="cycle" name="cycle">

      <label for="irreg">Irregular:</label>
      <input type="text" id="irreg" name="irreg"><br><br>

      <label for="flow_min">Flow - Minimal:</label>
      <input type="text" id="flow_min" name="flow_min">

      <label for="flow_mod">Moderate:</label>
      <input type="text" id="flow_mod" name="flow_mod">

      <label for="flow_max">Maximum:</label>
      <input type="text" id="flow_max" name="flow_max"><br><br>

      <label for="parity_g">Parity - G:</label>
      <input type="text" id="parity_g" name="parity_g">

      <label for="parity_p">P:</label>
      <input type="text" id="parity_p" name="parity_p">

      <label for="parity_a">A:</label>
      <input type="text" id="parity_a" name="parity_a"><br><br>

      <label for="prev_del_date">Previous Delivery Date:</label>
      <input type="text" id="prev_del_date" name="prev_del_date"><br><br>

      <label for="pap_smear_yes">Pap Smear - Yes:</label>
      <input type="text" id="pap_smear_yes" name="pap_smear_yes">

      <label for="pap_smear_no">No:</label>
      <input type="text" id="pap_smear_no" name="pap_smear_no">

      <label for="pap_smear_max">Maximum:</label>
      <input type="text" id="pap_smear_max" name="pap_smear_max"><br><br>

      <label for="other_problem">Other Problem Specify:</label>
      <input type="text" id="other_problem" name="other_problem" style="width: 300px;"><br><br>
    </form>
  </div>

  <div id="progress-indicator">Page <span id="current-page">1</span> of 3</div>
  <!-- Navigation Buttons -->
  <div style="text-align: center;">
    <button id="prevButton" onclick="prevPage()">Back</button>
    <button id="nextButton" onclick="nextPage()">Next</button>
  </div>

  <!-- JavaScript for Navigation -->
  <script>
    let currentPage = 1;
    const totalPages = 4;

    function showPage(page) {
      const tables = document.querySelectorAll('.table-container');
      tables.forEach((table, index) => {
        table.classList.toggle('active', index + 1 === page);
      });

      // Update progress indicator
      document.getElementById('current-page').textContent = page;

      // Enable/Disable navigation buttons
      document.getElementById('prevButton').disabled = page === 1;
      document.getElementById('nextButton').disabled = page === totalPages;
    }

    function nextPage() {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    }

    function prevPage() {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    }

    // Initialize
    showPage(currentPage);
  </script>
</body>
</html>
