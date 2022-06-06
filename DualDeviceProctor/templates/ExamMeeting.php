<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
 
// Define variable and initialize with empty values
$position = "";


$sql ="SELECT position FROM users WHERE email ='{$_SESSION['email']}'";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);

$position = $row[0];


if ($position == "S") {
    header("location: studentCalendar.php");
    exit;
} 
else if ($position == "T") {
    header("location: teacherCalendar.php");
    exit;
}

?>
