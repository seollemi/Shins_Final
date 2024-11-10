<?php
include('constants.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Rardo2.css">
    <link rel="stylesheet" href="shins.css">
    <!-- Bootstrap Bundle (JS and Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

    <!-- Main content -->
    <div class="container py-3">
        <div class="container contact-section">
            <div class="row">
                <!-- Contact Us -->
                <div class="col-md-6 order-md-1">
                    <h2 class="text-uppercase mb-4" style="font-weight: 800;">Contact Us</h2>
                    <!-- PHP Email Form -->
                    <form enctype="multipart/form-data" method="POST" action="emailrev.php">
                    <div class="form-group mb-3">
                        <input class="form-control" type="text" name="sender_name" value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>" placeholder="Your Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <input class="form-control" type="email" name="sender_email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="Recipient's Email Address" required>
                    </div>

                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="subject" placeholder="Subject">
                        </div>
                        <div class="form-group mb-3">
                            <!-- Increased height for the textarea -->
                            <textarea class="form-control" name="message" placeholder="Message" style="height: 200px;"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" type="file" name="attachment" placeholder="Attachment">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="button" value="Submit">
                        </div>
                    </form>
                </div>
                <!-- Get in Touch -->
                <div class="col-md-6 order-md-2 contact-info">
                    <h2 class="text-uppercase mb-4" style="font-weight: 800;">Get in Touch</h2>
                    <p><strong>Address:</strong> 45 Aluminio Street, Tugatog, Malabon, Philippines</p>
                    <p><strong>Phone:</strong> 0917 767 2643</p>
                    <p><strong>Facebook:</strong><a href="https://www.facebook.com/Shinsfuntea"> Click here!</a></p>
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.9709057859667!2d120.96660092851462!3d14.662545196540517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b437a61cbc39%3A0xd3709624b7fc73c4!2s45%20Aluminio%20St%2C%20Manila%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1716300897318!5m2!1sen!2sph" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div style="height: 200px;"></div>
    <footer id="about-us" class="bg-white text-black text-center1 text-lg-start mt-4">
        <div class="text-center1 p-3 bg-white text-black">
            &copy; 2024 Shinsfuntea. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
