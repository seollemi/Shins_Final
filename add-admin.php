<?php
// Ensure no whitespace or output before this PHP block

include('constants.php');

// Start the session if it hasn't already been started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Process the form submission
if (isset($_POST['submit'])) {
    // Get form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($full_name) || empty($username) || empty($password)) {
        $_SESSION['add'] = "All fields are required.";
        header("location:" . SITEURL . 'add-admin.php');
        exit();
    }

    if (!preg_match("/^[A-Za-z0-9]{5,}$/", $username)) {
        $_SESSION['add'] = "Username must be alphanumeric and at least 5 characters long.";
        header("location:" . SITEURL . 'add-admin.php');
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['add'] = "Password must be at least 8 characters long.";
        header("location:" . SITEURL . 'add-admin.php');
        exit();
    }

    // Encrypt the password with MD5 (Note: Use stronger encryption methods for real applications)
    $password = ($password);

    // SQL Query to save the data into database
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    // Executing Query and Saving Data into DATABASE
    $res = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($res) {
        // Data inserted
        $_SESSION['add'] = "Admin added successfully";
        header("location:" . SITEURL . 'manage-admin.php');
        exit();
    } else {
        // Failed to insert data
        $_SESSION['add'] = "Failed to add admin";
        header("location:" . SITEURL . 'manage-admin.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Add Admin</h1>

                        <?php 
                            if(isset($_SESSION['add'])) {
                                echo "<div class='alert alert-info'>".$_SESSION['add']."</div>";
                                unset($_SESSION['add']);
                            }
                        ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Your Username" required pattern="[A-Za-z0-9]{5,}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required minlength="8">
                                <input type="checkbox" onclick="togglePassword()"> Show Password
                            </div>
                            <button type="submit" name="submit" class="btn btn-secondary btn-block">Add Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
</body>
</html>
