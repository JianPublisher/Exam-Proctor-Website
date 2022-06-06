<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Scheduling Form </title>
    <link rel="stylesheet" href="css/bookingstyle.css">

</head>
<body>
    
    <div class="smart-wrap">
        <div class ="smart-container">
            <div class ="smart-header">
                <h4 class="calander">Schedule Exam Room Appointment</h4>
            </div>

            <form method="post" id="book-form">
                <div class="form-body">

                    <div class="section">
                        <label for="Examdescription" class="field-label"><b>Please Enter Exam Name</b></label>
                            <input type="text" name="name" id="Examdescription" class="gui-input" required placeholder="Class: Exam Name">
                        </label>
                    </div>

                    <div class="section">
                        <label for="Universityname" class="field-label"><b>Please Enter Student Name</b></label>
                            <input type="text" name="student" id="Universityname" class="gui-input" required placeholder="University Name">
                        </label>
                    </div>

                    <div class="section-inlined">
                         <label for="Examduration">Select New Exam Duration</label>
                            <select id="Examduration" name="duration" required="">
                                <option value="">Choose Exam duration</option>
                                <option value="30min">30 minutes</option>
                                <option value="1hour">1 hour</option>
                                <option value="2hour">2 hour</option>
                                <option value="2hour">3 hour</option>

                            </select>
                    </div>   


                </div> 

                <div class="form-footer">
                    <button type="submit" name="submit" class="button btn-primary">Confirm Appointment</button>
                    <button type="reset" class="button" onclick="location.href='teacherCalendar.php';">Cancel</button>
                </div> 

            </form>

        </div>
    </div>
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

    if(isset($_POST['submit'])){
        $name= $_POST['name'];
        $student= $_POST['student'];
        $duration= $_POST['duration'];
 
        $sql="UPDATE exam NATURAL JOIN usersinexam SET duration='$duration' WHERE email='$student' AND examtitle='$name'";
        $response=mysqli_query($dbc, $sql);
        if($response){
            echo "<br>";
            
            echo "Updated Successfully!";
        }
        header("teacherCalendar.php");
    }

?>