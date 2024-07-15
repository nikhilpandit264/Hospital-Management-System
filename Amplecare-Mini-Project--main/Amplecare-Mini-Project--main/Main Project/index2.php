<?php
session_start();
$First_Name = $_SESSION["First_Name"];
$Last_Name = $_SESSION['Last_Name'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <title>Hospital Management System</title>
</head>

<body>
    <div id="header" class="intro-bg">
        <div class="container">
            <div class="row">
                <div class="col-2">
                <img src="logo2.jpg"  class="logo"alt="No Image">
                </div>
                <div class="col-8">
                    <div class="nav justify-content-center">
                        <div class="nav">
                            <a href="index2.php" class="nav-link white pt-3">Home</a>
                            <a href="" class="nav-link white pt-3">Services</a>
                            <a href="" class="nav-link white pt-3">About Us</a>
                            <a href="" class="nav-link white pt-3">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dropdown">
                        <img src="user icon.webp" class="user_icon dropdown-button">
                        <div class="dropdown-content">
                            <i class="fa-solid fa-user user_icon_size"></i>
                            <span class="user_name">
                                <?php echo $First_Name, ' ', $Last_Name; ?>
                            </span>
                            <hr>
                            <a href="edit_profile.php" class="dropdown-item">Edit Profile </a>
                            <a href="appointment_history.php" class="dropdown-item">Appointmnet History </a>
                            <a href="#" class="dropdown-item">Help and Support </a>
                            <a href="logout.php" class="dropdown-item">Log out</a>
                        </div>
                        <!-- <i class="fa-solid fa-user user_icon_size"></i> -->
                    </div>


                </div>
            </div>
            <div class="container">
                <div class="row margin-top">
                    <div class="col-6">
                        <h3 id="intro_content" class="white">We provide <span class="blue">medical</span> services that you
                            can <span class="blue">trust!</span></h3>
                        <p class="mt-4 white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus corrupti
                            neque laudantium
                            provident reiciendis porro necessitatibus hic eos earum cumque. Vero nam fuga odit, porro ipsam
                            architecto repudiandae vitae blanditiis.
                        </p>
                        <button class="mt-4 start-btn">Get Started</button>
                        <a href="appointment.php"><button class="mt-4 apt-btn">Get Appointment</button></a>
                    </div>
                    <div class="col-4">
                        <img class="intro-img" src="banner.webp" alt="No Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="services" class="wheat ser-height">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <p class="ser-top">OUR SERVICES</p>
                    <h5 class="services">We are always ready to help you & your family</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus tempore autem numquam sequi
                        placeat</p>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col ser-box">
                            <img src="" alt="No Image" class="ser-top">
                            <h5>General Treatment</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, reiciendis!</p>
                        </div>
                        <div class="col ser-box">
                            <img src="" alt="No Image" class="ser-top">
                            <h5>Ear Treatment</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, reiciendis!</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col ser-box">
                            <img src="" alt="No Image">
                            <h5>General Treatment</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, reiciendis!</p>
                        </div>
                        <div class="col ser-box">
                            <img src="" alt="No Image">
                            <h5>Ear Treatment</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, reiciendis!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="testimonial" class="test-height">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <p class="test-head-height">TESTIMONIAL</p>
                    <h2 class="test-font">What our patients say about our <br> medical treatments</h2>
                </div>
            </div>
            <div class="row review-margin">
                <div class="col">
                    <img src="5star.jpg" alt="Star loading" class="star">
                    <p>"I was impressed with how beautiful and clean this property was. The owner definitely goes the
                        extra mile to help their guests!"
                    </p>
                    <p class="test-font">Adam Hall</p>
                    <p>Lisbon, Portugal</p>
                </div>
                <div class="col">
                    <img src="5star.jpg" alt="Star loading" class="star">
                    <p>"I was impressed with how beautiful and clean this property was. The owner definitely goes the
                        extra mile to help their guests!"
                    </p>
                    <p class="test-font">Adam Hall</p>
                    <p>Lisbon, Portugal</p>
                </div>
                <div class="col">
                    <img src="5star.jpg" alt="Star loading" class="star">
                    <p>"I was impressed with how beautiful and clean this property was. The owner definitely goes the
                        extra mile to help their guests!"
                    </p>
                    <p class="test-font">Adam Hall</p>
                    <p>Lisbon, Portugal</p>
                </div>
            </div>
        </div>
    </div>
    <div id="news" class="wheat news-height">
        <div class="container">
            <div class="row text-center">
                <p class="test-head-height">LATEST NEWS</p>
                <h2 class="test-font">Keep up with our most recent <br>medical news</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, voluptatem.</p>
            </div>
            <div class="row review-margin mg">
                <div class="col">
                    <div class="white-bg news-box">
                        <img src="news1.webp" alt="Loading" class="news-img">
                        <p class="text-pd bg">News</p>
                        <h5 class="text-pd">Things most people don't konw about mediacal clinic</h5>
                        <p class="text-pd">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus minima, sint eligendi
                            voluptate nemo temporibus id voluptatibus aspernatur sed optio quod provident, repellat hic
                            fugit magnam ex et dolore inventore?
                        </p>
                        <div class="row">
                            <div class="col-3">
                                <img src="user icon.webp" alt="person" class="news-user">
                            </div>
                            <div class="col">
                                <p class="test-font">kelly Thomas</p>
                                <p class="ad-font">March 12 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="white-bg news-box">
                        <img src="news2.webp" alt="Loading" class="news-img">
                        <p class="text-pd bg">News</p>
                        <h5 class="text-pd">Things most people don't konw about mediacal clinic</h5>
                        <p class="text-pd">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus minima, sint eligendi
                            voluptate nemo temporibus id voluptatibus aspernatur sed optio quod provident, repellat hic
                            fugit magnam ex et dolore inventore?
                        </p>
                        <div class="row">
                            <div class="col-3">
                                <img src="user icon.webp" alt="person" class="news-user">
                            </div>
                            <div class="col">
                                <p class="test-font">kelly Thomas</p>
                                <p class="ad-font">March 12 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="white-bg news-box">
                        <img src="nrews3.webp" alt="Loading" class="news-img">
                        <p class="text-pd bg">News</p>
                        <h5 class="text-pd">Things most people don't konw about mediacal clinic</h5>
                        <p class="text-pd">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus minima, sint eligendi
                            voluptate nemo temporibus id voluptatibus aspernatur sed optio quod provident, repellat hic
                            fugit magnam ex et dolore inventore?
                        </p>
                        <div class="row">
                            <div class="col-3">
                                <img src="user icon.webp" alt="person" class="news-user">
                            </div>
                            <div class="col">
                                <p class="test-font">kelly Thomas</p>
                                <p class="ad-font">March 12 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
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