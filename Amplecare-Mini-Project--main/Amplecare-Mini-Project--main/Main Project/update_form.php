<!-- update_form.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Update Appointment</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Appointment</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <input type="hidden" name="update_confirm" value="<?php echo $updateRow['S.No.']; ?>">
                            <div class="mb-3">
                                <label for="new_date" class="form-label">New Date</label>
                                <input type="date" class="form-control" id="new_date" name="new_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_time" class="form-label">New Time</label>
                                <input type="time" class="form-control" id="new_time" name="new_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
