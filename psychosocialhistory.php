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

    th {
      width: auto%; /* Adjust width as needed for proper spacing */
      text-align: left; /* Optional: center-align the header text */
    }
    
    .table-container {
      display: none;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      outline: none;
      width: 125px; /* Adjusted width for larger inputs */
      vertical-align: middle;
      margin-right: 10px; /* Add spacing between inputs */
    }
    #symptom, #systems {
      width: 95%; /* Adjust as needed to make the line longer */
    }
    .full-width-input {
      width: 100%; /* Full width input for specific fields */
      box-sizing: border-box; /* Include padding/borders in the width calculation */
    }
    button {
      margin: 10px;
      padding: 8px 16px;
    } 

    .remarks {
      display: flex;
      align-items: center;
      gap: 15px;
    }
  </style>
</head>
<body>

    <h1>A. HISTORY</h1>

    <form>
      <label for="symptom">1. Present Pertinent History: Any Symptom</label>
      <input type="text" id="symptom" name="symptom"><br><br>

      <label for="systems">2. Review of systems</label>
      <input type="text" id="systems" name="systems"><br><br>

    </form>
    <h2>B. PSYCHOSOCIAL HISTORY</h2>
    <table>
      <tr>
        <th></th>
        <th>No</th>
        <th>Yes</th>
        <th>IF YES:</th>
      </tr>
      <tr>
        <td>1. Drinking </td>
        <td><input type="radio" name="drinking" value="No"></td>
        <td><input type="radio" name="drinking" value="Yes"></td>
        <td>
            <div class="remarks">
            How much?<input type="text" name="howmuch-remarks">
            How often?<input type="text" name="howoften-remarks">
            </div>
        </td>
      </tr> 
      <td>2. Smoking </td>
        <td><input type="radio" name="smoking" value="No"></td>
        <td><input type="radio" name="smoking" value="Yes"></td>
        <td>
            <div class="remarks">
            Number of sticks/day<input type="text" name="numsticks-remarks">
            Since when<input type="text" name="sincewhen-remarks">
            </div>
        </td>
      </tr> 
      <td>3. Drug Use </td>
        <td><input type="radio" name="druguse" value="No"></td>
        <td><input type="radio" name="druguse" value="Yes"></td>
        <td>
            <div class="remarks">
            Type<input type="text" name="type-remarks">
            Regular use: Yes<input type="text" name="yes-remarks">
            No<input type="text" name="no-remarks">
            </div>
        </td>
      </tr>
      <td>4. Driving </td>
        <td><input type="radio" name="druguse" value="No"></td>
        <td><input type="radio" name="druguse" value="Yes"></td>
        <td>
            <div class="remarks">
            Specify Vehicle<input type="text" name="specifyvec-remarks">
            With License: Yes<input type="text" name="yes-remarks">
            No<input type="text" name="no-remarks">
            </div>
        </td>
      </tr>
      <td>5. Abuse</td>
        <td><input type="radio" name="cancer" value="No"></td>
        <td><input type="radio" name="cancer" value="Yes"></td>
      </tr>
      <td>Physical</td>
        <td><input type="radio" name="physical" value="No"></td>
        <td><input type="radio" name="physical" value="Yes"></td>
      </tr>
      <td>Sexual</td>
        <td><input type="radio" name="sexual" value="No"></td>
        <td><input type="radio" name="sexual" value="Yes"></td>
      </tr>
      <td>Verbal</td>
        <td><input type="radio" name="verbal" value="No"></td>
        <td><input type="radio" name="verbal" value="Yes"></td>
      </tr>      
    </table>
  </div>

</body>
</html>
