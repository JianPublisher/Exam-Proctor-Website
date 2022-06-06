<?php
include("config.php");
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

        .container{ 
        margin: 20px auto;
        width: auto; 
        padding: 40px;
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
                <li><a href="Recordings.php">VIEW RECORDINGS</a><li>
                <li><a href="About.php">ABOUT</a></li>
                <li><a href="FAQs.php">FAQs</a></li>
                <li><a href="mypage.php">MY PAGE</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
            <h1>View Recordings</h1>
    </section>




 
     <?php
     $fetchVideos = mysqli_query($link, "SELECT * FROM videos ORDER BY id DESC");
     while($row = mysqli_fetch_assoc($fetchVideos)){
       $location = $row['location'];
       $name = $row['name'];
       echo "<div style='float: left; margin-left:10px; margin-right: 10px; margin-top:10px;'>
          <video src='".$location."' controls width='320px' height='320px' ></video>     
          <br>
          <span>".$name."</span>
       </div>";
     }
     ?>
 



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