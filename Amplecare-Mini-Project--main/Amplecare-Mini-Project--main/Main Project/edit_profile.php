<?php
session_start();
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

$ID = isset($_SESSION["ID_number"]) ? $_SESSION["ID_number"] : "";
$First_Name = isset($_SESSION["First_Name"]) ? $_SESSION["First_Name"] : "";
$Last_Name = isset($_SESSION['Last_Name']) ? $_SESSION['Last_Name'] : "";
$Email = isset($_SESSION['Email']) ? $_SESSION['Email'] : "";
$Num = isset($_SESSION['Number']) ? $_SESSION['Number'] : "";
$Pass = ""; // For security reasons, it's better not to pre-fill the password

$query = "SELECT Age, Gender, Blood_Group FROM login_details WHERE ID_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Set additional session values
    $_SESSION['Age'] = $userData['Age'];
    $_SESSION['Gender'] = $userData['Gender'];
    $_SESSION['Blood_Group'] = $userData['Blood_Group'];
}

// Close the database connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <title>Patient Profile</title>
</head>

<body>
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
                            <a href="edit_profile.php" target="_blank" class="dropdown-item">Edit Profile </a>
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
    <div id="profile">
    <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Patient Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST">
                                <div class="mb-3">
                                    <label for="photo">Photo</label>
                                    <!-- Add your photo upload mechanism here -->
                                    <input type="file" name="photo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="id">Patient Id</label>
                                    <input type="text" name="id" value="<?php echo $ID; ?>" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" value="<?php echo $First_Name; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" value="<?php echo $Last_Name; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="<?php echo $Email; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Mobile Number</label>
                                    <input type="text" name="phone" value="<?php echo $Num; ?>" class="form-control">
                                </div>
                                <!-- Password field not pre-filled for security reasons -->
                                <div class="mb-3">
                                    <label for="pass">Password</label>
                                    <input type="password" name="pass"value="........." class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="gender">Gender</label>
                                    <input type="text" name="gender" value="<?php echo $userData['Gender']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" value="<?php echo $userData['Age']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="bg">Blood Group</label>
                                    <input type="text" name="bg" value="<?php echo $userData['Blood_Group']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_student" class="btn btn-primary">
                                        Update Changes
                                    </button>
                                </div>
                            </form>
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