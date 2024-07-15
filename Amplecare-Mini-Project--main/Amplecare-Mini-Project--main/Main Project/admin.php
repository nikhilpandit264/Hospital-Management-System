<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #e3dbdb;
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
            margin: -75px 0px 0px 0px;
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
    </style>
</head>

<body>

    <div id="topbar">
        <div id="main-title">Admin Page</div>
        <div id="logo-icon" onclick="toggleLogin()">👤</div>
    </div>

    <div id="sidebar">
        <a href="#" onclick="showContent('home.php')">Home</a>
        <a href="#" onclick="showContent('patient_details.php')">Patient</a>
        <a href="#" onclick="showContent('doctor_details.php')">Doctor</a>
        <a href="appointment_details.php" onclick="showContent('appointment_details.php')">Appointment</a>
        <a href="#" onclick="showContent('help.php')">Help</a>
        <a href="#" onclick="logout()">Logout</a>
    </div>

    <div id="content">
        <!-- Content will be dynamically loaded here based on user clicks -->
        <?php include("home.php");?>
    </div>

    <script>
        function showContent(contentType) {
            var contentDiv = document.getElementById('content');
            if (contentType === 'update') {
                // Handle update action (replace this with your update logic)
                contentDiv.innerHTML = '<h2>Update Action</h2>';
            } else if (contentType === 'add') {
                // Handle add action (replace this with your add logic)
                contentDiv.innerHTML = '<h2>Add Action</h2>';
            } else if (contentType === 'delete') {
                // Handle delete action (replace this with your delete logic)
                contentDiv.innerHTML = '<h2>Delete Action</h2>';
            } else {
                fetch(contentType)
                    .then(response => response.text())
                    .then(data => {
                        contentDiv.innerHTML = data;
                        // Handle links within the loaded content
                        contentDiv.querySelectorAll('a').forEach(link => {
                            link.addEventListener('click', function (event) {
                                event.preventDefault();
                                showContent(this.getAttribute('href'));
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching content:', error);
                        contentDiv.innerHTML = '<h2>Error loading content</h2>';
                    });
            }
        }

        function toggleLogin() {
            // Implement your login functionality or show a login modal
            alert('Login functionality goes here');
        }

        function logout() {
            // Implement your logout functionality
            window.location.href = 'index.php'; // Redirect to index.php
        }
    </script>

</body>

</html>
