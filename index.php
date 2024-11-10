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
    
        <div class="container-fluid">

            <div class="row justify-content-center align-items-center hero-section">
                <div class="col-sm-12 col-md-6 order-md-2 text-center">
                    <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner cls" style="height: 400px;">
                            <div class="carousel-item active">
                                <img src="./Images/449334704_871994021614148_7158172659211129120_n.jpg" class="d-block w-100" style="height: 100%; object-fit: scale-down;" alt="Grazing Table">
                            </div>
                            <div class="carousel-item">
                                <img src="./Images/449473472_875921777888039_5649172930367983998_n.jpg" class="d-block w-100" style="height: 100%; object-fit: scale-down;" alt="Fries">
                            </div>
                            <div class="carousel-item">
                                <img src="./Images/liempo.jpg" class="d-block w-100" style="height: 100%; object-fit: scale-down;" alt="Fries">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next ar" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 order-md-1 text-center text-md-left">
                    <h2>Want to try Shin's at the comfort of your home?</h2>
                    <p>
                        Enjoy free delivery within the Barangay Tugatog area.
                        Order now and savor the refreshing taste of Shin's!
                    </p>
                    <br>
                    <a href="products.php" class="btn btn-primary">Check Our Menu</a>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10 col-lg-11">
                    <div class="card " style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
                        <div class="card-body">
                                <h1 class="card-title">Our Mission</h1>
                                <p class="card-text">
                                
                                At Shin's Funtea Habit, our mission is to bring joy and satisfaction to every meal. Starting from our humble beginnings as a small shake stall, we have grown into a beloved local eatery by continuously expanding our menu and enhancing our offerings. We are committed to serving a wide variety of delicious food and drinks in a welcoming, homey environment. Through our dine-in service and Shin's Grazing Table catering, we aim to create memorable dining experiences for our community, one meal at a time. Our dedication to quality, innovation, and exceptional service drives us to exceed our customers' expectations and make every visit a delightful experience.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <br>

            <?php
                
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch images from database for products
                $sql_products = "SELECT image FROM gallery WHERE Category='products'";
                $result_products = $conn->query($sql_products);

                // Query to fetch images from database for customers
                $sql_customers = "SELECT image FROM gallery WHERE Category='customer'";
                $result_customers = $conn->query($sql_customers);
                echo '<h1>Gallery</h1>';
                echo '<div class="container mt-5">';
                echo '<div class="row">';

                // Products Carousel
                echo '<div class="col-md-6">';
                if ($result_products->num_rows > 0) {
                    echo '<h1 class="text-center">Products</h1>';
                    echo '<div id="productCarousel" class="carousel slide" data-bs-ride="carousel">';
                    echo '<div class="carousel-inner">';

                    $active_class = 'active';
                    while($row = $result_products->fetch_assoc()) {
                        echo '<div class="carousel-item ' . $active_class . '">';
                        echo '<img src="./Images/Gallery/' . htmlspecialchars($row["image"]) . '" class="d-block w-100 rounded" style="height: 600px; object-fit: cover;" alt="Product Image">';
                        echo '</div>';
                        $active_class = '';
                    }

                    echo '</div>';
                    echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">';
                    echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                    echo '<span class="visually-hidden">Previous</span>';
                    echo '</button>';
                    echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">';
                    echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                    echo '<span class="visually-hidden">Next</span>';
                    echo '</button>';
                    echo '</div>';
                } else {
                    echo "<h2 class='text-center'>No products found.</h2>";
                }
                echo '</div>'; // End of col-md-6 for products

                // Customers Carousel
                echo '<div class="col-md-6">';
                if ($result_customers->num_rows > 0) {
                    echo '<h1 class="text-center">Customers</h1>';
                    echo '<div id="customerCarousel" class="carousel slide" data-bs-ride="carousel">';
                    echo '<div class="carousel-inner">';

                    $active_class = 'active';
                    while($row = $result_customers->fetch_assoc()) {
                        echo '<div class="carousel-item ' . $active_class . '">';
                        echo '<img src="./Images/Gallery/' . htmlspecialchars($row["image"]) . '" class="d-block w-100 rounded" style="height: 600px; object-fit: cover;" alt="Customer Image">';
                        echo '</div>';
                        $active_class = '';
                    }

                    echo '</div>';
                    echo '<button class="carousel-control-prev" type="button" data-bs-target="#customerCarousel" data-bs-slide="prev">';
                    echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                    echo '<span class="visually-hidden">Previous</span>';
                    echo '</button>';
                    echo '<button class="carousel-control-next" type="button" data-bs-target="#customerCarousel" data-bs-slide="next">';
                    echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                    echo '<span class="visually-hidden">Next</span>';
                    echo '</button>';
                    echo '</div>';
                } else {
                    echo "<h2 class='text-center'>No customers found.</h2>";
                }
                echo '</div>'; // End of col-md-6 for customers

                echo '</div>'; // End of row
                echo '</div>'; // End of container

                $conn->close();
                ?>    
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
