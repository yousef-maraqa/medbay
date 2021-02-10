<?php
// Initialize the session
session_start();
if (isset($_SESSION['previous'])) {
	if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
		$_SESSION = array();
		 session_destroy();}}
		 if (isset($_SESSION['previousA'])) {
			if (basename($_SERVER['PHP_SELF']) != $_SESSION['previousA']) {
				$_SESSION = array();
				 session_destroy();}}
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$old_password = $new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = $old_password_err ="";
$_SESSION["id"];
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
//  sadddddddddddddddd
    if(empty(trim($_POST["old_password"]))){
        $old_password_err = "Please enter the current password."; 
    } else{
        $result = mysqli_query($link, "SELECT * from users WHERE Id='" . $_SESSION["id"] . "'");
    $row = mysqli_fetch_array($result);
    if (password_verify($_POST["old_password"] , $row["password"])){
        $old_password = trim($_POST["old_password"]);
    }
    else {
        $old_password_err = "Didn't match the current password";
    }
            
        
}
        
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)&&empty($old_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MedBay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="css/flexslider.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

    <!-- the site tab Logo -->

    <link rel="shortcut icon" type="image/png" href="./images/medbay-titel.PNG">

    <!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <div class="ky-loader"></div>
    <div id="page">
        <nav class="ky-nav" role="navigation">
            <div class="top-menu sticky" id="nav">
                <a href="index.php">
                    <div id="image"> </div>
                </a>
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 text-center">
                            <div class="menu-1">


                                <ul>

                                    <li id="user-welcome">Hi <?php echo htmlspecialchars($_SESSION["username"]); ?></li>
                                    <li class="btn-cta"><a href="appointment.php"><span>Book an Appointment <i class="icon-calendar3"></i></span></a></li>
                                    <li class=""><a href="user_appointment_history.php" title="My Appointments"><span class="size"><i class="fas fa-calendar-check"></i></span></a></li>
                                    <li><a class="logout_icon" href="logout.php" title="Log out"><span class="size"><i class="fas fa-sign-out-alt"></i></span></a></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row pass_change_mar">
                <div class="col-md-6 col-md-offset-3 text-center ky-heading">
                    <h2>Reset Password</h2>
                    <p>Please fill out this form to reset your password.</p>
                    <p><b class="error">Notice :-</b> you'll be logged out after the password is changed.</p>
                </div>
            </div>
            <form autocomplete="off" action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="form-group <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
                    <label>Old Password</label>
                    <input type="password" name="old_password" class="form-control"
                        value="<?php echo $old_password; ?>">
                    <span class="help-block"><?php echo $old_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control"
                        value="<?php echo $new_password; ?>">
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-danger" href="index.php">Cancel</a>
                </div>


        </div>
        </form>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="js/jquery.waypoints.min.js"></script>
    <!-- Stellar Parallax -->
    <script src="js/jquery.stellar.min.js"></script>
    <!-- Carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Flexslider -->
    <script src="js/jquery.flexslider-min.js"></script>
    <!-- countTo -->
    <script src="js/jquery.countTo.js"></script>
    <!-- Magnific Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <!-- Sticky Kit -->
    <script src="js/sticky-kit.min.js"></script>
    <!-- Main -->
    <script src="js/main.js"></script>
</body>

</html>