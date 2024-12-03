<!DOCTYPE html>
<html>
<head>
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 8px;
      text-align: left;
      width: 100%;
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
   
  <!-- Page 1 -->
  <div id="table1" class="table-container active">
    <h1>IMMUNIZATION HISTORY (Remarks for MDs only)</h1>
    <table>
      <tr>
        <th>Immunization</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Hepatitis B</td>
        <td><input type="radio" name="hepatitis" value="No"></td>
        <td><input type="radio" name="allergy" value="Yes"></td>
        <td><input type="text" name="allergy-remarks"></td>
      </tr>
      <tr>
        <td>0</td>
        <td><input type="radio" name="0" value="No"></td>
        <td><input type="radio" name="0" value="Yes"></td>
        <td><input type="text" name="0-remarks"></td>
      </tr>
      <tr>
        <td>1</td>
        <td><input type="radio" name="1" value="No"></td>
        <td><input type="radio" name="1" value="Yes"></td>
        <td><input type="text" name="1-remarks"></td>
      </tr>
      <tr>
        <td>2-6</td>
        <td><input type="radio" name="2_6" value="No"></td>
        <td><input type="radio" name="2_6" value="Yes"></td>
        <td><input type="text" name="2_6-remarks"></td>
      </tr>
      <tr>
        <td>Booster not routinely recommended</td>
        <td><input type="radio" name="boosternrr" value="No"></td>
        <td><input type="radio" name="boosternrr" value="Yes"></td>
        <td><input type="text" name="boosternrr-remarks"></td>
      </tr>
      <tr>
        <td>Pneumoccocal Vacine</td>
        <td><input type="radio" name="pneumoccocalvac" value="No"></td>
        <td><input type="radio" name="pneumoccocalvac" value="Yes"></td>
        <td><input type="text" name="pneumoccocalvac-remarks"></td>
      </tr>
      <tr>
        <td>Single Dose</td>
        <td><input type="radio" name="singled" value="No"></td>
        <td><input type="radio" name="singled" value="Yes"></td>
        <td><input type="text" name="singled-remarks"></td>
      </tr>
      <tr>
        <td>Revaccination may be given 5 years</td>
        <td><input type="radio" name="revaccination" value="No"></td>
        <td><input type="radio" name="revaccination" value="Yes"></td>
        <td><input type="text" name="revaccination-remarks"></td>
      </tr>
      <tr>
        <td>Influenza</td>
        <td><input type="radio" name="influenza" value="No"></td>
        <td><input type="radio" name="influenza" value="Yes"></td>
        <td><input type="text" name="influenza-remarks"></td>
      </tr>
      <tr>
        <td>Once a year preferrably from Feb-Jun</td>
        <td><input type="radio" name="hospitalization" value="No"></td>
        <td><input type="radio" name="hospitalization" value="Yes"></td>
        <td><input type="text" name="hospitalization-remarks"></td>
      </tr>
    </table>
  </div>  
  <!-- Page 2 -->
  <div id="table2" class="table-container">
    <h1>IMMUNIZATION HISTORY (Remarks for MDs only)</h1>
    <table>
      <tr>
        <th>Immunization</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Tetanus? Diphtheria</td>
        <td><input type="radio" name="tetanus" value="No"></td>
        <td><input type="radio" name="tetanus" value="Yes"></td>
        <td><input type="text" name="tetanus-remarks"></td>
      </tr>
      <tr>
        <td>0</td>
        <td><input type="radio" name="zero" value="No"></td>
        <td><input type="radio" name="zero" value="Yes"></td>
        <td><input type="text" name="zero-remarks"></td>
      </tr>
      <tr>
        <td>1</td>
        <td><input type="radio" name="one" value="No"></td>
        <td><input type="radio" name="one" value="Yes"></td>
        <td><input type="text" name="one-remarks"></td>
      </tr>
      <tr>
        <td>6-12</td>
        <td><input type="radio" name="6_12" value="No"></td>
        <td><input type="radio" name="6_12" value="Yes"></td>
        <td><input type="text" name="6_12-remarks"></td>
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
    <h1>Additional for Health Care Staff</h1>
    <table>
      <tr>
        <th>Immunization</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Typhoid</td>
        <td><input type="radio" name="typhoid" value="No"></td>
        <td><input type="radio" name="typhoid" value="Yes"></td>
        <td><input type="text" name="typhoid-remarks"></td>
      </tr>
      <tr>
        <td><br>Oral for primary & booster, 1 cap each<br>
          on day 0, one hr. before meals with lukewarm/<br> 
          cold water
        </td>
        <td><input type="radio" name="oral" value="No"></td>
        <td><input type="radio" name="oral" value="Yes"></td>
        <td><input type="text" name="oral-remarks"></td>
      </tr>
      <tr>
        <td>Day 2</td>
        <td><input type="radio" name="daytwo" value="No"></td>
        <td><input type="radio" name="daytwo" value="Yes"></td>
        <td><input type="text" name="daytwo-remarks"></td>
      </tr>
      <tr>
        <td>Day 4</td>
        <td><input type="radio" name="dayfour" value="No"></td>
        <td><input type="radio" name="dayfour" value="Yes"></td>
        <td><input type="text" name="dayfour-remarks"></td>
      </tr> <br><br>
      <tr>
        <td>Booster every 2-3 years</td>
        <td><input type="radio" name="booster" value="No"></td>
        <td><input type="radio" name="booster" value="Yes"></td>
        <td><input type="text" name="booster-remarks"></td>
      </tr>
      <td>1M - for primary & booster single 0.5ml <br>
        lM dose on deltoid booster o2-3 years
      </td>
        <td><input type="radio" name="primaryboos" value="No"></td>
        <td><input type="radio" name="primaryboos" value="Yes"></td>
        <td><input type="text" name="primaryboos-remarks"></td>
      </tr>
    </table>
  </div>  

  <!-- Page 4 -->
  <div id="table4" class="table-container">
    <h1>Additional for Health Care Staff</h1>
    <table>
      <tr>
        <th>Immunization</th>
        <th>No</th>
        <th>Yes</th>
        <th>Remarks</th>
      </tr>
      <tr>
        <td>Rabies</td>
        <td><input type="radio" name="rabies" value="No"></td>
        <td><input type="radio" name="rabies" value="Yes"></td>
        <td><input type="text" name="rabies-remarks"></td>
      </tr>
      <tr>
        <td><br>Primary-series of 3 shots days 0, 7, <br>
          21 or 28
        </td>
        <td><input type="radio" name="primary" value="No"></td>
        <td><input type="radio" name="primary" value="Yes"></td>
        <td><input type="text" name="primary-remarks"></td>
      </tr>
      <tr>
        <td>lM - on the deltoid<br>
          PVRV - 0.5ml <br>
          PCESC, HDCV, PDEV - 1.0ml <br>
        </td>
        <td><input type="radio" name="lm_deltoid" value="No"></td>
        <td><input type="radio" name="lm_deltoid" value="Yes"></td>
        <td><input type="text" name="lm_deltoid-remarks"></td>
      </tr>
      <tr>
        <td>ID - on the deltoid <br>
          PVRV, PDEV, PCEC - 0.1ml
        </td>
        <td><input type="radio" name="id_deltoid" value="No"></td>
        <td><input type="radio" name="id_deltoid" value="Yes"></td>
        <td><input type="text" name="id_deltoid-remarks"></td>
      </tr> <br><br>
      <tr>
        <td>Booster - single dose IM or ID q <br>
          2 years
        </td>
        <td><input type="radio" name="boosterSD" value="No"></td>
        <td><input type="radio" name="boosterSD" value="Yes"></td>
        <td><input type="text" name="boosterSD-remarks"></td>
      </tr>
      
    </table>
  </div>  

  <div id="progress-indicator">Page <span id="current-page">1</span> of 4</div>
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

