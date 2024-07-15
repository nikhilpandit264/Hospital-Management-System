<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];  // Make sure to hash passwords in a real-world scenario

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "patient_login_details");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to check if the user exists
    $sql = "SELECT ID_number , First_Name, Last_Name, Email,Number FROM login_details WHERE Email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User authenticated successfully
        $row = $result->fetch_assoc();
        $_SESSION["ID_number"] = $row["ID_number"];
        $_SESSION["First_Name"] = $row["First_Name"];
        $_SESSION["Last_Name"] = $row["Last_Name"];
        $_SESSION["Email"] = $row["Email"];
        $_SESSION["Number"] = $row["Number"];
        $_SESSION["Password"] = $row["Password"];
        $_SESSION["Gender"] = $row["Gender"];
        $_SESSION["Age"] = $row["Age"];
        $_SESSION["Blood_Group"] = $row["Blood_Group"];

        header("Location: profile2.php");
        exit();
    } else {
        // Invalid credentials
       echo"<script>alert('Email and password are incorrect!!')</script>";
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <title>Patient login</title>
</head>

<body>
    <div id="header" class="intro-bg">
        <div class="container">
            <div class="row">
                <div class="col-2">
                <img src="logo2.jpg"  class="logo"alt="No Image">
                </div>
                <div class="col-7">
                    <div class="nav justify-content-center">
                        <div class="nav">
                            <a href="index.php" class="nav-link white pt-3">Home</a>
                            <a href="" class="nav-link white pt-3">Services</a>
                            <a href="" class="nav-link white pt-3">About Us</a>
                            <a href="" class="nav-link white pt-3">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                <div class="dropdown">
                    <button class="mt-2 login-btn white">Log in</button>
                    <div class="dropdown-content">
                            <a href="admin_login.php" class="dropdown-item">Admin </a>
                            <a href="#" class="dropdown-item">Doctor </a>
                            <a href="patient_login.php" class="dropdown-item">Patient</a>
                        </div>
                </div>
                    <button class="mt-2 login-btn white"><a href="Signup.php" id="mlogin">Sign Up</a></button>
                </div>
            </div>
            <div class="form">
                <form method="post">
                    <h4 class="formh">Patient Login</h4>
                    <label>Email Address*</label>
                    <input type="email" name="email" placeholder="Enter Email Address" required>
                    <label>Password*</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password" required>
                    <i class="fa-solid fa-eye" id="show-password"></i>
                    <div>
                        <input id="rem" type="checkbox">Remember
                    </div>
                    <a href="forget.php" id="forget">forget Password?</a>
                    <button id="signup" type="submit">Sign in</button>
                    <p id="sin">Don't have account? <a href="Signup.php">Sign up</a></p>
                </form>
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
                    <a href="login.html" class="nav-link white footer-font-l">Login</a>
                    <a href="Signup.html" class="nav-link white footer-font-l">Sign up</a>
                    <a href="" class="nav-link white footer-font-l">Forget</a>
                    <a href="" class="nav-link white footer-font-l">Members</a>
                </div>
                <div class="col">
                    <h5 class="test-head-height white footer-font-h">HELP</h5>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>