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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-d7uEu3o8r4gZE3z9KfIScu95py+PDEx3MQyBXsMLvMxlRle1zeLp+HDF9lnNfOA3" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4285f4;
            /* Blueish background color */
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
            color: #fff;
            /* Text color */
        }
        
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        
        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: scale(1);
            transition: transform 0.3s ease-in-out;
        }
        
        /* form:hover {
            transform: scale(1.05);
        } */
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        
        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            transition: border-color 0.3s;
        }
        
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
        input:focus,
        select:focus {
            border-color: #6cb2eb;
            outline: none;
        }
        
        .icon {
            margin-right: 8px;
            color: #555;
            transition: transform 0.3s ease-in-out;
        }
        
        .icon:hover {
            transform: rotate(360deg);
        }
        /* Animation for options */
        
        select:hover option {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Complete Your Profile</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user icon"></i>First Name:
                </label>
                <input type="text" class="form-control" name="name" value="<?php echo $First_Name; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="last_name">
                    <i class="fas fa-user icon"></i>Last Name:
                </label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $Last_Name; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope icon"></i>Email:
                </label>
                <input type="email" class="form-control" name="email" value="<?php echo $Email; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="age">
                    <i class="fas fa-calendar-alt icon"></i>Age:
                </label>
                <input type="number" class="form-control" name="Age" required>
            </div>

            <div class="form-group">
                <label for="gender">
                    <i class="fas fa-venus-mars icon"></i>Gender:
                </label>
                <select class="form-control" name="Gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="blood_group">
                    <i class="fas fa-tint icon"></i>Blood Group:
                </label>
                <select class="form-control" name="Blood_Group" required>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>

            <button type="submit"  value="submit"class="btn btn-success">
                <i class="fas fa-check-circle icon"></i>Submit
            </button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need JavaScript features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Font Awesome JS (optional, if you need JavaScript features) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha384-mQZMl2zahWQ8aRfF+QrSX8nICvd9LIS5QD8vU8Tvc3b3lHwP02GwD2i/FqjsJY8" crossorigin="anonymous"></script>
</body>

</html>
