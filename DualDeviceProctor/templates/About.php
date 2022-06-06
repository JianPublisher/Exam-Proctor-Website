<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DualDeviceProctor</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
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
                    <li><a href="Recordings.php">VIEW RECORDINGS</a></li>
                    <li><a href="About.php">ABOUT</a></li>
                    <li><a href="FAQs.php">FAQs</a></li>
                    <li><a href="mypage.php">MY PAGE</a></li>
                    
                    
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
            <h1>ABOUT DDTP</h1>
    </section>


<!------- about DDTP content -------->
    
<section class="about-me">
    <div class="row">
        <div class="about-col">
            <h1>Dual Device Test Proctor</h1>     
            <p>Regardless of how efficient remote learning could be, there are many drawbacks to online exams due to technology adoption challenges, infrastructure barriers, and resourceful websites that increase the susceptibility to cheating.</br></br>For that reason, few indie developers have decided to tackle this issue by introducing the Dual Device Test Proctor, an exam surveillance mobile tool designed to monitor students while detecting suspicious activity</p>
        </div>
        
        <div class="about-col">
            <img src="image/about_takingexam.png">
        </div>
    </div>   
    <div class="row">
        <div class="about-col">
            <img src="image/about_two.png">
        </div>
        <div class="about-col">
            <img src="image/about_one.png">
        </div>
        <div class="about-col">
            <p>Background Subtraction(BS) method<br><br>The background subtraction is a critical technique used to create foreground mask. In simpler terms, it focuses on a binary image containing pixels from moving objects. Through the continuous background initialization and update, it enables motion detection.</p>
        </div>
        <div class="about-col">
          <p>What the program does<br><br>During exam monitoring session, large body movements will be denoted as suspicious activity. Such movements will then trigger a short recording of the student. The short recordings are then sent to the instructor immediately for confirmation.</p>        
        </div>
    </div>
</section>





<!-------- footer ---------->
<section class="footer">
        <a href="FAQs.php" class="hero-btn red-btn">Contact us</a>
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