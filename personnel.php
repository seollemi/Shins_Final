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
    <link rel="stylesheet" href="ab_perso.css">
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

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

    <div class = "container">
        <div class = "content">
            <div class="slider">
                <div class="list">
                    <div class="item active" id="img1">
                        <img src="./Images/shin.jpg">
                        <div class="content">
                            <p> <span>OWNER</span> </p>
                            <h2><span>Shin Arianne Gutiérrez</span></h2>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <div class="item" id="img2">
                        <img src="./Images/elmer.jpg">
                        <div class="content">
                            <p><span>CO-OWNER</span></p>
                            <h2><span>Elmer Gutiérrez</span></h2>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <div class="item" id="img3">
                        <img src="./Images/ez.jpg">
                        <div class="content">
                            <p><span>Staff</span></p>
                            <h2><span>Ezekielle Gutiérrez</span></h2>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <div class="item" id="img4">
                        <img src="./Images/kenje.jpg">
                        <div class="content">
                            <p><span>Staff</span></p>
                            <h2><span>Kenje Dela Cruz</span></h2>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <div class="item" id="img5">
                        <img src="./Images/rey.jpg">
                        <div class="content">
                            <p><span>Staff</span></p>
                            <h2><span>Reymart Dela Cruz</span></h2>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <div class="item" id="img6">
                        <img src="./Images/james.jpg">
                        <div class="content">
                            <p><span>Staff</span></p>
                            <h2><span>James Cabarle</span></h2>
                        </div>
                    </div>
                </div>                
            
                <!-- button -->  
                <div class="arrows">
                    <button id="prev"> < </button>
                    <button id="next"> > </button>
                </div>
            
                <!-- thumbnail-->
                <div class="thumbnail">
                    <div class="item active" data-target="img1">
                        <img src="./Images/shin.jpg">
                        <div class="content">Shin</div>
                    </div>
                    <div class="item" data-target="img2">
                        <img src="./Images/elmer.jpg">
                        <div class="content">Elmer</div>
                    </div>
                    <div class="item" data-target="img3">
                        <img src="./Images/ez.jpg">
                        <div class="content">Ezekielle</div>
                    </div>
                    <div class="item" data-target="img4">
                        <img src="./Images/kenje.jpg">
                        <div class="content">Kenje</div>
                    </div>
                    <div class="item" data-target="img5">
                        <img src="./Images/rey.jpg">
                        <div class="content">Reymart</div>
                    </div>
                    <div class="item" data-target="img6">
                        <img src="./Images/james.jpg">
                        <div class="content">James</div>
                    </div>
                </div>
            </div>         
        </div> 
        <br><br><br>
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

    <script src="personell.js"></script>
</body>
</html>
