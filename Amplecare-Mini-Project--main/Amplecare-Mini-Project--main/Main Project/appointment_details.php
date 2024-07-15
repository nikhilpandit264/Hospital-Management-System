<?php
$con = mysqli_connect("localhost", "root", "", "patient_login_details");
if (!$con) {
    die("Connection error");
}

function sendConfirmationEmail($email, $date, $time)
{
    $to = $email;
    $subject = "Appointment Confirmation";
    $message = "Dear Patient,\n\nYour appointment has been confirmed for the following details:\n\nDate: $date\nTime: $time\n\nWe look forward to seeing you.\n\nSincerely,\nThe Appointment System";

    $headers = "From: hospitalms24@gmail.com"; // Replace with your email address

    // Use the mail() function to send the email
    mail($to, $subject, $message, $headers);
}

function sendCancellationEmail($email)
{
    $to = $email;
    $subject = "Appointment Cancellation";
    $message = "Dear Patient,\n\nYour appointment has been cancelled. We apologize for any inconvenience caused.\n\nSincerely,\nThe Appointment System";

    $headers = "From: hospitalms24@gmail.com"; // Replace with your email address

    // Use the mail() function to send the email
    mail($to, $subject, $message, $headers);
}

function sendUpdateConfirmationEmail($email, $newDate, $newTime)
{
    $to = $email;
    $subject = "Appointment Update Confirmation";
    $message = "Dear Patient,\n\nYour appointment has been updated. Your new date and time are as follows:\n\nDate: $newDate\nTime: $newTime\n\nSincerely,\nThe Appointment System";

    $headers = "From: hospitalms24@gmail.com"; // Replace with your email address

    // Use the mail() function to send the email
    mail($to, $subject, $message, $headers);
}

if (isset($_POST['cancel'])) {
    // Handle cancellation logic here
    $appointmentId = $_POST['cancel'];

    // Fetch the email address associated with the appointment
    $emailQuery = "SELECT Email FROM appointment WHERE `S.No.` = $appointmentId";
    $emailResult = mysqli_query($con, $emailQuery);

    if ($emailResult && $emailRow = mysqli_fetch_assoc($emailResult)) {
        $patientEmail = $emailRow['Email'];

        // Send cancellation email
        sendCancellationEmail($patientEmail);

        // Update the status to 'Cancelled'
        $cancelQuery = "UPDATE appointment SET Status = 'Cancelled' WHERE `S.No.` = $appointmentId";
        mysqli_query($con, $cancelQuery);

    }
} elseif (isset($_POST['update'])) {
    // Handle update logic here
    $appointmentId = $_POST['update'];
    $updateQuery = "SELECT * FROM appointment WHERE `S.No.` = $appointmentId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult && $updateRow = mysqli_fetch_assoc($updateResult)) {
        // Show the form for updating date and time
        include"update_form.php";
?>
        <!-- <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="index.css">
            <link rel="stylesheet" href="bootstrap.css">
            <title>Update Appointment</title>
        </head>

        <body>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Appointment</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="">
                                    <input type="hidden" name="update_confirm" value="<?php echo $updateRow['S.No.']; ?>">
                                    <div class="mb-3">
                                        <label for="new_date" class="form-label">New Date</label>
                                        <input type="date" class="form-control" id="new_date" name="new_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_time" class="form-label">New Time</label>
                                        <input type="time" class="form-control" id="new_time" name="new_time" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html> -->
<?php
    }
} elseif (isset($_POST['update_confirm'])) {
    // Handle update confirmation logic here
    $appointmentId = $_POST['update_confirm'];
    $newDate = $_POST['new_date'];
    $newTime = $_POST['new_time'];

    // Fetch the email address associated with the appointment
    $emailQuery = "SELECT Email FROM appointment WHERE `S.No.` = $appointmentId";
    $emailResult = mysqli_query($con, $emailQuery);

    if ($emailResult && $emailRow = mysqli_fetch_assoc($emailResult)) {
        $patientEmail = $emailRow['Email'];

        // Send update confirmation email
        sendUpdateConfirmationEmail($patientEmail, $newDate, $newTime);

        // Update the date and time
        $updateQuery = "UPDATE appointment SET Date = '$newDate', Time = '$newTime', Status = 'Active' WHERE `S.No.` = $appointmentId";
        mysqli_query($con, $updateQuery);
    }
} elseif (isset($_POST['confirm'])) {
    // Handle confirmation logic here
    $appointmentId = $_POST['confirm'];

    // Fetch the email address and appointment details
    $emailQuery = "SELECT Email, Date, Start_Time,Last_Time FROM appointment WHERE `S.No.` = $appointmentId";
    $emailResult = mysqli_query($con, $emailQuery);

    if ($emailResult && $emailRow = mysqli_fetch_assoc($emailResult)) {
        $patientEmail = $emailRow['Email'];
        $confirmationDate = $emailRow['Date'];
        $confirmationTime = $emailRow['Start_Time'];

        // Send confirmation email with date and time details
        sendConfirmationEmail($patientEmail, $confirmationDate, $confirmationTime);

        // Update the status to 'Active'
        $confirmQuery = "UPDATE appointment SET Status = 'Active' WHERE `S.No.` = $appointmentId";
        mysqli_query($con, $confirmQuery);
    }
}
if (isset($_POST['complete'])) {
    // Handle completion logic here
    $appointmentId = $_POST['complete'];

    // Fetch the email address associated with the appointment
    $emailQuery = "SELECT Email FROM appointment WHERE `S.No.` = $appointmentId";
    $emailResult = mysqli_query($con, $emailQuery);

    if ($emailResult && $emailRow = mysqli_fetch_assoc($emailResult)) {
        $patientEmail = $emailRow['Email'];

        // Add your logic for completing the appointment, e.g., sending a completion email

        // Update the status to 'Completed'
        $completeQuery = "UPDATE appointment SET Status = 'Completed' WHERE `S.No.` = $appointmentId";
        mysqli_query($con, $completeQuery);
    }
}

