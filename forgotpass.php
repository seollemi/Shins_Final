<?php
include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // Perform a query to check if username exists in your database
    $sql = "SELECT * FROM client_info WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Username exists, set session variable and redirect to reset_password.php
        $_SESSION['reset_username'] = $username;
        header("Location: reset_password.php");
        exit();
    } else {
        // Username doesn't exist
        $_SESSION['error_message'] = "Username not found.";
        header("Location: forgotpass.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
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
        input[type="text"] {
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
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Forgot Password</h2>
        <form action="forgotpass.php" method="post">
            <label for="username">Enter your email:</label>
            <input type="text" id="username" name="username" required>
            <input type="submit" value="Submit">
        </form>
        
        <?php
        // Display error message from username check
        if (isset($_SESSION['error_message'])) {
            echo "<p class='error'>{$_SESSION['error_message']}</p>";
            unset($_SESSION['error_message']);
        }
        ?>
        <button id="forgotPasswordBtn" onclick="window.location.href='login.php'">Back to login</button>
    </div>
</body>
</html>
