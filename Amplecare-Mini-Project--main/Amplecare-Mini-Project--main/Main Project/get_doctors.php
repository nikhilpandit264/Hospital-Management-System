<?php
// get_doctors.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient_login_details";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['department'])) {
    $selectedDepartment = mysqli_real_escape_string($conn, $_GET['department']);
    $sql = "SELECT Name FROM doctors WHERE Department = '$selectedDepartment'";
    $result = $conn->query($sql);

    $doctors = array();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row['Name'];
        }
    }

    echo json_encode($doctors);
}


$conn->close();
?>
