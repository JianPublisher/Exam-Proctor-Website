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
                    $university= $_POST['university'];
                    $date= $_POST['date'];
                    $time= $_POST['startTime'];
                    $duration= $_POST['duration'];
                    $id=rand(6,100);
                    echo $id;


        $sql="INSERT INTO exam (examtitle, university, startdate, starttime, duration, examid) VALUES ('$name', '$university', '$date', '$time' ,'$duration','$id')";
        $response=mysqli_query($dbc, $sql);
        if($response){
            echo "<br>";
            
            echo "New Record Added Successfully!";
        }
        header("Location: teacherCalendar.php");
    }

?>