$query = "SELECT * FROM appointment";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="index.css"> -->
    <link rel="stylesheet" href="bootstrap.css">
    <title>Display appointment details</title>
    <style>
        .btn-at{
            width: 95px;
    margin: 0px -6px 0px 11px;
        }
        .a{
            display: flex;
            margin-right: -20px;
        }
        #topbar {
            background-color: #f3f1f1;
            padding: 10px;
            color: blue;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 84%;
            top: 0;
            height: 47px;
            z-index: 1;
            margin: 7px 0px 0px 216px;
            border-radius: 9px;
        }

        #main-title {
            font-size: 20px;
        }

        #logo-icon {
            cursor: pointer;
        }

        #sidebar {
            height: 100%;
            width: 203px;
            position: fixed;
            background-color: #414d9d;
            padding-top: 20px;
            margin: -24px 0px 0px 0px;
        }

        #sidebar a {
            margin: 37px 2px 3px 49px;
            text-decoration: none;
            font-size: 17px;
            color: white;
            font-weight: 100;
            display: block;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }

        #content {
            margin-top: 75px;
            margin-left: 272px;
            padding: 16px;
            position: relative;
            overflow-y: auto;
        }
        .deg{
            margin: 110px -93px 1px 134px;
        }
    </style>
</head>

<body style="background-color: #e3dbdb;">
<div id="topbar">
        <div id="main-title">Admin Page</div>
        <div id="logo-icon" onclick="toggleLogin()">👤</div>
    </div>
    <div id="sidebar">
        <a href="admin.php" onclick="showContent('home.php')">Home</a>
        <a href="#" onclick="showContent('patient_details.php')">Patient</a>
        <a href="#" onclick="showContent('doctor_details.php')">Doctor</a>
        <a href="#" onclick="showContent('appointment_details.php')">Appointment</a>
        <a href="#" onclick="showContent('help.php')">Help</a>
        <a href="#" onclick="logout()">Logout</a>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
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
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>Last Time</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                    <td><?php echo $row['Date']; ?></td>
                                    <td><?php echo $row['Start_Time']; ?></td>
                                    <td><?php echo $row['Last_Time']; ?></td>
                                    <td><?php echo $row['Status']; ?></td>
                                    <td>
                                        <div class="a">
                                        <?php
                                                if ($row['Status'] == 'Pending') {
                                                ?>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="cancel" value="<?php echo $row['S.No.']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-at">Cancel</button>
                                                    </form>
                                                <?php
                                                }
                                                if ($row['Status'] == 'Pending') {
                                                ?>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="update" value="<?php echo $row['S.No.']; ?>">
                                                        <button type="submit" class="btn btn-warning btn-at">Update</button>
                                                    </form>
                                                <?php
                                                }
                                                if ($row['Status'] == 'Pending' ) {
                                                ?>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="confirm" value="<?php echo $row['S.No.']; ?>">
                                                        <button type="submit" class="btn btn-success btn-at">Confirm</button>
                                                    </form>
                                                <?php
                                                }
                                                if ($row['Status'] == 'Active') {
                                                ?>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="complete" value="<?php echo $row['S.No.']; ?>">
                                                        <button type="submit" class="btn btn-primary btn-at">Complete</button>
                                                    </form>
                                                <?php
                                                }
                                                ?>
                                        </div>
                                        
                                    </td>
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
</body>