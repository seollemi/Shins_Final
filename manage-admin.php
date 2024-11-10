<?php include('constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: rgb(250,250,250);
            background: linear-gradient(90deg, rgba(250,250,250,1) 0%, rgba(157,157,255,1) 38%, rgba(0,212,255,1) 100%);
            padding-top: 20px; /* Adjust as per your layout */
        }
        .main-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px; /* Add space at the bottom */
        }
        .btn-primary, .btn-secondary, .btn-danger {
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover, .btn-secondary:hover, .btn-danger:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        @media screen and (max-width: 800px) {
            /* Media query adjustments */
            .btn-primary, .btn-secondary, .btn-danger {
                display: block;
                width: 100%;
                margin-bottom: 10px;
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
        <br><br>
    <div class="container main-content">
        <h1 class="mt-4 mb-4">MANAGE ADMIN</h1>
        <?php 
            if(isset($_SESSION['add'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['add'] . "</div>";  // Displaying success message
                unset($_SESSION['add']); // Removing session message
            }

            if(isset($_SESSION['delete'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['delete'] . "</div>"; // Displaying error message
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update'])) {
                echo "<div class='alert alert-info'>" . $_SESSION['update'] . "</div>"; // Displaying info message
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found'])) {
                echo "<div class='alert alert-warning'>" . $_SESSION['user-not-found'] . "</div>"; // Displaying warning message
                unset($_SESSION['user-not-found']);
            }
            
            if(isset($_SESSION['pwd-not-match'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['pwd-not-match'] . "</div>"; // Displaying error message
                unset($_SESSION['pwd-not-match']);
            }
            if(isset($_SESSION['change-pwd'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['change-pwd'] . "</div>"; // Displaying success message
                unset($_SESSION['change-pwd']);
            }
        ?> 

        <a href="add-admin.php" class="btn btn-primary mb-4">Add Admin</a>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">S.N.</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Query to get all admins
                    $sql = "SELECT * FROM tbl_admin";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);

                    // Check whether the query is executed successfully
                    if($res) {
                        // Count rows to check whether we have data in the database
                        $count = mysqli_num_rows($res);
                        
                        $sn = 1; // Initialize serial number

                        // Check if there is data in the database
                        if($count > 0) {
                            // Loop through each row of data
                            while($rows = mysqli_fetch_assoc($res)) {
                                // Get individual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // Display the data in the table row
                                echo "<tr>";
                                echo "<td>{$sn}</td>";
                                echo "<td>{$full_name}</td>";
                                echo "<td>{$username}</td>";
                                echo "<td>
                                        <a href='" . SITEURL . "update-password.php?id={$id}' class='btn btn-primary'>Change Password</a>
                                        <a href='" . SITEURL . "update-admin.php?id={$id}' class='btn btn-secondary'>Update Admin</a>
                                        <a href='" . SITEURL . "delete-admin.php?id={$id}' onclick=\"return confirm('Are you sure you want to delete this admin?');\" class='btn btn-danger'>Delete Admin</a>
                                      </td>";
                                echo "</tr>";

                                $sn++; // Increment serial number
                            }
                        } else {
                            // No data in the database
                            echo "<tr><td colspan='4'>No Admins Found</td></tr>";
                        }
                    } else {
                        // Query execution failed
                        echo "<tr><td colspan='4'>Failed to Fetch Admins</td></tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript function for responsive menu toggle
        function updatemenu() {
            // Implement as per your menu structure
        }
    </script>
</body>
</html>
