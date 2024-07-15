<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "patient_login_details";

// Create connection
$con = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection error: " . mysqli_connect_error());
}
?>
