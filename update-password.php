<?php include('constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
            <li><a href='http://'>Logout</a></li>
        </ul>
        </nav>
        <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Change Password</h2>
                        <br>
                        
                        <?php 
                            // Check if ID is set in URL
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];
                            }
                        ?>

                        <form action="" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Change Password</button>
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

    <script>
        function validateForm() {
            var currentPassword = document.getElementById("current_password").value;
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
                alert("All fields are required.");
                return false;
            }

            if (newPassword.length < 8 || !/\d/.test(newPassword) || !/[a-zA-Z]/.test(newPassword)) {
                alert("New password must be at least 8 characters long and contain both letters and numbers.");
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

<?php
// Check if submit button is clicked
if(isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $current_password = ($_POST['current_password']);
    $new_password = ($_POST['new_password']);
    $confirm_password = ($_POST['confirm_password']);

    // Check if user with current ID and password exists
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if($res == true) {
        // Check if data is available
        $count = mysqli_num_rows($res);

        if($count == 1) {
            // User exists and password can be changed
            if($new_password == $confirm_password) {
                // Update password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {
                    // Display success message
                    $_SESSION['change-pwd'] = "<div class='alert alert-success' role='alert'>Password changed successfully.</div>";
                    // Redirect user
                    header('location:' . SITEURL . 'manage-admin.php');
                    exit();
                } else {
                    // Display error message
                    $_SESSION['change-pwd'] = "<div class='alert alert-danger' role='alert'>Failed to change password.</div>";
                    // Redirect user
                    header('location:' . SITEURL . 'manage-admin.php');
                    exit();
                }
            } else {
                // Passwords do not match
                $_SESSION['pwd-not-match'] = "<div class='alert alert-danger' role='alert'>Password and confirm password do not match.</div>";
                // Redirect user
                header('location:' . SITEURL . 'manage-admin.php');
                exit();
            }
        } else {
            // User not found
            $_SESSION['user-not-found'] = "<div class='alert alert-danger' role='alert'>User not found.</div>";
            // Redirect user
            header('location:' . SITEURL . 'manage-admin.php');
            exit();
        }
    }
}
?>
