<?php 
include('constants.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shin's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="shins.css">

    <style>
        .icon-cart{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        position: relative;
        margin-left: auto;
    }
    
    </style>
</head>
<body>
<nav class="sticky-nav">
    <ul class="sidebar">
            <li onclick="closeSB()"><a><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="products.php">Menu</a></li>
            <li><a href="personnel.php">Personnel</a></li>
            <li><a href="ContactUs.php">Contact us</a></li>
            <li><a href="reviews_blog.php">Reviews</a></li>
        </ul>

        <ul>
            <li class="logo-and-text">
                <img src="./Images/shin logo.jpg" alt="">
            </li>
            <li class="hideOnMobile"><a href="index.php">Home</a></li>
            <li class="hideOnMobile"><a href="about.php">About us</a></li>
            <li class="hideOnMobile"><a href="products.php">Menu</a></li>
            <li class="hideOnMobile"><a href="personnel.php">Personnel</a></li>
            <li class="hideOnMobile"><a href="ContactUs.php">Contact us</a></li>
            <li class="hideOnMobile"><a href="reviews_blog.php">Reviews</a></li>
            <li class="hideOnMobile"><a href="Order_status.php">Order Status</a></li>
            <?php 
                if(!isset($_SESSION["username"])){ // Check if the user session is not set
                ?>
                    <li class="icon-cart"><a href="login.php">Login</a></li>
                <?php 
                } else { // If the user session is set
                ?>
                    <li class="icon-cart"><a href="logout.php" onclick="return confirmLogout()">Logout</a></li>
                <?php 
                } 
                ?>
                <script>
                function confirmLogout() {
                    return confirm("Are you sure you want to log out?");
                }
                </script>

                
                <li class="hideOnMobile"><a href="Profile_edit.php">Profile</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <div class="container-fluid mt-4 col-lg-11">
        <div class="content1">
            
            <section class="about-us">
                <h1>About Us</h1>
                <p>
                    Welcome to Shin's Funtea Habit! <br><br>
                    At Shin's Funtea Habit, we serve a variety of delicious ricemeals, refreshing drinks (including coffee, frappes, shakes, and cold beverages), and tasty snacks. Our fast-food restaurant is dedicated to providing great food and excellent service in a welcoming atmosphere.
                    Planning a special event? Look no further than Shin's Grazing Table, our exclusive catering service. Whether it's a birthday party, corporate event, or a casual gathering with friends, Shin's Grazing Table brings the same passion for great food and excellent service to your event, ensuring a spread that's as beautiful as it is delicious. <br>
                    Join us at Shin's Funtea Habit for a delightful dining experience. We look forward to serving you!
                </p>
            </section>
            <section class="mission">
                <h1>Our Mission</h1>
                <p>
                    At Shin's Funtea Habit, our mission is to bring joy and satisfaction to every meal. Starting from our humble beginnings as a small shake stall, we have grown into a beloved local eatery by continuously expanding our menu and enhancing our offerings. We are committed to serving a wide variety of delicious food and drinks in a welcoming, homey environment. Through our dine-in service and Shin's Grazing Table catering, we aim to create memorable dining experiences for our community, one meal at a time. Our dedication to quality, innovation, and exceptional service drives us to exceed our customers' expectations and make every visit a delightful experience.
                </p>
            </section>
            <section class="history">
                <h1>History</h1>
                <p>
                    From a small shake stall to a beloved local fast-food spot, Shin's Funtea Habit has grown thanks to our commitment to quality and passion for delightful food. Now offering a diverse menu and cozy dine-in space, we've expanded into catering with Shin's Grazing Table, delighting customers at events. Grateful for the support, we're excited to keep serving delicious food and great service to our community.
                </p>
            </section>
                        <div class="row justify-content-center">
                            <h2>Our team</h2>
                            <div class="card mt-4 col-lg-6" style="align-content: center; padding: 10px;">
                                <img src="./Images/team.jpg" class="card-img-top" alt="...">
                            </div>
                        </div>
        </div>

    </div>


    
    <footer id="about-us" class="bg-white text-black text-center text-lg-start mt-4">
        <div class="text-center p-3 bg-white text-black">
            &copy; 2024 Shinsfuntea. All rights reserved.
        </div>
    </footer>


    <script>
        function showSidebar(){
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display ="flex";
        }
        function closeSB(){
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display ="none";
        }
        
    </script>
</body>
</html>
