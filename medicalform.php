<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Examination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Medical Examination Form</h1>
        <form action="saveMedicalRecord.php" method="post">
            <!-- Add fields specific to Medical Examination here -->
            <div class="form-group">
                <label for="blood_pressure" class="form-label">Blood Pressure</label>
                <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" required>
            </div>
            <div class="form-group">
                <label for="heart_rate" class="form-label">Heart Rate</label>
                <input type="text" class="form-control" id="heart_rate" name="heart_rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Medical Record</button>
        </form>
    </div>
</body>
</html>
