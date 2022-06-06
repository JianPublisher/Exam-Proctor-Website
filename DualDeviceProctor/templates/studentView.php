<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

if(isset($_POST['but_upload'])){
   $maxsize = 10485760; // 10MB
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "recordings/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 10MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
               // Insert record
               $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

               mysqli_query($link,$query);
               $_SESSION['message'] = "Upload successfully.";
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
   header('location: studentView.php');
   exit;
} 

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
   body{ 
        font: 14px sans-serif;
        background-color: lightgray;
        }

        .wrapper{ 
        margin: 20px auto;
        width: 600px; 
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
    <section class="sub-header">
        <nav>
        <a href="Dashboard.php">DualDeviceTestProctor</a>
        <div class="nav-links" id="navLinks" >  
                <i class="fa fa-close" onclick="hideMenu()"></i>
                <ul>
                <li><a href="Dashboard.php">HOME</a></li>
                <li><a href="Exammeeting.php">EXAM MEETING</a></li>
                <li><a href="Recordings.php">RECORDINGS</a><li>
                <li><a href="About.php">ABOUT</a></li>
                <li><a href="FAQs.php">FAQs</a></li>
                <li><a href="mypage.php">MY PAGE</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
            <h1>Recordings</h1>
    </section>

    <div class="wrapper">
    

      <!-- Upload response -->
    <?php 
    if(isset($_SESSION['message'])){
       echo $_SESSION['message'];
       unset($_SESSION['message']);
    }
    ?>
    

    <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='but_upload'>
    </form>
    </div>




<!-------- footer ---------->
<section class="footer">
        <a href="About.php" class="hero-btn red-btn">Contact us</a>
        <div class="icons">
            <a  class="fa fa-facebook"></i></a>
            <a  class="fa fa-twitter"></i></a>
            <a  class="fa fa-instagram"></i></a>
            
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