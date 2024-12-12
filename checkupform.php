<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health and Wellness Checkup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid black;
      padding: 10px;
      text-align: left;
    }

    input[type="text"] {
      border: none;
      border-bottom: 1px solid black;
      outline: none;
      width: 100%;
      box-sizing: border-box;
      padding: 5px;
    }

    .table-container {
      display: none;
    }

    .table-container.active {
      display: block;
    }
  </style>
</head>
<body>
  <h1>Health and Wellness Checkup</h1>

  <div id="table1" class="table-container active">
    <table>
      <thead>
        <tr>
          <th>Date/Time</th>
          <th>Cues</th>
          <th>Nursing Diagnosis & Intervention</th>
          <th>Medical Diagnosis & Intervention</th>
          <th>Evaluation</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
