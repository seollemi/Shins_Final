<?php
include('constants.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user is admin
    $admin_query = "SELECT * FROM tbl_admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($admin_query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $admin_result = $stmt->get_result();

    if ($admin_result->num_rows === 1) {
        // Admin credentials are correct
        $_SESSION['tbl_admin'] = $username;
        header("Location: admindash.php");
        exit();
    } else {
        // Perform a query to check if username and password match for clients
        $client_query = "SELECT * FROM client_info WHERE username = ? AND user_pw = ?";
        $stmt = $conn->prepare($client_query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $client_result = $stmt->get_result();

        if ($client_result->num_rows == 1) {
            // Client credentials are correct
            $row = $client_result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['Phone_num'] = $row['Phone_num'];
            $_SESSION['client_address'] = $row['client_address'];
            $_SESSION['Fname'] = $row['Fname'];
            $_SESSION['Lname'] = $row['Lname'];
            $_SESSION['fullname'] = $row['Fname'] . ' ' . $row['Lname'];

            header("Location: welcome.php");
            exit();
        } else {
            // Username or password is incorrect
            $_SESSION['error_message'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            
            background: linear-gradient(90deg, rgba(250,250,250,1) 0%, rgba(157,157,255,1) 38%, rgba(0,212,255,1) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            
        }
        .card {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            text-align: left;
        }
        .message.success {
            color: green;
        }
        .message.error {
            color: red;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .error {
            color: red;
        }
    </style>
    <script>
        function redirectToNextPage() {
            window.location.href = 'registration.php'; 
        }

        document.addEventListener('DOMContentLoaded', function () {
            const showPasswordCheckbox = document.getElementById('showPassword');
            const passwordInput = document.getElementById('password');

            showPasswordCheckbox.addEventListener('change', function () {
                if (showPasswordCheckbox.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });
        });
    </script>
</head>
<body>
    <div class="card">
    <img src="Images\shin logo.jpg" alt="Logo" style="width: 100px; height: 100px;">
        <h2>Login Form</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div style="margin-bottom: 10px;"> 
                <input type="checkbox" id="showPassword"> Show Password
            </div>

            <input type="submit" value="Login">
        </form>
        
        <?php
        // Display error message from login attempt
        if (isset($_SESSION['error_message'])) {
            echo "<p class='error'>{$_SESSION['error_message']}</p>";
            unset($_SESSION['error_message']);
        }
        ?>
        
        
        <button id="signupBtn" onclick="redirectToNextPage()">Sign up</button>
        <br><br>
        <a class="back-btn" href="forgotpass.php">Forgot Password</a>
    </div>
</body>
</html>
