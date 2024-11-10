<?php
// Start the session
include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You are not logged in. Please <a href='index.php'>login here</a>.";
    exit();
}

// Get the logged-in user's data
$username = $_SESSION['username'];
$sql = "SELECT * FROM client_info WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    echo "Error retrieving user data.";
    exit();
}

// Initialize error message
$error_message = "";

// Initialize success message
$success_message = "";

// Update user data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_num'];
    $client_address = $_POST['client_address'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_pw = $row['user_pw']; // Existing password hash

    // Validate first name and last name
    if (preg_match('/[0-9]/', $fname) || preg_match('/[0-9]/', $lname)) {
        $error_message .= "First name and last name should not contain numbers. ";
    }

    // Validate phone number
    if (!preg_match("/^(09|\+639)\d{9}$/", $phone_num)) {
        $error_message .= "Invalid Philippine phone number. ";
    }

    // Validate age
    if ($age < 17 || $age > 100) {
        $error_message .= "Age must be between 17 and 100. ";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message .= "Invalid email format. ";
    }

    // Check if the user wants to change the password
    if (!empty($old_password) && !empty($new_password)) {
        if (password_verify($old_password, $user_pw)) {
            // Check if new password and confirm password match
            if ($new_password === $confirm_password) {
                // Update the password
                $user_pw = password_hash($new_password, PASSWORD_DEFAULT);
            } else {
                $error_message .= "New password and confirm password do not match. ";
            }
        } else {
            $error_message .= "Old password is incorrect. ";
        }
    }

    // Update database if no errors
    if (empty($error_message)) {
        $update_sql = "UPDATE client_info SET 
                        Fname='$fname', 
                        Lname='$lname', 
                        gender='$gender', 
                        age='$age', 
                        birthday='$birthday', 
                        email='$email', 
                        phone_num='$phone_num', 
                        client_address='$client_address', 
                        user_pw='$user_pw' 
                        WHERE username='$username'";

        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['success_message'] = "Profile updated successfully.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message .= "Error updating profile: " . $conn->error;
        }
    }
}

// Display success message and clear session variable
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="shins.css">
    <style>
        body {
            background-color: rgb(164, 231, 240);;
            margin-top: 70px; /* Add space for the nav bar */
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-label {
            margin-bottom: 0.5rem;
        }
        .input-group-text {
            cursor: pointer;
        }
        nav.sticky-nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
            box-shadow: 0 4px 2px -2px gray;
        }
        .sidebar {
            display: flex;
            flex-direction: row;
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin: 10px;
        }
        .sidebar a {
            text-decoration: none;
            color: black;
        }

        .hideOnMobile {
            display: none;
        }
        .menu-button {
            display: block;
        }
        @media (min-width: 768px) {
            .hideOnMobile {
                display: block;
            }
            .menu-button {
                display: none;
            }
        }

        .icon-cart{
        display: flex;
        align-items: center;
        justify-content: flex-end;
        position: relative;
        margin-left: auto;

    }
    
    </style>
    <script>
        function calculateAge() {
            var birthday = document.getElementById('birthday').value;
            var birthDate = new Date(birthday);
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        }

        function showSuccessMessage() {
            var successMessage = <?php echo json_encode($success_message); ?>;
            if (successMessage) {
                alert(successMessage);
            }
        }

        function togglePasswordVisibility(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }

        function showSidebar() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = "flex";
        }

        function closeSB() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = "none";
        }

        function confirmUpdate() {
            return confirm("Do you want to proceed with updating your profile?");
        }
    </script>
</head>
<body onload="showSuccessMessage()">

<nav class="sticky-nav">


        <ul>
            <li class="logo-and-text">
                <img src="./Images/shin logo.jpg" alt="">
            </li>
            <li class="hideOnMobile"><a href="index.php">Home</a></li>
            <li class="hideOnMobile"><a href="about.html">About us</a></li>
            <li class="hideOnMobile"><a href="products.php">Menu</a></li>
            <li class="hideOnMobile"><a href="personnel.html">Personnel</a></li>
            <li class="hideOnMobile"><a href="ContactUs.php">Contact us</a></li>
            <li class="hideOnMobile"><a href="reviews_blog.php">Reviews</a></li>
            
            <?php 
                if(!isset($_SESSION["username"])){ // Check if the user session is not set
                ?>
                    <li class="icon-cart"><a href="login.php">Login</a></li>
                <?php 
                } else { // If the user session is set
                    ?>
                    <li class="icon-cart"><a href="logout.php" onclick="return confirmLogout()">Logout</a></li>
                <?php 
                } 
                ?>
                <script>
                function confirmLogout() {
                    return confirm("Are you sure you want to log out?");
                }
                </script>
                <li class="hideOnMobile"><a href="Profile_edit.php">Profile</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="black"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <div class="container bg-white p-5 rounded shadow">
        <h2 class="text-center mb-4">Edit Profile</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="" onsubmit="return confirmUpdate()">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $row['Fname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $row['Lname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="client_address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="client_address" id="client_address" value="<?php echo $row['client_address']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birth Date:</label>
                <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo $row['birthday']; ?>" onchange="calculateAge()" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" name="age" id="age" value="<?php echo $row['age']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_num" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" name="phone_num" id="phone_num" value="<?php echo $row['Phone_num']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender:</label>
                <div>
                    <input type="radio" class="form-check-input" name="gender" value="Male" <?php echo ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male
                    <input type="radio" class="form-check-input" name="gender" value="Female" <?php echo ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                    <input type="radio" class="form-check-input" name="gender" value="Other" <?php echo ($row['gender'] == 'Other') ? 'checked' : ''; ?>> Other
                </div>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password (if changing):</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="old_password" id="old_password">
                    <span class="input-group-text" onclick="togglePasswordVisibility('old_password')">&#128065;</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password (if changing):</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="new_password" id="new_password">
                    <span class="input-group-text" onclick="togglePasswordVisibility('new_password')">&#128065;</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                    <span class="input-group-text" onclick="togglePasswordVisibility('confirm_password')">&#128065;</span>
                </div>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" class="btn btn-primary" value="Update Profile">
            </div>
        </form>
    </div>
</body>
</html>
