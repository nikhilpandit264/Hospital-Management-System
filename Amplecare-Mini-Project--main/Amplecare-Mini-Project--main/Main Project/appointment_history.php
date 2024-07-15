<?php
session_start();
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION['Last_Name'];

// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient_login_details";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$loggedInEmail = $_SESSION["Email"];

// Assuming you have a database table named 'appointments'
$query = "SELECT * FROM appointment WHERE Email = '$loggedInEmail'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <title>Patient Appointment History</title>
</head>

<body style="background-color:aliceblue;">
    <div id="header" class="intro-bg">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="logo2.jpg" class="logo" alt="No Image">
                </div>
                <div class="col-8">
                    <div class="nav justify-content-center">
                        <div class="nav">
                            <a href="index2.php" class="nav-link white pt-3">Home</a>
                            <a href="" class="nav-link white pt-3">Services</a>
                            <a href="" class="nav-link white pt-3">About Us</a>
                            <a href="" class="nav-link white pt-3">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dropdown">
                        <img src="user icon.webp" class="user_icon dropdown-button">
                        <div class="dropdown-content">
                            <i class="fa-solid fa-user user_icon_size"></i>
                            <span class="user_name">
                                <?php echo $First_Name, ' ', $Last_Name; ?>
                            </span>
                            <hr>
                            <a href="edit_profile.php" class="dropdown-item">Edit Profile </a>
                            <a href="appointment_history.php" class="dropdown-item">Appointmnet History </a>
                            <a href="#" class="dropdown-item">Help and Support </a>
                            <a href="logout.php" class="dropdown-item">Log out</a>
                        </div>
                        <!-- <i class="fa-solid fa-user user_icon_size"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="history">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 his">
                <div class="card deg">
                    <div class="card-header">
                        <h4>Appointment details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>S.No.</th>
                                <th>First_Name</th>
                                <th>Last_Name</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                                
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['S.No.']; ?></td>
                                    <td><?php echo $row['First_Name']; ?></td>
                                    <td><?php echo $row['Last_Name']; ?></td>
                                    <td><?php echo $row['Number']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['Department']; ?></td>
                                    <td><?php echo $row['Doctors']; ?></td>
                                    <td><?php echo $row['Date']; ?></td>
                                    <td><?php echo $row['Start_Time']; ?></td>
                                    <td><?php echo $row['Last_Time']; ?></td>
                                    <td><?php echo $row['Status']; ?></td>
                                    
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div id="footer" class="black-bg footer-height">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="" alt="LOGO">
                </div>
                <div class="col">
                    <h5 class="test-head-height white footer-font-h">COMPANY</h5>
                    <a href="" class="nav-link white footer-font-l">About</a>
                    <a href="" class="nav-link white footer-font-l">Blog</a>
                    <a href="" class="nav-link white footer-font-l">Services</a>
                    <a href="" class="nav-link white footer-font-l">Appointment</a>
                </div>
                <div class="col">
                    <h5 class="test-head-height white footer-font-h">QUICK LINKS</h5>
                    <a href="login.php" class="nav-link white footer-font-l">Login</a>
                    <a href="Signup.php" class="nav-link white footer-font-l">Sign up</a>
                    <a href="" class="nav-link white footer-font-l">Forget</a>
                    <a href="" class="nav-link white footer-font-l">Members</a>
                </div>
                <div class="col">
                    <h5 class="test-head-height white footer-font-h">HELP</h5>
                </div>
            </div>
        </div>
    </div>




</body>

</html>