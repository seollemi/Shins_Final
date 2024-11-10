<?php
include('constants.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$loggedIn = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Welcome</title>
    <style>
        /* CSS styles for card layout */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, rgba(250,250,250,1) 0%, rgba(157,157,255,1) 38%, rgba(0,212,255,1) 100%);
        }

        .modal {
            background-color: white;
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .redirect-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .redirect-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="welcomeModal" class="modal">
        <div class="modal-content">
        <img src="Images\shin logo.jpg" alt="Logo" style="width: 100px; height: 100px;">
            <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <p>You have successfully logged in.</p>
            <button class="redirect-btn" onclick="redirectToAnotherPage()">Continue</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('welcomeModal');

            <?php if ($loggedIn) { ?>
                modal.style.display = 'block';
            <?php } ?>
        });

        function redirectToAnotherPage() {
            window.location.href = 'index.php'; 
        }
    </script>
</body>
</html>