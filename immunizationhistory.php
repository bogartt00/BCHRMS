<?php
include 'config.php';  // Database connection

// Initialize variables for form fields to handle possible errors
$hepatitis_b = $hepatitis_b_remarks = $polio = $polio_remarks = $pneumococcal_vaccine = $pneumococcal_vaccine_remarks = $influenza = $influenza_remarks = '';
$tetanus = $tetanus_remarks = $mumps = $mumps_remarks = $measles = $measles_remarks = $diabetes = $diabetes_remarks = '';
$typhoid = $typhoid_remarks = $hepatitis_a = $hepatitis_a_remarks = $rabies = $rabies_remarks = $rabies_booster = $rabies_booster_remarks = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Get form data
        $examination_id = $_POST['examination_id'] ?? null;
        if (!$examination_id) {
            throw new Exception("Examination ID is missing.");
        }

        $data = [
            ':examination_id' => $examination_id,
            ':hepatitis_b' => $_POST['hepatitis_b'] ?? null,
            ':hepatitis_b_remarks' => $_POST['hepatitis_b_remarks'] ?? null,
            ':polio' => $_POST['polio'] ?? null,
            ':polio_remarks' => $_POST['polio_remarks'] ?? null,
            ':pneumococcal_vaccine' => $_POST['pneumococcal_vaccine'] ?? null,
            ':pneumococcal_vaccine_remarks' => $_POST['pneumococcal_vaccine_remarks'] ?? null,
            ':influenza' => $_POST['influenza'] ?? null,
            ':influenza_remarks' => $_POST['influenza_remarks'] ?? null,
            ':tetanus' => $_POST['tetanus'] ?? null,
            ':tetanus_remarks' => $_POST['tetanus_remarks'] ?? null,
            ':mumps' => $_POST['mumps'] ?? null,
            ':mumps_remarks' => $_POST['mumps_remarks'] ?? null,
            ':measles' => $_POST['measles'] ?? null,
            ':measles_remarks' => $_POST['measles_remarks'] ?? null,
            ':diabetes' => $_POST['diabetes'] ?? null,
            ':diabetes_remarks' => $_POST['diabetes_remarks'] ?? null,
            ':typhoid' => $_POST['typhoid'] ?? null,
            ':typhoid_remarks' => $_POST['typhoid_remarks'] ?? null,
            ':hepatitis_a' => $_POST['hepatitis_a'] ?? null,
            ':hepatitis_a_remarks' => $_POST['hepatitis_a_remarks'] ?? null,
            ':rabies' => $_POST['rabies'] ?? null,
            ':rabies_remarks' => $_POST['rabies_remarks'] ?? null,
            ':rabies_booster' => $_POST['rabies_booster'] ?? null,
            ':rabies_booster_remarks' => $_POST['rabies_booster_remarks'] ?? null,
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];

        // Check if the record exists
        $checkQuery = "SELECT id FROM immunization_history WHERE examination_id = :examination_id";
        $stmt = $conn->prepare($checkQuery);
        $stmt->execute([':examination_id' => $examination_id]);
        $exists = $stmt->fetch();

        if ($exists) {
            // Update record
            $updateQuery = "UPDATE immunization_history SET
                hepatitis_b = :hepatitis_b,
                hepatitis_b_remarks = :hepatitis_b_remarks,
                polio = :polio,
                polio_remarks = :polio_remarks,
                pneumococcal_vaccine = :pneumococcal_vaccine,
                pneumococcal_vaccine_remarks = :pneumococcal_vaccine_remarks,
                influenza = :influenza,
                influenza_remarks = :influenza_remarks,
                tetanus = :tetanus,
                tetanus_remarks = :tetanus_remarks,
                mumps = :mumps,
                mumps_remarks = :mumps_remarks,
                measles = :measles,
                measles_remarks = :measles_remarks,
                diabetes = :diabetes,
                diabetes_remarks = :diabetes_remarks,
                typhoid = :typhoid,
                typhoid_remarks = :typhoid_remarks,
                hepatitis_a = :hepatitis_a,
                hepatitis_a_remarks = :hepatitis_a_remarks,
                rabies = :rabies,
                rabies_remarks = :rabies_remarks,
                rabies_booster = :rabies_booster,
                rabies_booster_remarks = :rabies_booster_remarks,
                updated_at = :updated_at
                WHERE examination_id = :examination_id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->execute($data);
            echo "Record updated successfully.";
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO immunization_history (
                examination_id, hepatitis_b, hepatitis_b_remarks, polio, polio_remarks,
                pneumococcal_vaccine, pneumococcal_vaccine_remarks, influenza, influenza_remarks,
                tetanus, tetanus_remarks, mumps, mumps_remarks, measles, measles_remarks,
                diabetes, diabetes_remarks, typhoid, typhoid_remarks, hepatitis_a, hepatitis_a_remarks,
                rabies, rabies_remarks, rabies_booster, rabies_booster_remarks, created_at, updated_at
            ) VALUES (
                :examination_id, :hepatitis_b, :hepatitis_b_remarks, :polio, :polio_remarks,
                :pneumococcal_vaccine, :pneumococcal_vaccine_remarks, :influenza, :influenza_remarks,
                :tetanus, :tetanus_remarks, :mumps, :mumps_remarks, :measles, :measles_remarks,
                :diabetes, :diabetes_remarks, :typhoid, :typhoid_remarks, :hepatitis_a, :hepatitis_a_remarks,
                :rabies, :rabies_remarks, :rabies_booster, :rabies_booster_remarks, :created_at, :updated_at
            )";
            $stmt = $conn->prepare($insertQuery);
            $stmt->execute($data);
            echo "Record inserted successfully.";
        }

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred while saving data. Please try again.";
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        echo "An error occurred. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Immunization History Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin-right: 110px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 50px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td input[type="radio"] {
            margin-right: 10px;
        }
        td input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="container">
        <h1>Immunization History Form</h1>

        <form method="POST" action="">
            <input type="hidden" name="examination_id" value="<?php echo $_GET['examination_id']; ?>">

            <table>
                <tr>
                    <th>Vaccine</th>
                    <th>Administered</th>
                    <th>Remarks</th>
                </tr>
                <tr>
                    <td>Hepatitis B</td>
                    <td>
                        <input type="radio" name="hepatitis_b" value="Yes" <?php echo ($hepatitis_b == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="hepatitis_b" value="No" <?php echo ($hepatitis_b == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="hepatitis_b_remarks" value="<?php echo $hepatitis_b_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Polio</td>
                    <td>
                        <input type="radio" name="polio" value="Yes" <?php echo ($polio == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="polio" value="No" <?php echo ($polio == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="polio_remarks" value="<?php echo $polio_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Pneumococcal Vaccine</td>
                    <td>
                        <input type="radio" name="pneumococcal_vaccine" value="Yes" <?php echo ($pneumococcal_vaccine == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="pneumococcal_vaccine" value="No" <?php echo ($pneumococcal_vaccine == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="pneumococcal_vaccine_remarks" value="<?php echo $pneumococcal_vaccine_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Influenza</td>
                    <td>
                        <input type="radio" name="influenza" value="Yes" <?php echo ($influenza == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="influenza" value="No" <?php echo ($influenza == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="influenza_remarks" value="<?php echo $influenza_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Tetanus</td>
                    <td>
                        <input type="radio" name="tetanus" value="Yes" <?php echo ($tetanus == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="tetanus" value="No" <?php echo ($tetanus == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="tetanus_remarks" value="<?php echo $tetanus_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Mumps</td>
                    <td>
                        <input type="radio" name="mumps" value="Yes" <?php echo ($mumps == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="mumps" value="No" <?php echo ($mumps == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="mumps_remarks" value="<?php echo $mumps_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Measles</td>
                    <td>
                        <input type="radio" name="measles" value="Yes" <?php echo ($measles == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="measles" value="No" <?php echo ($measles == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="measles_remarks" value="<?php echo $measles_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Diabetes</td>
                    <td>
                        <input type="radio" name="diabetes" value="Yes" <?php echo ($diabetes == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="diabetes" value="No" <?php echo ($diabetes == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="diabetes_remarks" value="<?php echo $diabetes_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Typhoid</td>
                    <td>
                        <input type="radio" name="typhoid" value="Yes" <?php echo ($typhoid == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="typhoid" value="No" <?php echo ($typhoid == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="typhoid_remarks" value="<?php echo $typhoid_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Hepatitis A</td>
                    <td>
                        <input type="radio" name="hepatitis_a" value="Yes" <?php echo ($hepatitis_a == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="hepatitis_a" value="No" <?php echo ($hepatitis_a == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="hepatitis_a_remarks" value="<?php echo $hepatitis_a_remarks; ?>"></td>
                </tr>
                <tr>
                    <td>Rabies</td>
                    <td>
                        <input type="radio" name="rabies" value="Yes" <?php echo ($rabies == 'Yes') ? 'checked' : ''; ?>> Yes
                        <input type="radio" name="rabies" value="No" <?php echo ($rabies == 'No') ? 'checked' : ''; ?>> No
                    </td>
                    <td><input type="text" name="rabies_remarks" value="<?php echo $rabies_remarks; ?>"></td>
                </tr>
            </table>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

