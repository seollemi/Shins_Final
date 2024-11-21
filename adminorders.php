<?php
include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If clear order button is clicked
if (isset($_POST['clear_order'])) {
    $order_id = $_POST['order_id'];
    $delete_query = "DELETE FROM orders WHERE id='$order_id'";
    if (mysqli_query($conn, $delete_query)) {
        // Sequentially update IDs
        $update_id_query = "SET @count = 0";
        mysqli_query($conn, $update_id_query);
        $update_id_query = "UPDATE orders SET id = @count:= @count + 1";
        mysqli_query($conn, $update_id_query);
        $update_id_query = "ALTER TABLE orders AUTO_INCREMENT = 1";
        mysqli_query($conn, $update_id_query);
        
        $_SESSION['message'] = "Order cleared successfully.";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
}

// If update status button is clicked
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $update_query = "UPDATE orders SET status='$status' WHERE id='$order_id'";
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['message'] = "The status of order ID $order_id has been updated successfully. Please check the updated status in the table.";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
}

// Get the search term and dates
$customerName = isset($_GET['customerName']) ? $_GET['customerName'] : '';
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

// Modify the query to include the search term and dates if provided
$query = "SELECT * FROM orders WHERE 1=1";
if ($customerName != '') {
    $query .= " AND Customer_name LIKE '%" . mysqli_real_escape_string($conn, $customerName) . "%'";
}
if ($startDate != '') {
    $query .= " AND order_date >= '" . mysqli_real_escape_string($conn, $startDate) . "'";
}
if ($endDate != '') {
    $query .= " AND order_date <= '" . mysqli_real_escape_string($conn, $endDate) . "'";
}

$result = mysqli_query($conn, $query);
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
            } else {
                document.getElementById('menu').style.borderRadius = '10px';
            }
        }

        function confirmClearOrder(event) {
            if (!confirm('Are you sure you want to clear this order?')) {
                event.preventDefault();
            }
        }

        function confirmUpdateStatus(event) {
            if (!confirm('Are you sure you want to update the status of this order?')) {
                event.preventDefault();
            }
        }
    </script>
    <style>
         body {
            background: rgb(250, 250, 250);
            background-color: #43766C;
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

        #menu ul,
        #menu li {
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

        #menu ul.sub-menus {
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

        #menu ul.sub-menus a:hover {
            background: #F2F2F2;
            color: #444444;
        }

        @media screen and (max-width: 800px) {
            #menu {
                position: relative
            }

            #menu ul {
                background: #444444;
                position: absolute;
                top: 100%;
                right: 0;
                left: 0;
                z-index: 3;
                height: auto;
                display: none;
                text-align: left;
            }

            #menu ul.sub-menus {
                width: 100%;
                position: static;
            }

            #menu ul.sub-menus a {
                padding-left: 30px;
            }

            #menu li {
                display: block;
                float: none;
                width: auto;
            }

            #menu input,
            #menu label {
                position: absolute;
                top: 0;
                left: 0;
                display: block
            }

            #menu input {
                z-index: 4
            }

            #menu input:checked+label {
                color: #FFFFFF
            }

            #menu input:checked+label:before {
                content: "\00d7"
            }

            #menu input:checked~ul {
                display: block
            }
        }
        
        .table-container {
            overflow-x: auto;
        }
        table {
            min-width: 1200px;
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }
        th {
            background-color: #0072ff;
            color: white;
        }
        .items-column {
            width: 400px; /* Adjust this width to your liking */
        }
        .table td {
            word-wrap: break-word;
            white-space: normal;
        }

        table {
        background-color: white;
        }

        table th, table td {
            color: black; /* Adjust text color if needed for better readability */
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
            <li><a href='manage-review.php'>Manage Reviews</a></li>
            <!-- New nav item -->
            <li><a href="adminlogout.php" onclick="return confirmLogout()">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <br>
    <h1 class="text-center">Admin Manage Orders</h1>
        
        <!-- Search Form -->
        <form method="GET" action="">
            <div class="form-group">
                <label for="customerName">Search by Customer Name:</label>
                <input type="text" name="customerName" id="customerName" class="form-control" placeholder="Enter customer name">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="startDate">Start Date:</label>
                    <input type="date" name="startDate" id="startDate" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="endDate">End Date:</label>
                    <input type="date" name="endDate" id="endDate" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="row mt-5">
            <div class="col">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center table-responsive-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Customer Name</th>
                                    <th>Items Ordered</th>
                                    <th>Total Bill</th>
                                    <th>Payment Method</th>
                                    <th>Delivery Method</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Date Ordered</th>
                                    <th>Status</th>
                                    <!-- New column for status -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['Customer_name']; ?></td>
                                        <td><?php echo $row['Items']; ?></td>
                                        <td>₱<?php echo $row['Total']; ?></td>
                                        <td><?php echo $row['payment_method']; ?></td>
                                        <td><?php echo $row['delivery_method']; ?></td>
                                        <td><?php echo $row['delivery_address']; ?></td>
                                        <td><?php echo $row['phone_number']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>₱<?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['order_date']; ?></td>
                                        <td>
                                            <form method="POST" action="" onsubmit="confirmUpdateStatus(event)">
                                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                                <select name="status" class="form-control status-select">
                                                    <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="delivered" <?php echo ($row['status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                                                </select>
                                                <button type="submit" name="update_status" class="btn btn-primary mt-2">Update Status</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" action="" onsubmit="confirmClearOrder(event)">
                                                <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="clear_order" class="btn btn-danger">Clear Order</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-success text-center">
                                <?php
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>






