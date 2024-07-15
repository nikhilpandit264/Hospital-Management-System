<?php

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

// Function to send an email
function sendEmail($to, $subject, $message) {
    $headers = "From: hospitalms24@gmail.com"; 
    mail($to, $subject, $message, $headers);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $num = $_POST["number"];
    $pass = $_POST["password"];

    // Check if the mobile number already exists
    $checkQuery = "SELECT * FROM login_details WHERE number = '$num'";
    $result = $conn->query($checkQuery);
    $email_check = "SELECT * FROM login_details WHERE Email = '$email'";
    $result1 = $conn->query($email_check);

    if ($result1->num_rows > 0) {
        // Email id already exists, show alert
        echo '<script>alert("Email id already exists!");</script>';
    } elseif ($result->num_rows > 0) {
        // Mobile number already exists, show alert
        echo '<script>alert("Mobile Number already exists!");</script>';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO login_details (First_Name,Last_Name,Email,Number,password) VALUES ('$fname','$lname','$email', '$num','$pass')";
        if (isset($_POST['terms']) && $_POST['terms'] == 'on') {
            // Checkbox is checked, proceed with form processing
            if ($conn->query($sql) === TRUE) {
                // Retrieve the ID number from the database
                $userId = $conn->insert_id;

                // Compose the email message
                $emailSubject = "Successfully Registered";
                $emailMessage = "Dear $fname $lname,\n\nYou have successfully registered in HMS\n\nYour ID number is: $userId\n\nPlease be advised that the provided ID number is to be kept secure for future reference.\n\n Thank you for registering.";

                // Send the email
                sendEmail($email, $emailSubject, $emailMessage);

                echo '<script>
                alert("Registered Successfully! An email has been sent to your registered email with your ID number.")
                </script>';
            } else {
                echo '<script>
                alert("An error occurred!!") 
                </script>' . $sql . "<br>" . $conn->error;
            }
        } else {
            // Checkbox is not checked, show an error message
            echo "Please accept the terms and conditions.";
        }
    }
}

// Close the database connection
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
    <title>Sign Up</title>
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
                <form action="#" method="post">
                    <h4 class="Sign-up-heading">Sign Up</h4>
                    <label id="Signup-label">First Name*</label>
                    <input id="Signup-input" type="text" name="fname" placeholder="First Name" required>
                    <label id="Signup-label">Last Name</label>
                    <input id="Signup-input" type="text" name="lname" placeholder="Last Name">
                    <label id="Signup-label">E-Mail Address*</label>
                    <input id="Signup-input" type="email" name="email" placeholder="Enter E-mail " required>
                    <label id="Signup-label">Mobile Number*</label>
                    <input id="Signup-input" type="tel" name="number" placeholder="Mobile Number" required>
                    <label id="Signup-label">Password*</label>
                    <input id="Signup-input" type="password" name="password" class="password" placeholder="Password" required>
                    <i class="fa-solid fa-eye" id="show1-password"></i>
                    <div>
                        <input id="Signup-input" type="checkbox" name="terms">
                        <p id="terms">I agree to the <a href="">Terms & Conditions</a></p>
                    </div>
                    <button id="signup" name="signup" type="submit">Sign Up</button>
                    <p id="sin">Already have a account? <a href="login.php">Sign in</a></p>
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
    <script>
        const showPassword = document.querySelector('#show1-password')
        const passwordField = document.querySelector('.password')

        showPassword.addEventListener("click", function() {
            this.classList.toggle("fa-eye-slash");
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        })
    </script>
</body>

</html>