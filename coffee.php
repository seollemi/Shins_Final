<?php 
include('constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Coffee Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // JavaScript functions to confirm actions
    function confirmDelete() {
        return confirm("Are you sure you want to delete this coffee item?");
    }
    function confirmUpdate() {
        return confirm("Are you sure you want to update this coffee item?");
    }
    function confirmAdd() {
        return confirm("Are you sure you want to add this coffee item?");
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
</head>
<body>
<div class="container mt-4">
    <h1 class="my-4">Manage Coffee Menu</h1>

    <!-- Search Form -->
    <form action="" method="get" class="mb-4">
        <h2>Search Coffee Item</h2>
        <div class="form-group">
            <label for="search">Search by Name:</label>
            <input type="text" class="form-control" id="search" name="search" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <form action="" method="get" class="mb-4">
        <button type="submit" class="btn btn-secondary">Show All</button>
    </form>

    <!-- Form to add new coffee item -->
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirmAdd();" class="mb-4">
        <h2>Add New Coffee Item</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="largeprice">Large Price:</label>
            <input type="number" class="form-control" id="largeprice" name="largeprice" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="medprice">Medium Price:</label>
            <input type="number" class="form-control" id="medprice" name="medprice" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required><br>
        </div>

        <div class="form-group">
            <label for="availability">Available:</label>
            <select id="availability" name="availability" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select><br>
        </div>

        <button type="submit" name="action" value="add" class="btn btn-success">Add Coffee Item</button>
    </form>

    <!-- Form to update or delete a coffee item -->
    <form action="" method="post" enctype="multipart/form-data" class="mb-4">
        <h2>Update or Delete Coffee Item</h2>
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control">
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

        <button type="submit" name="action" value="update" class="btn btn-warning" onclick="return confirmUpdate();">Update Coffee Item</button>
        <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirmDelete();">Delete Coffee Item</button>
    </form>

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
            // Check for duplicate name
            $check_sql = "SELECT * FROM coffee WHERE name='$name'";
            $check_result = $conn->query($check_sql);
            if ($check_result->num_rows > 0) {
                echo "Error: A coffee item with the name '$name' already exists.";
            } else {
                $target_dir = "Images/Products/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                $sql = "INSERT INTO coffee (name, largeprice, medprice, image, availability)
                        VALUES ('$name', '$largeprice', '$medprice', '$image', '$availability')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } elseif ($action == "update" && !empty($id)) {
            // Fetch existing data for the coffee item being updated
            $existing_sql = "SELECT name, largeprice, medprice, image, availability FROM coffee WHERE id=?";
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
                $sql = "UPDATE coffee SET name=?, largeprice=?, medprice=?, availability=?";
                $params = array($name, $largeprice, $medprice, $availability);

                // Add image update to SQL and parameters if image is updated
                if (!empty($image)) {
                    $sql .= ", image=?";
                    $params[] = $image;
                }

               
                $sql .= " WHERE id=?";
                $params[] = $id;

                // Execute the update query
                $stmt = $conn->prepare($sql);
                // Bind parameters
                $stmt->bind_param(str_repeat('s', count($params)), ...$params);
                // Execute statement
                if ($stmt->execute()) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }
            } else {
                echo "No coffee item found with ID: $id";
            }
        } elseif ($action == "delete" && !empty($id)) {
            // Prepare delete statement for coffee items
            $sql_delete = "DELETE FROM coffee WHERE id=?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $id);
        
            // Execute delete statement
            if ($stmt_delete->execute()) {
                echo "Record deleted successfully";
        
                // Reassign IDs sequentially
                $sql_reassign = "SET @count = 0; 
                                 UPDATE coffee SET id = @count:= @count + 1; 
                                 ALTER TABLE coffee AUTO_INCREMENT = 1;";
                if ($conn->multi_query($sql_reassign)) {
                    do {
                        // Store first result set
                        if ($result = $conn->store_result()) {
                            $result->free();
                        }
                    } while ($conn->more_results() && $conn->next_result());
                    echo "IDs reassigned successfully";
                } else {
                    echo "Error reassigning IDs: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $stmt_delete->error;
            }
        } else {
            echo "Invalid action or missing required fields";
        }
    }

    ?>

    <!-- Display all coffee items -->
    <h2>All Coffee Items</h2>
    <div class="row">
        <?php
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        echo "<table class='table table-striped'>";
        echo "<thead class='thead-dark'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Large Price</th>
                    <th>Medium Price</th>
                    <th>Image</th>
                    <th>Available</th>
                </tr>
              </thead>
              <tbody>";
        
        $search = isset($_GET["search"]) ? $_GET["search"] : "";
        if ($search) {
            $sql = "SELECT * FROM coffee WHERE name LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM coffee";
        }
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $availability = $row["availability"] ? "Yes" : "No";
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["largeprice"] . "</td>
                        <td>" . $row["medprice"] . "</td>
                        <td><img src='Images/Products/" . $row["image"] . "' alt='" . $row["name"] . "' class='img-thumbnail' width='100'></td>
                        <td>" . $availability . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No coffee items found</td></tr>";
        }
        echo "</tbody></table>";
        $conn->close();
        ?>
    </div>

</div>
</body>
</html>

