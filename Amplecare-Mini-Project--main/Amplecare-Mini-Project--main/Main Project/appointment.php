<?php
session_start();
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION['Last_Name'];
$Email = $_SESSION['Email'];
$Num = $_SESSION['Number'];

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

// Function to check doctor availability on the selected date and start time
function checkAvailability($selectedDoctor, $selectedDate, $selectedStartTime, $selectedEndTime)
{
    global $conn;

    // Check if the selected doctor has an appointment within the specified time range
    $availabilityQuery = "SELECT * FROM appointment WHERE Doctors='$selectedDoctor' AND Date='$selectedDate' 
                          AND NOT (Last_Time <= '$selectedStartTime' OR Start_Time >= '$selectedEndTime')";

    $availabilityResult = $conn->query($availabilityQuery);

    if ($availabilityResult === FALSE) {
        // Handle query execution error
        return array("error" => "Error executing query: " . $conn->error);
    }

    if ($availabilityResult->num_rows > 0) {
        return array("error" => "Selected time range is not available for the chosen doctor.");
    } else {
        return array("success" => "Selected time range is available.");
    }
}


// Fetch doctors from the database based on the selected department
$doctors = array(); // Initialize an array to store doctors
$selectedDepartment = ""; // Initialize the variable outside the if block
$sql = ""; // Initialize the variable outside the if block

