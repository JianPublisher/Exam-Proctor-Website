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

$sql ="SELECT firstname, lastname FROM users WHERE email ='{$_SESSION['email']}'";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_row($result);

$firstname = $row[0];
$lastname = $row[1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DualDeviceProctor</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .btn {
            width: 360px;
            padding: 20px;
            background-color: #00aeff;
        }

        body {
            font: 14px sans-serif;
            background-color: lightgray;
        }

        .wrapper {
            margin: 20px auto;
            width: 400px;
            padding: 20px;
            background-color: white;
            border-width: 2px;
            border-style: solid;
            border-color: #00aeff;
        }
    </style>
</head>


<body>

    <!-- nav bar -->
    <section class="header">

        <nav>
            <div class="logo">
                <a href="Dashboard.php">DualDeviceTestProctor</a>
            </div>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="Dashboard.php">HOME</a></li>
                    <li><a href="exammeeting.php">EXAM MEETING</a></li>
                    <li><a href="recordings.php">VIEW RECORDINGS</a></li>
                    <li><a href="About.php">ABOUT</a></li>
                    <li><a href="FAQs.php">FAQs</a></li>
                    <li><a href="mypage.php">MY PAGE</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <div class="text-box">
            <h1>Welcome to Dual Device Proctor</h1>
            <a href="contact.html" class="hero-btn">View Exam Meeting</a>
        </div>
    </section>

    <div class="wrapper">
        <h1>
        <?php 
        echo "User: $firstname $lastname\n"; 
        echo ($_SESSION["email"]);
        ?>
        </h1>
        <br>
        <p>
            <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
        <
    </div>

    <!-------- footer ---------->
    <section class="footer">
        <a href="about.html" class="hero-btn red-btn">Contact us</a>
        <div class="icons">
            <a class="fa fa-facebook"></i></a>
            <a class="fa fa-twitter"></i></a>
            <a class="fa fa-instagram"></i></a>

        </div>
        <a class="footer-link"><p>Developed by Justin, Somin, Hannah, and Andrew</p></a>
    </section>


    <!----JavaScript for toggle menu---->
<script>
    var navLinks = document.getElementById("navLinks");

    function showMenu() {
        navLinks.style.right = "0";
    }

    function hideMenu() {
        navLinks.style.right = "-200px";
    }
</script> 
</body>
</html>