<?php
include 'config.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $examination_id = $_POST['examination_id'] ?? null;

        if (!$examination_id) {
            throw new Exception("Examination ID is missing.");
        }

        // Collect data from POST request
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

        // Check if the record already exists
        $checkQuery = "SELECT id FROM immunization_history WHERE examination_id = :examination_id";
        $stmt = $conn->prepare($checkQuery);
        $stmt->execute([':examination_id' => $examination_id]);
        $exists = $stmt->fetch();

        if ($exists) {
            // Update the existing record
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
            // Insert a new record
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
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo "An error occurred while saving data. Please try again.";
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "An error occurred. Please try again.";
}
$conn = null;
?>
