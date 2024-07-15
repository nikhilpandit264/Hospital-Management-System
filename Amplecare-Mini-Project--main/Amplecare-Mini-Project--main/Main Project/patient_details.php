<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "patient_login_details");
if (!$con) {
    die("Connection error");
}
$query = "select * from login_details";
$result = mysqli_query($con, $query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student CRUD</title>
</head>

<body style="background-color: #e3dbdb;">
<?php include('message.php'); ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>ID number</th>
                                <th>First_Name</th>
                                <th>Last_Name</th>
                                <th>Email</th>
                                <th>Mobile number</th>
                                <th>Password</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Blood Group</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM login_details";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $student) {
                                ?>
                                        <tr>
                                            <td><?= $student['ID_number']; ?></td>
                                            <td><?= $student['First_Name']; ?></td>
                                            <td><?= $student['Last_Name']; ?></td>
                                            <td><?= $student['Email']; ?></td>
                                            <td><?= $student['Number']; ?></td>
                                            <td><?= $student['Password']; ?></td>
                                            <td><?= $student['Gender']; ?></td>
                                            <td><?= $student['Age']; ?></td>
                                            <td><?= $student['Blood_Group']; ?></td>
                                            <td>
                                                <!-- <a href="student-view.php?id=<?= $student['ID_number']; ?>" class="btn btn-info btn-sm">View</a> -->
                                                <a href="patient_edit.php?id=<?= $student['ID_number']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <form action="code.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_student" value="<?= $student['ID_number']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>