<?php
//START SESSION
session_start();

//Create Constants to store non-repeating values
define('SITEURL','http://localhost/Shins_Final/');
            define('LOCALHOST', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD','');
            define('DB_NAME','clients');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //Selecting Database

?>
