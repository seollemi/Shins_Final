<?php 

include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <script>
        function updatemenu() {
            if (document.getElementById('responsive-menu').checked == true) {
                document.getElementById('menu').style.borderBottomRightRadius = '0';
                document.getElementById('menu').style.borderBottomLeftRadius = '0';
            }else{
                document.getElementById('menu').style.borderRadius = '10px';
            }
            }
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
            
        }
    </script>
    <style>
        body{
            background: rgb(250,250,250);
            background: linear-gradient(90deg, rgba(250,250,250,1) 0%, rgba(157,157,255,1) 38%, rgba(0,212,255,1) 100%);
        }
        .main-content {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 75vh;
        }
        .wrapper {
            max-width: 1200px;
            margin: auto;
        }
        .text-center {
            text-align: center;
        }
        .clearfix {
            clear: both;
        }
        @media (max-width: 768px) {
            .col-md-4 {
                width: 100%;
                padding: 10px;
            }
        }

        #menu {
            background: white;
            height: 58px;
            border: 2px solid #6D6D6D;
        }
        #menu ul, #menu li {
            margin: 0 auto;
            padding: 0;
            list-style: none
        }
        #menu ul {
            width: 100%;
            text-align: center;
        }
        #menu li {
            display: inline-block;
            position: relative;
        }
        #menu a {
            display: block;
            line-height: 54px;
            padding: 0 14px;
            text-decoration: none;
            color: black;
            font-size: 16px;
        }
        #menu a.dropdown-arrow:after {
            content: "\25BE";
            margin-left: 5px;
        }
        #menu li a:hover {
            color: #0099CC;
            background: #F2F2F2;
        }
        #menu input {
            display: none;
            margin: 0;
            padding: 0;
            height: 58px;
            width: 100%;
            opacity: 0;
            cursor: pointer
        }
        #menu label {
            display: none;
            line-height: 54px;
            text-align: center;
            position: absolute;
            left: 35px
        }
        #menu label:before {
            font-size: 1.6em;
            color: #FFFFFF;
            content: "\2261"; 
            margin-left: 20px;
        }
        #menu ul.sub-menus{
            height: auto;
            overflow: hidden;
            width: 170px;
            background: #444444;
            position: absolute;
            z-index: 99;
            display: none;
        }
        #menu ul.sub-menus li {
            display: block;
            text-align: left;
            width: 100%;
        }
        #menu ul.sub-menus a {
            color: #FFFFFF;
            font-size: 16px;
        }
        #menu li:hover ul.sub-menus {
            display: block
        }
        #menu ul.sub-menus a:hover{
            background: #F2F2F2;
            color: #444444;
        }
        @media screen and (max-width: 800px){
            #menu {position:relative}
            #menu ul {background:#444444;position:absolute;top:100%;right:0;left:0;z-index:3;height:auto;display:none;text-align:left;}
            #menu ul.sub-menus {width:100%;position:static;}
            #menu ul.sub-menus a {padding-left:30px;}
            #menu li {display:block;float:none;width:auto;}
            #menu input, #menu label {position:absolute;top:0;left:0;display:block}
            #menu input {z-index:4}
            #menu input:checked + label {color:#FFFFFF}
            #menu input:checked + label:before {content:"\00d7"}
            #menu input:checked ~ ul {display:block}
        }

    </style>
</head>
<body>
<nav id='menu'>
    <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
    <ul>
        <li><a href='admindash.php'>Home</a></li>
        <li><a class='dropdown-arrow' href='#'>Products</a>
            <ul class='sub-menus'>
                <li><a href='frappe.php'>Manage Frappe</a></li>
                <li><a href='rice.php'>Manage Rice</a></li>
                <li><a href='snacks.php'>Manage Snacks</a></li>
                <li><a href='coffee.php'>Manage Coffee</a></li>
            </ul>
        </li>
        <li><a href='adminorders.php'>Orders</a></li>
        <li><a href='manage-admin.php'>Manage Admin</a></li>
        <li><a href='manage-review.php'>Manage Reviews</a></li> <!-- New nav item -->
        <li><a href="adminlogout.php" onclick="return confirmLogout()">Logout</a></li>
    </ul>
</nav>
    <!-- MAIN CONTENT SECTION -->
    <div class="main-content">
        <div class="wrapper">
            <h2 class="text-center">DASHBOARD</h2>
            <br><br>
            <?php 
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql = "SELECT * FROM frappe WHERE availability = 1";
                                $res = mysqli_query($conn, $sql);
                                if ($res) {
                                    $count = mysqli_num_rows($res);
                                } else {
                                    $count = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count; ?></h1>
                            <p class="card-text">Frappe Availability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql1 = "SELECT * FROM rice WHERE availability = 1";
                                $res1 = mysqli_query($conn, $sql1);
                                if ($res1) {
                                    $count1 = mysqli_num_rows($res1);
                                } else {
                                    $count1 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count1; ?></h1>
                            <p class="card-text">Rice Availability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql2 = "SELECT * FROM snacks WHERE availability = 1";
                                $res2 = mysqli_query($conn, $sql2);
                                if ($res2) {
                                    $count2 = mysqli_num_rows($res2);
                                } else {
                                    $count2 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count2; ?></h1>
                            <p class="card-text">Snacks Availability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql3 = "SELECT * FROM coffee WHERE availability = 1";
                                $res3 = mysqli_query($conn, $sql3);
                                if ($res3) {
                                    $count3 = mysqli_num_rows($res3);
                                } else {
                                    $count3 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count3; ?></h1>
                            <p class="card-text">Coffee Availability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql4 = "SELECT * FROM `orders`";
                                $res4 = mysqli_query($conn, $sql4);
                                if ($res4) {
                                    $count4 = mysqli_num_rows($res4);
                                } else {
                                    $count4 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count4; ?></h1>
                            <p class="card-text">Order Count</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql5 = "SELECT SUM(Total) AS Total FROM `orders`";
                                $res5 = mysqli_query($conn, $sql5);
                                if ($res5) {
                                    $row5 = mysqli_fetch_assoc($res5);
                                    $total_revenue = $row5["Total"];
                                } else {
                                    $total_revenue = 0;
                                }
                            ?>
                            <h1 class="card-title">₱<?php echo $total_revenue; ?></h1>
                            <p class="card-text">Total Revenue</p>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql6 = "SELECT * FROM `orders` WHERE status = 'pending'";
                                $res6 = mysqli_query($conn, $sql6);
                                if ($res6) {
                                    $count6 = mysqli_num_rows($res6);
                                } else {
                                    $count6 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count6; ?></h1>
                            <p class="card-text">Pending Orders</p>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <?php
                                $sql7 = "SELECT * FROM `orders` WHERE status = 'delivered'";
                                $res7 = mysqli_query($conn, $sql7);
                                if ($res6) {
                                    $count7= mysqli_num_rows($res7);
                                } else {
                                    $count7 = 0;
                                }
                            ?>
                            <h1 class="card-title"><?php echo $count7; ?></h1>
                            <p class="card-text">Ordered Delivered</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php 
    // Close the connection
    mysqli_close($conn);
    ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
