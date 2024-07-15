<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "patient_login_details");
if (!$con) {
    die("Connection error");
}
$query1 = "select * from login_details";
$result = mysqli_query($con, $query1);

if(isset($_POST['delete_student']))
{
    $student = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM login_details WHERE ID_number='$student' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Patient Deleted Successfully";
        header("Location: patient_details1.php");
        
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['id']);

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $bg = mysqli_real_escape_string($con, $_POST['bg']);

    $query = "UPDATE login_details SET First_Name='$fname', Last_Name='$lname', Email='$email', Number='$phone', Password='$pass',Gender='$gender', Age='$age', Blood_Group='$bg' WHERE ID_number='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        
        $_SESSION['message'] = "Patient Updated Successfully";
        header("Location: admin.php");
        
    }

    

}



?>