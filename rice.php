<?php 
include('constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Rice Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
    // JavaScript functions to confirm actions
    function confirmDelete() {
        return confirm("Are you sure you want to delete this rice item?");
    }
    function confirmUpdate() {
        return confirm("Are you sure you want to update this rice item?");
    }
    function confirmAdd() {
        return confirm("Are you sure you want to add this rice item?");
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
    <div class="container">
        <h1 class="my-4">Manage Rice Menu</h1>

        <!-- Search Form -->
        <form action="" method="get" class="mb-4">
            <h2>Search Rice Item</h2>
            <div class="form-group">
                <label for="search">Search by Name:</label>
                <input type="text" id="search" name="search" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <form action="" method="get" class="mb-4">
            <button type="submit" class="btn btn-secondary">Show All</button>
        </form>

        <!-- Form to add new rice item -->
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirmAdd();" class="mb-4">
            <h2>Add New Rice Item</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01" required>
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
            <button type="submit" name="action" value="add" class="btn btn-success">Add Rice Item</button>
        </form>

        <!-- Form to update or delete a rice item -->
        <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <h2>Update or Delete Rice Item</h2>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="number" id="id" name="id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" step="0.01">
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
            <button type="submit" name="action" value="update" class="btn btn-warning" onclick="return confirmUpdate();">Update Rice Item</button>
            <button type="submit" name="action" value="delete" class="btn btn-danger" onclick="return confirmDelete();">Delete Rice Item</button>
        </form>

        <!-- Display rice items -->
        <?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $price = isset($_POST["price"]) ? $_POST["price"] : null;
    $availability = isset($_POST["availability"]) ? $_POST["availability"] : null;
    $image = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : null;

    if ($action == "add") {
        // Check for duplicate name
        $check_sql = "SELECT * FROM rice WHERE name='$name'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            echo "Error: A rice item with the name '$name' already exists.";
        } else {
            $target_dir = "Images/Products/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $sql = "INSERT INTO rice (name, price, image, availability)
                    VALUES ('$name', '$price', '$image', '$availability')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif ($action == "update" && !empty($id)) {
        // Fetch existing data for the rice item being updated
        $existing_sql = "SELECT name, price, image, availability FROM rice WHERE id=?";
        $stmt = $conn->prepare($existing_sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Determine which fields are being updated
            $name = !empty($_POST["name"]) ? $_POST["name"] : $row["name"];
            $price = !empty($_POST["price"]) ? $_POST["price"] : $row["price"];
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
            $sql = "UPDATE rice SET name=?, price=?, availability=?";
            $params = array($name, $price, $availability);

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
            // Bind parameters correctly based on their types (s = string, i = integer)
            $types = "sdi";
            if (!empty($image)) {
                $types .= "s";
            }
            $types .= "i";
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $stmt->error;
            }
        } else {
            echo "Error: Rice item with ID $id not found.";
        }
    } elseif ($action == "delete" && !empty($id)) {
        $sql = "DELETE FROM rice WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Record deleted successfully";

            // Reassign IDs to ensure they are sequential
            $sql1 = "SET @count = 0;";
            $sql2 = "UPDATE rice SET id = @count:= @count + 1;";
            $sql3 = "ALTER TABLE rice AUTO_INCREMENT = 1;";
            $conn->query($sql1);
            $conn->query($sql2);
            $conn->query($sql3);

            if ($conn->query($sql2) === TRUE) {
                echo "IDs reassigned successfully";
            } else {
                echo "Error reassigning IDs: " . $conn->error;
            }
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
    }
}

// Fetch and display all rice items
$sql = "SELECT * FROM rice";
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql .= " WHERE name LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Rice Menu</h2>";
    echo "<div class='table-responsive'><table class='table table-striped'><thead class='thead-dark'><tr><th>ID</th><th>Name</th><th>Price</th><th>Image</th><th>Availability</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["price"]."</td><td><img src='Images/Products/".$row["image"]."' alt='".$row["name"]."' style='width:100px;'></td><td>".($row["availability"] ? "Yes" : "No")."</td></tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "0 results";
}

$conn->close();
?>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




