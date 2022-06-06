<!--Creating Exam Appointment-->

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

            <form method="post" action="insertExam.php" id="book-form">
                <div class="form-body">

                    <div class="section">
                        <label for="Examdescription" class="field-label"><b>Please Enter Exam Name</b></label>
                            <input type="text" name="name" id="Examdescription" class="gui-input" required placeholder="Class: Exam Name">
                        </label>
                    </div>

                    <div class="section">
                        <label for="Universityname" class="field-label"><b>Please Enter University Name</b></label>
                            <input type="text" name="university" id="Universityname" class="gui-input" required placeholder="University Name">
                        </label>
                    </div>

                    <div class="section-inlined">
                        <label for="Examdate">Select Date</label>
                             <input type="date" id="Examdate" name="date" required="">
                    </div>

                    <div class="section-inlined">
                        <label for="Examtime">Select Start Time</label>
                             <input type="time" id="Examtime" name="startTime" required="">
                    </div>



                    <div class="section">
                        <label for="duration" class="field-label"><b>Please Enter Duration</b></label>
                            <input type="text" name="duration" id="duration" class="gui-input" required placeholder="hh:mm:ss">
                        </label>
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