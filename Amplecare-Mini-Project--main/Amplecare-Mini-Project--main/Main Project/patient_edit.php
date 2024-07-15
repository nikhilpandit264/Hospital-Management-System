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

    <title>Patient Edit</title>
</head>
<body>
<?php include('message.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Patient Details 
                            <a href="patient_details.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $student_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM login_details WHERE ID_number='$student_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="id" value="<?=$student_id;?>">

                                    <div class="mb-3">
                                        <label>First_Name</label>
                                        <input type="text" name="fname" value="<?=$student['First_Name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Last_Name</label>
                                        <input type="text" name="lname" value="<?=$student['Last_Name'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$student['Email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Mobile Number</label>
                                        <input type="text" name="phone" value="<?=$student['Number'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="pass" value="<?=$student['Password'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Gender</label>
                                        <input type="text" name="gender" value="<?=$student['Gender'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Age</label>
                                        <input type="text" name="age" value="<?=$student['Age'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Blood Group</label>
                                        <input type="text" name="bg" value="<?=$student['Blood_Group'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Update Student
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>