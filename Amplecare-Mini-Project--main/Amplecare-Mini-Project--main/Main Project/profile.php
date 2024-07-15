<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="update.css">
</head>

<body>
    <div class="layout">
        <h1>Patient Profile Form</h1>
        <h2>Name </h2>
        <input type="text" name="name" placeholder="Name">
        <div class="container">

            <h2>Gender: </h2>

            <ul>
                <li>
                    <input type="radio" id="f-option" name="selector">
                    <label for="f-option">Male</label>

                    <div class="check"></div>
                </li>

                <li>
                    <input type="radio" id="s-option" name="selector">
                    <label for="s-option">Female</label>

                    <div class="check">
                        <div class="inside"></div>
                    </div>
                </li>

        </div>

        <h2>Blood Group</h2>

        <select name="selectoptions">             
	        <option >O+</option>
	        <option >O-</option>
	        <option >B+</option>
	        <option >B-</option>
	        <option >AB+</option>
	      
        </select>


        <h2>Email Address</h2>
        <input type="email" name="email" placeholder="example@mail.com">

        <h2>Phone Number</h2>
        <input type="tel" name="PhoneNO" placeholder="+91 9856XXXX78">

        <br>
        <br>
        <button class="button">Submit</button>
        <br>
        <br>

    </div>



</body>

</html>