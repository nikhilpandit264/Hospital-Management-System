<?php
// check_availability.php

session_start();

$selectedDoctor = $_POST['doctor'];
$selectedDate = $_POST['date'];
$selectedStartTime = $_POST['startTime'];
$selectedEndTime = $_POST['endTime'];

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

// Function to check doctor availability on the selected date and time range
// Function to check doctor availability on the selected date and time range
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


// Close the database connection
$conn->close();
?>
