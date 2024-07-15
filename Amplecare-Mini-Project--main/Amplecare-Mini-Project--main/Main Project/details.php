<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient_login_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the session
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION['Last_Name'];
$Email = $_SESSION['Email'];

// Check if the user already exists in the database with age, blood group, and dob
$checkUserSQL = "SELECT * FROM login_details WHERE Email='$Email' AND Age IS NOT NULL AND Blood_Group IS NOT NULL";
$result = $conn->query($checkUserSQL);

if ($result->num_rows > 0) {
    // User exists with age, blood group, and dob, redirect to index2.php
    $_SESSION['form_filled'] = true;
    header("Location: index2.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Age = $_POST["Age"];
    $Gender = $_POST["Gender"];
    $BG = $_POST["Blood_Group"];

    // Check if any of the required fields are null
    if ($Age === null || $Gender === null || $BG === null) {
        echo "Please fill in all required fields.";
    } else {
        // Update user details in the database
        $updateSQL = "UPDATE login_details SET Age='$Age', Gender='$Gender', Blood_Group='$BG' WHERE Email='$Email'";

        if ($conn->query($updateSQL) === TRUE) {
            $_SESSION['form_filled'] = true;
            header("Location: index2.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
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
    <title>Profile Form</title>
</head>

<body>
    <h2>Complete Your Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">First Name:</label>
        <input type="text" name="name" value="<?php echo $First_Name; ?>" readonly><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $Last_Name; ?>" readonly><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $Email; ?>" readonly><br>

        <label for="age">Age:</label>
        <input type="number" name="Age" required><br>

         <label for="gender">Gender:</label>
        <select name="Gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br>

        <label for="blood_group">Blood Group:</label>
        <select name="Blood_Group" required>
        <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="AB+">AB+</option>
            <option value="A-">A-</option>
            <option value="B-">B-</option>
            <option value="AB-">AB-</option>
        </select><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>

