<?php
include('constants.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and retrieve their username
if (!isset($_SESSION['reset_username'])) {
    header("Location: login.php");
    exit();
}

// Fetch username from session
$username = $_SESSION['reset_username'];

// Handle form submission to reset password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate if passwords match
    if ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Update the password in the database (plain text, not hashed)
        $sql = "UPDATE client_info SET user_pw = '$new_password' WHERE username = '$username'";

        if (mysqli_query($conn, $sql)) {
            $success_message = "Password successfully changed!";
        } else {
            $error_message = "Error updating password: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Optional: Background color */
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .card h2 {
            margin-top: 0;
        }

        .card p {
            font-size: 18px; /* Adjust the font size as needed */
            font-weight: bold; /* Make the text bold */
        }

        .card button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        .card button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Reset Password</h2>
        <p style="font-size: 18px; font-weight: bold;">Logged in as: <?php echo htmlspecialchars($username); ?></p>
        
        <!-- Show success or error messages if set -->
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php elseif (isset($success_message)) : ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        
        <!-- Password reset form -->
        <?php if (!isset($success_message)) : ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="new_password">New Password:</label><br>
                <input type="password" id="new_password" name="new_password" required><br>
                <input type="checkbox" onclick="togglePasswordVisibility('new_password')"> Show Password<br><br>
                
                <label for="confirm_password">Confirm Password:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
                <input type="checkbox" onclick="togglePasswordVisibility('confirm_password')"> Show Password<br><br>
                
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>
        
        <!-- Back to login button -->
        <button onclick="window.location.href='login.php'">Back to Login</button>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>
</html>
