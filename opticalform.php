<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optical Examination Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Optical Examination Form</h1>
        <form action="saveOpticalRecord.php" method="post">
            <!-- Add fields specific to Optical Examination here -->
            <div class="form-group">
                <label for="vision_left" class="form-label">Vision (Left Eye)</label>
                <input type="text" class="form-control" id="vision_left" name="vision_left" required>
            </div>
            <div class="form-group">
                <label for="vision_right" class="form-label">Vision (Right Eye)</label>
                <input type="text" class="form-control" id="vision_right" name="vision_right" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Optical Record</button>
        </form>
    </div>
</body>
</html>
