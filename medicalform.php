<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Examination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-card {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="container">
        <div class="card form-card">
            <h2 class="card-title text-center mb-4">Medical Examination Form</h2>
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
