<?php

include('config.php');
 
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "UserName is required";
      } else {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\s]*$/",$username)  ) {
          $username_err = "Only letters and whitespace are allowed!"; }
        
        }
    
        
        $sql = "SELECT id FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = test_input($_POST["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken!";
            } else{
                $username = test_input($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_err = "Invalid email format"; 
        }
 }
        $sql = "SELECT id FROM users WHERE email = ?";
        if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        
        // Set parameters
        $param_email = test_input($_POST["email"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "This Email is already used.";
            } else{
                $email = test_input($_POST["email"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Validate password
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(test_input($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = test_input($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(test_input($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = test_input($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($confirm_password_err)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email , password) VALUES ('$username' , '$email' , '$password')";
         
        if(mysqli_query($link, $sql)){
            
            
            header("location: login.php");
                        
            
            } else{
                echo "Something went wrong. Please try again later.";
            }

           
        }
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    // Close connection
    mysqli_close($link);

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

                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="doctors.php">Doctors</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
        <div id="signup-container">
            <div class="form-wrap">
                <h1>Sign Up</h1>
                <p>Please fill this form to create an account</p>
                <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="error"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="error"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control"
                            value="<?php echo $confirm_password; ?>">
                        <span class="error"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>

                    </p class="bottom-text">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
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