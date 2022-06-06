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
<section class="header">
        
        <nav>
            <div class="logo">
            <a href="Dashboard.php">DualDeviceTestProctor</a>
            </div>
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
        
        <div class="text-box" >
            <h1>Welcome to Dual Device Proctor</h1>
            <a href="Exammeeting.php" class="hero-btn">View Exam Meeting</a>
        </div>
    </section>

        
<!------ About DDTP ------>
    <section class="about-me">
    <div class="row">
        <div class="about-col">
            <h1>Exam Proctor Program</h1>     
            <p>DualDeviceProctor is an exam proctor program application that aims to improves virtual exam environment.We provide quality remote test proctoring service with the help of Artificial Intelligence</p>
            <a href="About.php" class="hero-btn red-btn">More about DDTP</a>
        </div>
        <div class="about-col">
            <img src="image/dashboardai.jpg">
        </div>
    </div>    
</section>

<!-------- footer ---------->
<section class="footer">
        <a href="FAQS.php" class="hero-btn red-btn">Contact us</a>
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