<?php

// Database configuration
include('constants.php');
// Create a connection

// Check the connection
if (!$conn) {
    die("Connection failed: ");
}
if(isset($_POST['add_to_cart_rice'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity'];
    $product_size = 'Default'; // Or any other default value indicating a single size

    $query = "SELECT * FROM cart WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $product_quantity;

        $update_query = "UPDATE cart SET quantity = ? WHERE name = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('is', $new_quantity, $product_name);
        $stmt->execute();
        echo "<script>alert('Product added to cart successfully');</script>";
    } else {
        $insert_query = "INSERT INTO cart(name, size, price, image, quantity) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ssdsi', $product_name, $product_size, $product_price, $product_image, $product_quantity);
        $stmt->execute();
        echo "<script>alert('Product added to cart successfully');</script>";
    }

    // Close the statement and connection if necessary
    $stmt->close();
}

if(isset($_POST['add_to_cart_fp'])){

    $product_name = $_POST['product_name'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['quantity'];
    $query = "SELECT * FROM cart WHERE name = '$product_name' AND size = '$product_size'";
    $select_cart = mysqli_query($conn, $query);

    if(mysqli_num_rows($select_cart) > 0){
        $row = $select_cart->fetch_assoc();
        $new_quantity = $row['quantity'] + $product_quantity;

        $update_query = "UPDATE cart SET quantity = ? WHERE name = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('is', $new_quantity, $product_name);
        $stmt->execute();
        echo "<script>alert('Product added to cart successfully');</script>";
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO cart(name, size, price, image, quantity) VALUES('$product_name', '$product_size', '$product_price', '$product_image', '$product_quantity')");
        echo "<script>alert('Product added to cart successfully');</script>";
    }
}


 
 ?>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shin's</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Rardo.css">
    <script src="products.js"></script>
    <style>
            .icon-cart21{
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
                    <li class="icon-cart21"><a href="login.php">Login</a></li>
                <?php 
                } else { // If the user session is set
                ?>
                <li class="icon-cart"><a href="logout.php" onclick="return confirmLogout()">Logout</a></li>
                <script>
                function confirmLogout() {
                    return confirm("Are you sure you want to log out?");
                }
                </script>
                    <li class="icon-cart21" onclick="location.href='cart.php';"> 
                <svg aria-hidden="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                </svg>
                <!-- <span>0</span></a> -->
                </li>
                <?php 
                } 
                ?>
            
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>


<div class="container py-3">
            <!-- Rice Meals Section -->
        <h1 class="card-title tle" id="Rice" >Rice Meals</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php 
        $query = "SELECT * FROM rice";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col">
            <div class="card">
                <img src="Images/Products/<?php echo $fetch_product['image']; ?>" class="card-img-top zoom-img" alt="<?php echo $fetch_product['name']; ?>">
                <div class="card-body d-flex">
                    <h3 class="card-title" name="<?php echo $fetch_product['name']; ?>"><?php echo $fetch_product['name']; ?></h3>
                    <h3 style="margin-left:20px; color: black;" name="<?php echo $fetch_product['price']; ?>">PHP <?php echo $fetch_product['price']; ?></h3>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <form action="" method="post">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        
                        <?php if ($fetch_product['availability'] == '1') { ?>
                            <div class="row mb-3" style="margin-left: 25px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1">
                                        <?php 
                                        } 
                                        ?> 

                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                <?php 
                                if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                ?>
                                    <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_rice" disabled>
                                    
                                <?php 
                                } else { // If the user session is set
                                ?>
                                    <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_rice">
                                <?php 
                                } 
                                ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <p style="color: red; margin-left: 25px;">This product is currently unavailable</p><br>
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col'><p>No products found.</p></div>";
        }
        ?>
    </div>


    <!-- Frappe Section -->
    <h1 class="card-title tle" id="Frappe">Frappe</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        <?php 
            $query = "SELECT * FROM frappe";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col">
            <div class="card">
                <img src="Images/Products/<?php echo $fetch_product['image']; ?>" class="card-img-top zoom-img" alt="<?php echo $fetch_product['name']; ?>">
                <div class="card-body d-flex">
                    <h3 class="card-title" name="<?php echo $fetch_product['name']; ?>"><?php echo $fetch_product['name']; ?></h3>
                    <h3 style="margin-left:20px; color: black; display: block ;" class="display-price" name="product_price">PHP <?php echo $fetch_product['medprice']; ?></h3>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    
                    <form action="" method="post" class="ms-3">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_size" class="product_size" value="Medium">
                        <input type="hidden" name="product_price" class="product_price" value="<?php echo $fetch_product['medprice']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        <?php if ($fetch_product['availability'] == '1') { ?>

                        <div class="row mb-3" style="margin-left: 25px;">
                            <div class="col-md-6">
                                <label id="quantity" for="quantity">Quantity</label>
                                <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1">
                                        <?php 
                                        } 
                                ?> 
                            </div>
                            <div class="col-md-6">
                                <label for="dropdownMenuButton1">Size</label>
                                <div class="dropdown">
                                <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                        Select Size
                                    </button>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Size
                                    </button>
                                    <ul class="dropdown-menu" id="dp1" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" data-price="<?php echo $fetch_product['medprice']; ?>" data-size="Medium">M: PHP <?php echo $fetch_product['medprice']; ?></a></li>
                                        <li><a class="dropdown-item" href="#" data-price="<?php echo $fetch_product['largeprice']; ?>" data-size="Large">L: PHP <?php echo $fetch_product['largeprice']; ?></a></li>
                                    </ul>
                                        <?php 
                                        } 
                                ?> 
                                    
                                </div>
                            </div>
                        </div>
                        <div style="margin-left: 25px;">
                            
                            
                            <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_fp" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_fp">
                                        <?php 
                                        } 
                                        ?> 
                        </div>
                    <?php } else { ?>
                        <p style="color: red; margin-left:25px;">This product is currently unavailable</p>
                    <?php } ?>


                    </form>
                </div>
            </div>
        </div>
        <?php
                }
            } else {
                echo "<div class='col'><p>No products found.</p></div>";
            }
        ?>
    </div>

    <h1 class="card-title tle" id="Coffee">Coffee</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php 
                $query = "SELECT * FROM coffee";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col">
                <div class="card">
                    <img src="Images/Products/<?php echo $fetch_product['image']; ?>" class="card-img-top zoom-img" alt="<?php echo $fetch_product['name']; ?>">
                    <div class="card-body d-flex">
                        <h3 class="card-title" name="<?php echo $fetch_product['name']; ?>"><?php echo $fetch_product['name']; ?></h3>
                        <h3 style="margin-left:20px; color: black; display: block ;" class="display-price" name="product_price">PHP <?php echo $fetch_product['medprice']; ?></h3>
                    </div>
                    <div class="d-flex justify-content-around mb-5">
                        
                        <form action="" method="post" class="ms-3">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_size" class="product_size" value="Medium">
                            <input type="hidden" name="product_price" class="product_price" value="<?php echo $fetch_product['medprice']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <?php if ($fetch_product['availability'] == '1') { ?>
                                <div class="row mb-3" style="margin-left: 25px;">
                            <div class="col-md-6">
                                <label id="quantity" for="quantity">Quantity</label>
                                <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1">
                                        <?php 
                                        } 
                                ?> 
                            </div>
                            <div class="col-md-6">
                                <label for="dropdownMenuButton1">Size</label>
                                <div class="dropdown">
                                <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                        Select Size
                                    </button>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Size
                                    </button>
                                    <ul class="dropdown-menu" id="dp1" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#" data-price="<?php echo $fetch_product['medprice']; ?>" data-size="Medium">M: PHP <?php echo $fetch_product['medprice']; ?></a></li>
                                        <li><a class="dropdown-item" href="#" data-price="<?php echo $fetch_product['largeprice']; ?>" data-size="Large">L: PHP <?php echo $fetch_product['largeprice']; ?></a></li>
                                    </ul>
                                        <?php 
                                        } 
                                ?> 
                                    
                                </div>
                            </div>
                        </div>
                        <div style="margin-left: 25px;">
                            
                            
                            <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_fp" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_fp">
                                        <?php 
                                        } 
                                        ?> 
                        </div>
                    <?php } else { ?>
                        <p style="color: red; margin-left:25px;">This product is currently unavailable</p>
                    <?php } ?>


                        </form>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo "<div class='col'><p>No products found.</p></div>";
                }
            ?>
        </div>


        <h1 class="card-title tle" id="Snacks">Snacks</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
            <?php 
        $query = "SELECT * FROM snacks";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col">
            <div class="card">
                <img src="Images/Products/<?php echo $fetch_product['image']; ?>" class="card-img-top zoom-img" alt="<?php echo $fetch_product['name']; ?>">
                <div class="card-body d-flex">
                    <h3 class="card-title" name="<?php echo $fetch_product['name']; ?>"><?php echo $fetch_product['name']; ?></h3>
                    <h3 style="margin-left:20px; color: black;" name="<?php echo $fetch_product['price']; ?>">PHP <?php echo $fetch_product['price']; ?></h3>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <form action="" method="post">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                        
                        <?php if ($fetch_product['availability'] == '1') { ?>
                            <div class="row mb-3" style="margin-left: 25px;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <?php 
                                        if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                            ?>
                                            <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1" disabled>
                                        <?php 
                                        } else { 
                                        ?>   
                                        <input type="number" name="quantity" min="1" class="form-control" style="width: 100%;" value="1">
                                        <?php 
                                        } 
                                        ?> 

                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                <?php 
                                if(!isset($_SESSION["username"])) { // Check if the user session is not set
                                ?>
                                    <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_rice" disabled>
                                    
                                <?php 
                                } else { // If the user session is set
                                ?>
                                    <input type="submit" class="btn btn-primary add-to-cart" value="Add to cart" name="add_to_cart_rice">
                                <?php 
                                } 
                                ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <p style="color: red; margin-left: 25px;">This product is currently unavailable</p><br>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col'><p>No products found.</p></div>";
        }
        ?>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            let selectedPrice = this.getAttribute('data-price');
            let selectedSize = this.getAttribute('data-size');
            let card = this.closest('.card');
            card.querySelector('.display-price').textContent = 'PHP' + selectedPrice;
            card.querySelector('.product_size').value = selectedSize;
            card.querySelector('.product_price').value = selectedPrice;
            card.querySelector('.dropdown-toggle').textContent = this.textContent;
        });
    });
});
</script>




<script src="./js/script.js"></script>

            <footer id="about-us" class="bg-white text-black text-center1 text-lg-start mt-4">
                <div class="text-center1 p-3 bg-white text-black">
                    &copy; 2024 Shinsfuntea. All rights reserved.
                </div>
            </footer>
            
     </body>

</html>  


<?php
// Close the database connection
mysqli_close($conn);
?>
