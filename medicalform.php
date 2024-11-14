<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Examination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar Include -->
    <?php include 'sidebar.php'; ?>

    <div class="d-flex justify-content-center mt-3">
        <div class="container mt-5 p-4 bg-light rounded shadow-sm" style="max-width: 500px;">
            <h1 class="text-center mb-4">Medical Examination Form</h1>
            <form action="saveMedicalRecord.php" method="post">
                <div class="form-group mb-3">
                    <label for="blood_pressure" class="form-label">Blood Pressure</label>
                    <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" required>
                </div>
                <div class="form-group mb-3">
                    <label for="heart_rate" class="form-label">Heart Rate</label>
                    <input type="text" class="form-control" id="heart_rate" name="heart_rate" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save Medical Record</button>
            </form>
        </div>
    </div>
</body>
</html>
