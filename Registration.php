<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hehe.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Client Registration</title>
</head>
<body>
<div class="vh-100 color">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <form action="Registration.php" method="post" onsubmit="return validateStep1()">
              <h2>Personal Information</h2><br>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label id="first_name" for="first_name">First Name:<h4 class="inline">*</h4></label>
                  <input type="text" id="first_name" name="first_name" class="form-control form-control-sm" required
                    placeholder="Ex. John">
                </div>
                <div class="col-md-6 mb-4">
                  <label id="last_name" for="last_name">Last Name:<h4 class="inline">*</h4></label>
                  <input type="text" id="last_name" name="last_name" class="form-control form-control-sm" required
                    placeholder="Ex. Doe">
                </div>
              </div>
              <div class = "row">
                <div class="col-md-12 mb-4">
                        <label for="address">Address: </label>
                        <input type="text" id="address" name="address" placeholder="Street Address or P.O. Box, Barangay (Neighborhood or District), City or Municipality, Province, ZIP Code"  class="form-control form-control-sm" >
                    </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="birth_date">Birth Date:<h4 class="inline">*</h4></label>
                  <input type="date" id="birth_date" name="birth_date" class="form-control form-control-sm" onchange="calculateAge()" required>
                </div>
                
                <div class="col-md-6 mb-4">
                  <label for="age">Age:</label>
                  <input type="text" id="age" name="age" class="form-control form-control-sm" readonly required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <label for="email">Email:<h4 class="inline">*</h4></label>
                  <input type="email" id="email" name="email" class="form-control form-control-sm" required
                    placeholder="Ex. john.doe@example.com">
                </div>
                <div class="col-md-6 mb-4">
                  <label for="gender">Gender:<h4 class="inline">*</h4></label><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" required>
                    <label class="form-check-label" for="other">Other</label>
                  </div>
                </div>

                <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <label for="phone">Phone:<h4 class="inline">*</h4></label>
                  <input type="text" id="phone" name="phone" class="form-control form-control-sm" required
                    placeholder="Ex. 09123456789">
                </div>
              </div><br>
              <hr>
              <h2>User Account</h2><br><br><br>
              <div class="row">
                <div class="col-12">
                  <label for="username">Username:<h4 class="inline">*</h4></label>
                  <input type="text" id="username" name="username" class="form-control form-control-sm" required>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <label for="password">Password:<h4 class="inline">*</h4></label>
                  <input type="password" id="password" name="password" class="form-control form-control-sm" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">Show</button>

                </div>
                <div class="col-md-6 mb-4 pb-2">
                  <label for="confirm_password">Confirm Password:<h4 class="inline">*</h4></label>
                  <input type="password" id="confirm_password" name="confirm_password"
                    class="form-control form-control-sm" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')">Show</button>
                </div>
              </div>

              <div class="mt-4 pt-2">
                <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" value="Register" />
                <button type="button" class="btn btn-secondary btn-lg" onclick="redirectToLogin()">Go to Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
</body>
</html>
<script>
        function togglePassword(fieldId) {
        var passwordField = document.getElementById(fieldId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }

        function calculateAge() {
                    var birthDate = new Date(document.getElementById('birth_date').value);
                    var today = new Date();
                    var age = today.getFullYear() - birthDate.getFullYear();
                    var monthDiff = today.getMonth() - birthDate.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    document.getElementById('age').value = age;
        }

        function validateStep1() {
             var age = document.getElementById('age').value;
            if (age < 18 || age > 99) {
                 alert('Please enter a valid age between 18 and 99.');
                 return false;
            }

            var birthDate = new Date(document.getElementById('birth_date').value);
             var today = new Date();
             if (birthDate >= today) {
                 alert('Please enter a valid birth date in the past.');
                return false;
             }
            
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password.length < 8) {
                alert('Password must be at least 8 characters long.');
                return false;
            }

          
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true;
        }

        function prependZero() {
            var phoneInput = document.getElementById('phone');
            var phoneValue = phoneInput.value;
            if (phoneValue && phoneValue.length === 10 && phoneValue[0] !== '0') {
                phoneInput.value = '0' + phoneValue;
            }
        }

        document.getElementById('phone').addEventListener('input', prependZero);

        function redirectToLogin() {
            window.location.href = "index.php"; // Change this to your login page URL
        }
</script>
<?php

include('constants.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
         
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender']; 
            $age = $_POST['age'];
            $birth_date = $_POST['birth_date'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            

            // if ($age < 0 || $age < 18 || $age > 99) {
            //     echo "<script>alert('Please enter a valid age between 18 and 99.');</script>";
            //     echo "<script>window.history.back();</script>";
            //     die();
            // } 

            if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
              echo "<script type='text/javascript'>alert('Only alphabets are allowed for the first name.');</script>";
              echo "<script>history.back()</script>";
              die();
          }
      
          // Validate last name
          if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
              echo "<script type='text/javascript'>alert('Only alphabets are allowed for the last name.');</script>";
              echo "<script>window.history.back();</script>";
              die();
          }
      
          // Validate phone number
          if (!preg_match("/^09\d{9}$/", $phone)) {
              echo "<script type='text/javascript'>alert('Please enter a valid 11-digit phone number starting with 09.');</script>";
              echo "<script>window.history.back();</script>";
              die();
          }
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script type='text/javascript'>alert('Please enter a valid email address.');</script>";
            echo "<script>window.history.back();</script>";
            die(); // Stop execution on validation failure
        }



            $check_sql = "SELECT * FROM client_info WHERE username='$username'";
            $check_result = mysqli_query($conn, $check_sql);
            
            if (mysqli_num_rows($check_result) > 0) {
                echo "<script type='text/javascript'>alert('Username already exists! Please choose a different username.');</script>";
                echo"<script>  window.history.back(); </script>";
                die();
            } else {
                $sql = "INSERT INTO client_info (Fname, Lname, gender, age, birthday, email, Phone_num, client_address, username, user_pw)
                VALUES ('$first_name', '$last_name', '$gender', '$age', '$birth_date', '$email', '$phone', '$address', '$username', '$password')";
                
                $retval = mysqli_query($conn, $sql);
                if (!$retval) {
                    echo "<script type='text/javascript'>alert('Could not add data to the table!');</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Entered data successfully');</script>";
                    echo "<script> window.location.href='index.php';</script>";
                }
            }
        }
        
?>
