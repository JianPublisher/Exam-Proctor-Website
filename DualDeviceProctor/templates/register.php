<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $password = $confirm_password = $position = "";
$firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = $position_err = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
//Validate first name
if (empty($_POST["firstname"])) {
    $firstname_err = "First name is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
      $firstname_err = "Only letters and white space allowed";
    }
  }
  //Validate last name
if (empty($_POST["lastname"])) {
    $lastname_err = "Last name is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
      $lastname_err = "Only letters and white space allowed";
    }
  }

    // Validate email
    if(empty(trim($_POST["email"]))){
    $email_err = "Please enter an email.";
    } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_err =  "Invalid email format";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
      
     // Check for Account type selection
  if(isset($_POST['submit'])){
    if(!empty($_POST['position'])) {
        $position = $_POST['position'];
        echo "You have chosen: " .$position;
    } else {
        $position_err = "Account type Selection is required.";
        echo "Account type Selection is required.";
    }
    }
   
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) 
         && empty($password_err) && empty($confirm_password_err) && empty($position_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, email, userpassword, position) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", 
            $param_firstname, $param_lastname, $param_email, $param_password, $param_position);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_position = $position;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    {
            box-sizing: border-box;
        }

        /* Header */
        .header {
            padding: 100px;
            text-align: center;
            background: white;
        }

            .header h1 {
                font-size: 50px;
            }

         /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: #00aeff;
        }

            /* Style the topnav links */
            .topnav a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

                /* Change color on hover */
                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }
                
        body{ 
        font: 14px sans-serif;
        background-color: lightgray;
        }

        .wrapper{ 
        margin: 20px auto;
        width: 360px; 
        padding: 20px;
        background-color: white;
        border-width: 2px;
        border-style: solid;
        border-color: #00aeff;
        }  

    </style>
</head>
<body>

<div class="header">
        <h1>DDTP: Dual Device Test Proctor</h1>
        <p>DDTP provides remote test proctoring service with the assistance of a secondary device.</p>
    </div>

    <div class="topnav">
        <a href="login.php" style="float:right">Login</a>
        <a href="register.php" style="float:right">Register</a>
    </div>
        
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" placeholder="Enter First Name" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
            </div>  
             <div class="form-group">
                <label>Last Name</label>
                <input type="text" placeholder="Enter Last Name" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
            </div>  
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Enter Email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Enter Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

    <form action="" method="post">
    <select name="position">
        <option value="">Account Type</option>
        <option value="S">Student</option>
        <option value="T">Teacher</option>
    </select>
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
</form>

            
           
         
          
            <p>Already have an account? <a href="login.php">Login</a>.</p>
        </form>
    </div>    
</body>
</html>


          