<?php 
include('constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Frappe Menu</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
    // JavaScript functions to confirm actions
    function confirmDelete() {
        return confirm("Are you sure you want to delete this frappe item?");
    }
    function confirmUpdate() {
        return confirm("Are you sure you want to update this frappe item?");
    }
    function confirmAdd() {
        return confirm("Are you sure you want to add this frappe item?");
    }
    </script>
    <style>
        body{
            background: rgb(250,250,250);
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
        <br>
    <div class="container">
        <h1>Manage Frappe Menu</h1>

        <!-- Search Form -->
        <form action="" method="get" class="mb-4">
            <h2>Search Frappe Item</h2>
            <div class="form-group">
                <label for="search">Search by Name:</label>
                <input type="text" id="search" name="search" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <form action="" method="get" class="mb-4">
            <button type="submit" class="btn btn-secondary">Show All</button>
        </form>

        <!-- Form to add new frappe item -->
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirmAdd();" class="mb-4">
            <h2>Add New Frappe Item</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="largeprice">Large Price:</label>
                <input type="number" id="largeprice" name="largeprice" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="medprice">Medium Price:</label>
                <input type="number" id="medprice" name="medprice" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="availability">Available:</label>
                <select id="availability" name="availability" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" name="action" value="add" class="btn btn-success">Add Frappe Item</button>
        </form>

        <!-- Form to update or delete a frappe item -->
        <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <h2>Update/Delete Frappe Item</h2>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="number" id="id" name="id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" >
            </div>
            <div class="form-group">
                <label for="largeprice">Large Price:</label>
                <input type="number" id="largeprice" name="largeprice" class="form-control" step="0.01">
            </div>
            <div class="form-group">
                <label for="medprice">Medium Price:</label>
                <input type="number" id="medprice" name="medprice" class="form-control" step="0.01">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
            </div>
            <div class="form-group">
                <label for="availability">Available:</label>
                <select id="availability" name="availability" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" name="action" value="update" class="btn btn-warning" onclick="return confirmUpdate();">Update Frappe Item</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirmDelete();">Delete Frappe Item</button>
        </form>

        <!-- Display frappe items -->
        <?php

        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action = $_POST["action"];
            $id = isset($_POST["id"]) ? $_POST["id"] : null;
            $name = isset($_POST["name"]) ? $_POST["name"] : null;
            $largeprice = isset($_POST["largeprice"]) ? $_POST["largeprice"] : null;
            $medprice = isset($_POST["medprice"]) ? $_POST["medprice"] : null;
            $availability = isset($_POST["availability"]) ? $_POST["availability"] : null;
            $image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : null;

            if ($action == "add") {
                $check_sql = "SELECT * FROM frappe WHERE name='$name'";
                $check_result = $conn->query($check_sql);
                if ($check_result->num_rows > 0) {
                    echo "Error: A frappe item with the name '$name' already exists.";
                } else {
                    $target_dir = "Images/Products/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                    $sql = "INSERT INTO frappe (name, largeprice, medprice, image, availability)
                            VALUES ('$name', '$largeprice', '$medprice', '$image', '$availability')";
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            } elseif ($action == "update" && isset($_POST["id"])) {
                $id = $_POST["id"];
        
                // Fetch existing data for the item being updated
                $existing_sql = "SELECT name, largeprice, medprice, image, availability FROM frappe WHERE id=?";
                $stmt = $conn->prepare($existing_sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
        
                    // Determine which fields are being updated
                    $name = !empty($_POST["name"]) ? $_POST["name"] : $row["name"];
                    $largeprice = !empty($_POST["largeprice"]) ? $_POST["largeprice"] : $row["largeprice"];
                    $medprice = !empty($_POST["medprice"]) ? $_POST["medprice"] : $row["medprice"];
                    $availability = isset($_POST["availability"]) ? $_POST["availability"] : $row["availability"];
                    $image = $row["image"];
        
                    // Handle image upload if a new image is provided
                    if (!empty($_FILES["image"]["name"])) {
                        $target_dir = "Images/Products/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        $image = $_FILES["image"]["name"];
                    }
        
                    // Prepare the SQL update statement
                    $sql = "UPDATE frappe SET name=?, largeprice=?, medprice=?, availability=?";
                    $params = array($name, $largeprice, $medprice, $availability);
        
                    // Add image update to SQL and parameters if image is updated
                    if (!empty($image)) {
                        $sql .= ", image=?";
                        $params[] = $image;
                    }
        
                    // Complete the SQL statement
                    $sql .= " WHERE id=?";
                    $params[] = $id;
        
                    // Prepare and execute the update query
                    $stmt = $conn->prepare($sql);
                    // Dynamically bind parameters based on their types
                    $types = str_repeat("s", count($params)); // Assuming all parameters are strings
                    $stmt->bind_param($types, ...$params);
        
                    if ($stmt->execute()) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $stmt->error;
                    }
                } else {
                    echo "Error: Menu item with ID $id not found.";
                }
            } elseif ($action == "delete" && !is_null($id)) {
                $sql = "DELETE FROM frappe WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
        
                    // Reassign IDs to ensure they are sequential
                    $sql = "SET @count = 0; UPDATE frappe SET id = @count:= @count + 1; ALTER TABLE frappe AUTO_INCREMENT = 1;";
                    if ($conn->multi_query($sql)) {
                        do {
                            if ($result = $conn->store_result()) {
                                $result->free();
                            }
                        } while ($conn->more_results() && $conn->next_result());
                        echo "IDs reassigned successfully";
                    } else {
                        echo "Error reassigning IDs: " . $conn->error;
                    }
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
        }
        // Display all frappe items
        $sql = "SELECT * FROM frappe";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Frappe Menu</h2>";
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Large Price</th>";
            echo "<th>Medium Price</th>";
            echo "<th>Image</th>";
            echo "<th>Availability</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>$" . $row["largeprice"] . "</td>";
                echo "<td>$" . $row["medprice"] . "</td>";
                echo "<td><img src='Images/Products/" . $row["image"] . "' class='img-thumbnail' width='100'></td>";
                echo "<td>" . ($row["availability"] == 1 ? "Yes" : "No") . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

















