<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="css/calendar.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<style>
    table {
      width:100%;
      border:1px solid white;
    }
    
    th {
      width:100%;
      background:black;
      flex: 1 1 20%;
      text-align:center;
      text-transform:uppercase;
    }
    
    tr {
      display:flex;
      width:100%;
      
    }
    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background: #FFF}
    
    td{
      border:1px solid white;
      flex: 1 1 20%;
      text-align:center;
      color: rgba(60, 60, 60, 1);
      font-weight:bold;
    }
</style>
<body>
  <section class="sub-header">
        
    <nav>
        <div class="logo">
        <a href="Dashboard.php">DualDeviceTestProctor</a>
        </div>
        <div class="nav-links" id="navLinks" >  
            <i class="fa fa-close" onclick="hideMenu()"></i>
            <ul>
              <li><a href="Dashboard.php">HOME</a></li>
              <li><a href="Exammeeting.php">EXAM MEETING</a></li>
              <li><a href="Recordings.php">View Recordings</a><li>
              <li><a href="About.php">ABOUT</a></li>
              <li><a href="FAQs.php">FAQs</a></li>
              <li><a href="mypage.php">MY PAGE</a></li>

            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()"></i>
    </nav>
    
    </div>
</section>
  <div>
    <button style="margin-left:20px;" onclick="location.href='examscheduling.php';">Create Exam Room</button>
    <button onclick="location.href='modifyExam.php';">Modify Exam</button>
    <button onclick="location.href=exam_room.html">Enter Exam</button>
  </div>

<div>
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
    $query = "SELECT * FROM usersinexam NATURAL JOIN exam;";
      //WHERE email='$_SESSION['username'];

    // Get a response from the database by sending the connection
    // and the query
    $response = @mysqli_query($dbc, $query);

    // If the query executed properly proceed
    if($response){

    echo '<table>
      <tr>
        <th>Exam Title</th>
        <th>University Name</th>
        <th>Date</th>
        <th>Time</th>
              <th>Duration</th>
      </tr>';

    // mysqli_fetch_array will return a row of data from the query
    // until no further data is available
    while($row = mysqli_fetch_array($response)){

    echo '<tr><td>' . 
    $row['examtitle'] . '</td><td>' .
    $row['university'] . '</td><td>' . 
    $row['startdate'] . '</td><td>' .
    $row['starttime'] . '</td><td>' .
      $row['duration'] . '</td>';

    echo '</tr>';
    }

    echo '</table>';

    } else {

    echo "Couldn't issue database query<br />";

    echo mysqli_error($dbc);

    }

    // Close connection to the database
    mysqli_close($dbc);

  ?>
</div>
   

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
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>

  <script type="text/javascript" src="js/calendar.js"></script>

</body>
</html>
