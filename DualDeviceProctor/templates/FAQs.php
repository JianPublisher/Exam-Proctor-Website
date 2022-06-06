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
            <h1>FAQs</h1>
            </section>
    
             <!-- Questions -->

        <section class="faq-container">
            <div class="faq-one">
                <h2 class="faq-page">How do I schedule an exam meeting</h2>
                <div class="faq-body">
                    <p>Navigate to the Exam Meeting page, and below you can see a calander that displays upcoming events. On the side there is a schedule exam meeting button. Once clicked, a schedule meeting form will be shown.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
                <h2 class="faq-page">What is the maximum time of the recorded video ?</h2>
                <div class="faq-body">
                    <p>The default maximum time of the recorded video is set to 20.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <h2 class="faq-page">Does the program detect other movements such as eye tracking and mouth movement</h2>
                <div class="faq-body">
                    <p>The Dual Device Test Proctor is always looking for improvement to make testing envuronment better. That being said, those features might be added to DDTP in the future! Movement tracking along with gaze and mouth tracking, how cool is that! </p>
                </div>
            </div>
</section>

<section class="contact-me">
            <div class="row">
                <div class="contact-col">
                    <div>
                        <i class="fa fa-envelope-o"></i>
                        <span>
                            <h5>DDTPSUPPORT@gmail.com</h5>
                            <p>If you have any other questions, please drop a message below</p>
                        </span>
                    </div>
                </div>
                <div class="contact-col">
                    <form method="post" action="FAQs.php">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <input type="text" name="subject" placeholder="Enter your subject" required>
                    <textarea rows="8" name="message" placeholder="Message" required></textarea>
                    <button type="submit" name="Submit" class="hero-btn red-btn">Send Message</button>
                    </form> 
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

<?php
                //link to database ( localhost for now )
                DEFINE ('DB_USER', 'root');
                DEFINE ('DB_PASSWORD', '');
                DEFINE ('DB_HOST', 'localhost');
                DEFINE ('DB_NAME', 'dualdeviceproctor');
                // $dbc will contain a resource link to the database
                // @ keeps the error from showing in the browser
                $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                OR die('Could not connect to MySQL Database: ' .
                mysqli_connect_error());

    // Create a query for the database
//add data 
if(isset($_POST['Submit'])==TRUE){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
    $message  = $_POST['message'];

	
	$query = "INSERT INTO tbl_blog (name,email,subject,message)
		 VALUES ('$name','$email','$subject','$message')";      //WHERE email='$_SESSION['username'];

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);

    // If the query executed properly proceed
    if($response){

    

    echo 'Data sent successfully';

    } else {

    echo "Couldn't connect to the database<br />";

    echo mysqli_error($dbc);

    }
}

    // Close connection to the database
    mysqli_close($dbc);

  ?>