if (isset($_POST['department'])) {
    $selectedDepartment = mysqli_real_escape_string($conn, $_POST['department']);
    $sql = "SELECT Name FROM doctors WHERE Department = '$selectedDepartment'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if any doctors are found
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row['Name'];
            }
        } else {
            $doctors[] = "No doctors found for the selected department";
        }
    } else {
        $doctors[] = "Error executing query: " . $conn->error;
    }
}
// Include additional debugging information
$doctors[] = "Selected Department: " . $selectedDepartment;
$doctors[] = "SQL Query: " . $sql;
// Function to check doctor availability on the selected date

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $num = mysqli_real_escape_string($conn, $_POST["number"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $dep = mysqli_real_escape_string($conn, $_POST["department"]);
    $doc = mysqli_real_escape_string($conn, $_POST["doctor"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $stime = mysqli_real_escape_string($conn, $_POST["stime"]);
    $etime = mysqli_real_escape_string($conn, $_POST["etime"]);
    $availabilityCheck = checkAvailability($doc, $date, $stime, $etime);

    if (isset($availabilityCheck["error"])) {
        echo '<script>alert("' . $availabilityCheck["error"] . '");</script>';
    } else {
        // Continue with inserting data into the database

        // Insert data into the database
        $sql = "INSERT INTO appointment (First_Name, Last_Name, Number, Email,Department,Doctors, Date, Start_Time,Last_Time) VALUES ('$fname','$lname','$num', '$email','$dep','$doc','$date','$stime','$etime')";

        if ($conn->query($sql) === TRUE) {
            // Send email
            $to = $email;
            $subject = 'Your Appointment Request - Confirmation Pending';
            $message = "Dear $fname $lname,\n\n Date: $date Time: $stime and $etime\n\nThank you for submitting your appointment request through our platform. We appreciate your interest in scheduling a meeting with us.\n\nPlease be informed that your appointment request is currently under review. Our team is diligently assessing the details provided to ensure that we can accommodate your preferred date and time. Once your appointment is confirmed, you will receive a follow-up email with all the necessary information, including the confirmed date, time, and any additional instructions.\nPlease note that confirmation emails will be sent exclusively to the email address you provided during the appointment form submission. If you have any concerns or need to make changes to your appointment details, please respond to this email or contact us at hospitalms24@gmail.com. We look forward to serving you and appreciate your patience during this process.\n\nBest regards,\nHMS";
            $headers = 'From: hospitalms24@gmail.com'; // Replace with your email

            if (mail($to, $subject, $message, $headers)) {
                echo '<script>alert("Successfully registered for appointment and confirmation email sent!");</script>';
            } else {
                echo '<script>alert("Successfully registered for appointment, but failed to send confirmation email!");</script>';
            }
        } else {
            echo '<script>alert("An error occurred!");</script>' . $sql . "<br>" . $conn->error;
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
    <title>Book Appointment</title>
</head>

<body>
    <div id="header" class="intro-bg">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="logo2.jpg" class="logo" alt="No Image">
                </div>
                <div class="col-7">
                    <div class="nav justify-content-center">
                        <div class="nav">
                            <a href="index2.php" class="nav-link white pt-3">Home</a>
                            <a href="" class="nav-link white pt-3">Services</a>
                            <a href="" class="nav-link white pt-3">About Us</a>
                            <a href="" class="nav-link white pt-3">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="dropdown">
                        <img src="user icon.webp" class="user_icon dropdown-button">
                        <div class="dropdown-content">
                            <i class="fa-solid fa-user user_icon_size"></i>
                            <span class="user_name"> <?php echo $First_Name, ' ', $Last_Name; ?></span>
                            <hr>
                            <a href="#" target="_blank" class="dropdown-item">Edit Profile </a>
                            <a href="#" class="dropdown-item">Appointmnet History </a>
                            <a href="#" class="dropdown-item">Help and Support </a>
                            <a href="index.php" class="dropdown-item">Log out</a>
                        </div>
                        <!-- <i class="fa-solid fa-user user_icon_size"></i> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-4 white-bg appt-form">
                        <form action="#" method="post" class="ap-form" onsubmit="return validateForm();">
                            <div class="form-group">
                                <h3 class="appt-heading">Book Your Appointment</h3>
                                <p class="appt-msg">Online appointment form</p>
                                <div class="row">
                                    <div class="col-5">
                                        <label>First Name*</label>
                                        <input class=" default" type="text" name="fname" value="<?php echo $First_Name; ?>" readonly>
                                    </div>
                                    <div class="col-5">
                                        <label>Last Name</label>
                                        <input class=" default" type=" text" name="lname" value="<?php echo $Last_Name; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Mobile Number*</label>
                                        <input class=" default" type=" tel" name="number" value="<?php echo $Num; ?>" readonly>
                                    </div>
                                    <div class="col-5">
                                        <label>E-mail Address*</label>
                                        <input class=" default" type=" email" name="email" value="<?php echo $Email; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Department*</label>
                                        <select class="form-control sel" name="department" id="department" onchange="updateDoctors();" required>
                                            <option value="choose">Choose Department</option>
                                            <option value="General">General</option>
                                            <option value="Orthopedics">Orthopedics</option>
                                            <option value="Psychiatry">Psychiatry</option>
                                            <option value="Neurology">Neurology</option>
                                            <option value="Cardiothoracic">Cardiothoracic</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label>Doctor*</label>
                                        <select class="form-control sel" name="doctor" id="doctor" required>
                                            <!-- Options will be populated dynamically based on the selected department -->
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Appointment Date*</label>
                                        <input class="form-control" type="date" name="date" placeholder="DD/MM/YYYY" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Start Time*</label>
                                        <input class="form-control" type="time" name="stime" onchange="autoFillEndTime();" required>
                                    </div>
                                    <div class="col-5">
                                        <label>End Time*</label>
                                        <input class="form-control" type="time" name="etime" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button id="appt-btn" type="submit">Book Appointment</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <img src="appointment_img.svg" class="appt_img">
            </div>
        </div>
    </div>
    </div>
    </div>
    </form>
    <script>
        // Function to update doctors based on the selected department
        function updateDoctors() {
            var selectedDepartment = document.getElementById("department").value;
            var doctorDropdown = document.getElementById("doctor");
            doctorDropdown.innerHTML = "";

            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var doctors = JSON.parse(this.responseText);

                    if (doctors.length > 0) {
                        for (var i = 0; i < doctors.length; i++) {
                            var option = document.createElement("option");
                            option.text = doctors[i];
                            option.value = doctors[i];
                            doctorDropdown.add(option);
                        }
                    } else {
                        var option = document.createElement("option");
                        option.text = "No doctors found for the selected department";
                        option.value = "";
                        doctorDropdown.add(option);
                    }
                }
            };

            xhttp.open("GET", "get_doctors.php?department=" + selectedDepartment, true);
            xhttp.send();
        }

        // Event listener for when a doctor is selected
        document.getElementById("doctor").addEventListener("change", function() {
            var selectedDoctor = this.value;

            // Make an AJAX request to get the doctor's start and end times
            var doctorTimeXhttp = new XMLHttpRequest();

            doctorTimeXhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var doctorTimeData = JSON.parse(this.responseText);
                    var startTimeInput = document.getElementsByName("stime")[0];
                    var endTimeInput = document.getElementsByName("etime")[0];

                    if (doctorTimeData.hasOwnProperty("error")) {
                        // Handle the case where there's an error in the doctor's time data
                        // You can display a message or take appropriate action
                    } else {
                        var doctorStartTime = doctorTimeData.start_time;
                        var doctorEndTime = doctorTimeData.end_time;

                        // Populate available times based on doctor's start and end times
                        populateAvailableTimes(startTimeInput, doctorStartTime, doctorEndTime);
                        // Automatically set end time with a 30-minute gap
                        autoFillEndTime();
                    }
                }
            };

            doctorTimeXhttp.open("POST", "get_doctor_time.php", true);
            doctorTimeXhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            doctorTimeXhttp.send("doctor=" + selectedDoctor);
        });

        // Function to populate available times in the time dropdown
        function populateAvailableTimes(timeDropdown, startTime, endTime) {
            // ... (previous code remains unchanged)
        }

        // Updated function to automatically fill end time with a 30-minute gap based on start time
        function autoFillEndTime() {
            var startTimeInput = document.getElementsByName("stime")[0];
            var endTimeInput = document.getElementsByName("etime")[0];

            var startHour = parseInt(startTimeInput.value.split(":")[0], 10);
            var startMinute = parseInt(startTimeInput.value.split(":")[1], 10);

            var endMinute = (startMinute + 30) % 60;
            var endHour = startHour + Math.floor((startMinute + 30) / 60);

            endTimeInput.value = ('00' + endHour).slice(-2) + ':' + ('00' + endMinute).slice(-2);
        }

        // Function to validate the form before submission
        // Function to validate the form before submission
        function validateForm() {
            // Get selected start time
            var selectedStartTime = getTimeValue("stime");

            // Adjust these values based on the doctor's start and end time
            var doctorStartTime = "08:00"; // Adjust to the doctor's start time
            var doctorLastTime = "17:30"; // Adjust to the doctor's last time

            // Check if the selected time falls within the doctor's working hours
            if (selectedStartTime < doctorStartTime || selectedStartTime > doctorLastTime) {
                alert("Selected time slot is not available. Please choose a time within the doctor's working hours.");
                return false;
            }

            // Enable or disable the submit button based on the validation result
            var submitButton = document.getElementById("appt-btn");
            submitButton.disabled = (selectedStartTime < doctorStartTime || selectedStartTime > doctorLastTime);

            // Check appointment availability for the selected date and time range
            var availabilityXhttp = new XMLHttpRequest();
            availabilityXhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        var availabilityData = JSON.parse(this.responseText);

                        if (availabilityData.hasOwnProperty("error")) {
                            // Handle the case where there's an error in availability data
                            // You can display a message or take appropriate action
                            alert(availabilityData["error"]);
                        } else {
                            // Slot is available, proceed with the form submission
                            document.forms[0].submit(); // Submit the form
                        }
                    } else {
                        // Handle HTTP error if needed
                        alert("Error checking availability. Please try again.");
                    }
                }
            };

            var selectedDoctor = document.getElementById("doctor").value;
            var selectedDate = document.getElementsByName("date")[0].value;
            var selectedStartTime = document.getElementsByName("stime")[0].value;

            availabilityXhttp.open("POST", "appointment.php", true);
            availabilityXhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            availabilityXhttp.send("doctor=" + selectedDoctor + "&date=" + selectedDate + "&startTime=" + selectedStartTime);

            // Prevent the form from being submitted here
            return false;
        }
    </script>



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