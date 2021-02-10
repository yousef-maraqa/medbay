<?php session_start();
	include('config.php');
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: index.php");
		exit;
	}?>
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
                
                    <div id="image"> </div>
               
                <div class="container">
                    <div class="row">

                        <div class="col-xs-12 text-center">
                            <div class="menu-1">
							<ul>

<li id="user-welcome">Welcome DR. <?php echo htmlspecialchars($_SESSION["username"]); ?></li>
<li ><a href="welcome_doctor.php" title="My Appointments"><span class="size"> <i class="fas fa-calendar-check"></i></span></a></li>
<li><a class="logout_icon" href="logout.php" title="Log out"><span class="size"><i class="fas fa-sign-out-alt"></i></span></a></li>

</ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>



<div class="container">
		<div class="col-md-6 col-md-offset-3 text-center ky-heading">
			
		</div>
	<?php
	
			$id =$_POST['edit_id'];
			$query="SELECT * FROM appointment WHERE id='$id'";
			$query_run=mysqli_query($link,$query);
			foreach($query_run as $row){
	$success = $treatment_error = $treatment ="";
	if (isset($_POST['update_btn'])) { 
		if (empty($_POST["treatment"])) {
			$treatment_error = "Patient Treatment is Empty";
		  } else {
			$treatment = trim($_POST["treatment"]);}	
		
		if ($treatment_error =='' )
		{
		  
		
		$query ="UPDATE appointment SET treatment='$treatment' WHERE id='$id'";
		$query_run=mysqli_query($link,$query);
		if($query_run){
			$success = "Patient Treatment Updated.";
		}
		 
	}}
	
	 if($row['treatment'] != ''){
		$Previous ="Previous Treatment :- (".$row['treatment'].")";
		}else{
			$Previous="";	
		}
	?>

	<form action="<?php ($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="off">
		
				<input type="hidden" value="<?php echo $row['id']; ?>" name="edit_id" class="form-control">

				<div class="row form-group  <?php echo (!empty($treatment_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12" style="margin-top : 10vh;">
								<div class="color"> <?php echo $success; ?></div>
								<div><b> <?php echo $Previous;?></b></div>

									<label>(<?php echo $row['patient_name']; ?>) Treatment</label>
				<textarea name="treatment" id="message" cols="30" rows="10" class="form-control"placeholder="Patient Treatment"></textarea>
				<span class="error"><?php echo $treatment_error; ?></span>
			
				</div>
				</div>
				<div class="row form-group text-center">
				<div class="col-md-12">
				<a href="welcome_doctor.php" class="btn btn-danger">Cancel</a>
				<button class="btn btn-primary" name="update_btn">Update</button>
				</div>
				</div>



			</div>
	</form>
	<?php
							}
							 
						
						   ?>
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