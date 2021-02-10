<?php
session_start();
 

 
include('config.php');
 
$username = $password =$email = "";  $dname = $dpassword = "";

$username_err = $password_err  = $form_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dname = $_POST['username'];
    $dpassword = $_POST['password'];
    $sql = "SELECT id FROM doctors WHERE dname = '$dname' and dpassword = '$dpassword'";
	 $result = mysqli_query($link,$sql);
	 $row = mysqli_fetch_array($result);
	 $count = mysqli_num_rows($result);
	 
	 // If result matched $dname and $dpassword, table row must be 1 row
	   
	 if($count == 1) {
		 $_SESSION["loggedin"] = true;
		 $_SESSION["id"] = $id;
		 $_SESSION["username"] = $dname;                            
							 
							 
		
		header("location: welcome_doctor.php");}
     
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username or email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err) && empty($form_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ? or email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username ,$param_email);
            
            $email=$_POST["username"];
            // Set parameters
            $param_username = $username;
            $param_email=$email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username,$hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                            if($_POST["username"]=="admin" || $_POST["username"]=="info@medbay.com"){
                                header("location: ./admin/usersA.php");
                            }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $form_err = "The username or password is incorrect.";
                }
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


if (isset($_SESSION['previousA'])) {
	if (basename($_SERVER['PHP_SELF']) != $_SESSION['previousA']) {
		$_SESSION = array();
         session_destroy();}}
         
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


                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="doctors.php">Doctors</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
        <div id="login-container">
            <div class="form-wrap">
                <h1>Login</h1>
                <p>Please fill in your credentials to login.</p>
                <span class="error" style="display: block;text-align: center;"><?php echo $form_err; ?></span>

                <form  autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username / Email</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>

                    <button type="submit" class="btn btn-primary">login</button>

                    <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
                </form>
            </div>
        </div>
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