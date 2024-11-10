<?php
    // Include constants.php file here
    include('constants.php');

    // Check if the ID parameter is set in the URL
    if(isset($_GET['id'])) {
        // Get the ID of the admin to be updated
        $id = $_GET['id'];

        // Create SQL query to retrieve admin details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        // Check if query executed successfully and data found
        if($res && mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $username = $row['username'];
        } else {
            // Redirect to manage-admin.php if no admin found
            header('location:' . SITEURL . 'manage-admin.php');
            exit();
        }
    } else {
        // Redirect to manage-admin.php if ID parameter is not set
        header('location:' . SITEURL . 'manage-admin.php');
        exit();
    }

    // Process form submission
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Validate form inputs (you can add more validations as needed)
        if(empty($full_name) || empty($username)) {
            $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>Full Name and Username are required.</div>";
        } else {
            // Update admin in the database
            $sql = "UPDATE tbl_admin SET
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if($res) {
                $_SESSION['update'] = "<div class='alert alert-success' role='alert'>Admin updated successfully.</div>";
                // Redirect to manage-admin.php after successful update
                header('location:' . SITEURL . 'manage-admin.php');
                exit();
            } else {
                $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>Failed to update admin.</div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
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
        </ul>
    </nav>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Update Admin</h2>
                        <br>
                        
                        <?php
                            // Display session messages (if any)
                            if(isset($_SESSION['update'])) {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>

                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $full_name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper.js and Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
