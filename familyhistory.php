<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
    }

    .container-wrapper {
      display: flex;
    }

    .sidebar {
      width: 20%;
      background-color: #f4f4f4;
      padding: 15px;
      border-right: 1px solid #ddd;
    }

    .main-content {
      width: 80%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }

    /* Table Styles */
    table {
      border: 1px solid black;
      border-collapse: collapse;
      width: 60%;
      margin: 10px auto;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f0f0f0;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    /* Centering Tables */
    .table-container {
      display: none;
    }

    .table-container.active {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    /* Progress Indicator */
    #progress-indicator {
      text-align: center;
      margin: 15px;
    }

    /* Buttons */
    button {
      margin: 10px;
      padding: 8px 16px;
      font-size: 16px;
      border: none;
      background-color: #007bff;
      color: white;
      cursor: pointer;
      border-radius: 4px;
    }

    button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    button:hover:not(:disabled) {
      background-color: #0056b3;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      outline: none;
      width: 300px; /* Adjusted width for larger inputs */
      vertical-align: middle;
      margin-right: 10px; /* Add spacing between inputs */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-content {
        width: 100%;
      }

      table {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Page 1 -->
  <div id="table1" class="table-container active">
    <h2>C. Family History</h2>
    <table>
      <tr>
        <th>Diseases</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Cancer (breast, colon, prostate)</td>
        <td><input type="radio" name="cancer" value="No"></td>
        <td><input type="radio" name="cancer" value="Yes"></td>
        <td><input type="text" name="cancer-remarks"></td>
      </tr>
      <tr>
        <td>Heart Problem</td>
        <td><input type="radio" name="heartproblem" value="No"></td>
        <td><input type="radio" name="heartproblem" value="Yes"></td>
        <td><input type="text" name="heartproblem-remarks"></td>
      </tr>
      <tr>
        <td>High BP</td>
        <td><input type="radio" name="highbp" value="No"></td>
        <td><input type="radio" name="highbp" value="Yes"></td>
        <td><input type="text" name="highbp-remarks"></td>
      </tr>
      <tr>
        <td>Diabetes</td>
        <td><input type="radio" name="diabetes" value="No"></td>
        <td><input type="radio" name="diabetes" value="Yes"></td>
        <td><input type="text" name="diabetes-remarks"></td>
      </tr>
      <tr>
        <td>Kidney Problem</td>
        <td><input type="radio" name="kidneyprob" value="No"></td>
        <td><input type="radio" name="kidneyprob" value="Yes"></td>
        <td><input type="text" name="kidneyprob-remarks"></td>
      </tr>
      <tr>
        <td>Seizure Disorder</td>
        <td><input type="radio" name="seizuredis" value="No"></td>
        <td><input type="radio" name="seizuredis" value="Yes"></td>
        <td><input type="text" name="seizuredis-remarks"></td>
      </tr>
      <tr>
        <td>Autoimmune Disorder</td>
        <td><input type="radio" name="autoimmunedis" value="No"></td>
        <td><input type="radio" name="autoimmunedis" value="Yes"></td>
        <td><input type="text" name="autoimmunedis-remarks"></td>
      </tr>

    </table>
  </div>

  <!-- Page 2 -->
  <div id="table2" class="table-container">
    <h2>C. Family History</h2>
    <table>
      <tr>
        <th>Diseases</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Tubercolosis</td>
        <td><input type="radio" name="tubercolosis" value="No"></td>
        <td><input type="radio" name="tubercolosis" value="Yes"></td>
        <td><input type="text" name="tubercolosis-remarks"></td>
      </tr>
      <tr>
        <td>Asthma</td>
        <td><input type="radio" name="asthma" value="No"></td>
        <td><input type="radio" name="asthma" value="Yes"></td>
        <td><input type="text" name="asthma-remarks"></td>
      </tr>
      <tr>
        <td>Bleeding Tendencies</td>
        <td><input type="radio" name="bleedingtend" value="No"></td>
        <td><input type="radio" name="bleedingtend" value="Yes"></td>
        <td><input type="text" name="bleedingtend-remarks"></td>
      </tr>
      <tr>
        <td>Mental Disorder</td>
        <td><input type="radio" name="mentaldis" value="No"></td>
        <td><input type="radio" name="mentaldis" value="Yes"></td>
        <td><input type="text" name="mentaldis-remarks"></td>
      </tr>
      <tr>
        <td>Stroke</td>
        <td><input type="radio" name="stroke" value="No"></td>
        <td><input type="radio" name="stroke" value="Yes"></td>
        <td><input type="text" name="stroke-remarks"></td>
      </tr>
      <td>Hyperlipidemia</td>
        <td><input type="radio" name="hyperlipidemia" value="No"></td>
        <td><input type="radio" name="hyperlipidemia" value="Yes"></td>
        <td><input type="text" name="hyperlipidemia-remarks"></td>
      </tr>
      <tr>
        <td>Alcoholism</td>
        <td><input type="radio" name="alcoholism" value="No"></td>
        <td><input type="radio" name="alcoholism" value="Yes"></td>
        <td><input type="text" name="alcoholism-remarks"></td>
      </tr>
    </table>
  </div>
  <div id="progress-indicator">Page <span id="current-page">1</span> of 2</div>
  <!-- Navigation Buttons -->
  <div style="text-align: center;">
    <button id="prevButton" onclick="prevPage()">Back</button>
    <button id="nextButton" onclick="nextPage()">Next</button>
  </div>

  <!-- JavaScript for Navigation -->
  <script>
    let currentPage = 1;
    const totalPages = 2;

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

</div>
</body>
</html>

