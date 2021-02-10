<?php 

 session_start();
 if (isset($_SESSION['previous'])) {
	if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
		$_SESSION = array();
		 session_destroy();}}
		 if (isset($_SESSION['previousA'])) {
			if (basename($_SERVER['PHP_SELF']) != $_SESSION['previousA']) {
				$_SESSION = array();
				 session_destroy();}}

 include('config.php');
 $name_error = $email_error = $phone_error = $subject_error = $message_error = $contact_form_err = "";
 $name = $email = $phone = $message  = $subject = $success = $failed = "";
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
	 if (empty($_POST["name"])) {
		 $name_error = "Name is required";
	   } else {
		 $name = test_input($_POST["name"]);
		 // check if name only tains letters and whitespace
		 if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		   $name_error = "Only letters and white space allowed"; 
		 }
	   }
	   if (empty($_POST["email"])) {
		 $email_error = "Email is required";
	   } else {
		 $email = test_input($_POST["email"]);
		 // check if e-mail address is well-formed
		 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		   $email_error = "Invalid email format"; 
		 }
	   }
	   if (empty($_POST["phone"])) {
		 $phone_error = "Phone is required";
	   } else {
		 $phone = test_input($_POST["phone"]);
		 // check if e-mail address is well-formed
		 if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)){
		   $phone_error = "Invalid phone number"; 
		 }
	   }
	   if (empty($_POST["subject"])) {
		 $subject_error = "Adding a Subject is required";
	   } else {
		 $subject = test_input($_POST["subject"]);}
 
		 if (empty($_POST["message"])) {
		   $message_error = "Message is Empty";
		 } else {
		   $message = test_input($_POST["message"]);}

		   $check="SELECT * FROM contact
		   WHERE name = '$_POST[name]'
		   AND email = '$_POST[email]'
		   AND phone = '$_POST[phone]'
		   AND subject = '$_POST[subject]'
		   AND message = '$_POST[message]'";
   			$rs = mysqli_query($link,$check);
   $data = mysqli_fetch_array($rs, MYSQLI_NUM);
   if($data > 1) {
	   $contact_form_err = "Message already sent. Thank you.";}
	   
	   
	   if ($name_error == '' && $email_error == '' && $phone_error == '' && $subject_error == '' && $message_error == '' && $contact_form_err =='' )
	   {
		 $sql = "INSERT INTO contact (name,email,phone,subject,message)
		 VALUES ('$name','$email','$phone','$subject','$message')";
		 if(mysqli_query($link, $sql)){
			 $success = "Message sent, thank you for contacting us!";
			 //reset form values to empty strings
			
			 $name = $email = $phone = $subject = $message = '';
			 
		 }else{
		   $failed = "Something went wrong. Please try again.";
		 }}
 
	 }
	 function test_input($data) {
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
	   }
	   mysqli_close($link);
 
 
 

 ?>
<!DOCTYPE html>

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
		<!-- login navbar -->
		<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){     ?>
		<nav class="ky-nav" role="navigation">
			<div class="top-menu sticky" id="nav-1">
				<ul id="phpitems">
					<li id="user-welcome">Hi <?php echo htmlspecialchars($_SESSION["username"]); ?> </li>
					<li class=""><a href="user_appointment_history.php" title="My Appointments"><span class="size"><i class="fas fa-calendar-check"></i></span></a></li>
					<li class="btn-cta"><a href="appointment.php"><span>Book an Appointment <i class="icon-calendar3"></i></span></a></li>


				</ul>
				<div class="container">
					<div class="row">

						<div class="col-xs-12 text-center">
							<div class="menu-1">



								<ul>


									<li><a href="index.php">Home</a></li>
									<li><a href="doctors.php">Doctors</a></li>
									<li class="active"><a href="contact.php">Contact</a></li>
									<li><a class="logout_icon" href="logout.php" title="Log out"><span class="size"><i class="fas fa-sign-out-alt"></i></span></a></li>



								</ul>

							</div>
						</div>
					</div>

				</div>
			</div>
		</nav>
		<!-- logout navbar -->
		<?php } else { ?>
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
									<li class="active"><a href="contact.php">Contact</a></li>
									<li class="btn-cta"><a href="login.php"><span>Login</span></a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</nav>

		<?php } ?>
		<!--end navbar-->
		<aside id="ky-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/contact.jpg);">
						<div class="overlay"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1><strong class="color">Contact</strong> Us</h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>

		<div class="color text-center"><b> <?php echo $success; ?></b></div>
		<div class="error text-center"><b> <?php echo $contact_form_err; ?></b></div>
		<div class="error text-center"><b> <?php echo $failed; ?></b></div>

		<div id="ky-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h3>Contact Information</h3>

						<div class="row contact-info-wrap">
							<div class="col-md-4">
								<p><span><i class="icon-location"></i></span> AZ Zarqa, new zarqa 36-St</p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-phone"></i></span> <a
										href="tel://1234567920">+962-000-000-000</a></p>
							</div>
							<div class="col-md-3">
								<p><span><i class="icon-mail"></i></span> <a
										href="mailto:info@medbay.com">info@medbay.com</a></p>
							</div>

						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h3>Get In Touch</h3>
						<form autocomplete="off" action="<?php ($_SERVER["PHP_SELF"]) ?>" method="post">
							<div class="row form-group  <?php echo (!empty($name_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="name">Name</label>
									<input type="text" id="name" name="name" class="form-control"
										placeholder="Your name">
									<span class="error"><?php echo $name_error; ?></span>
								</div>
							</div>

							<div class="row form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="email">Email</label>
									<input type="text" id="email" name="email" class="form-control"
										placeholder="Your email address">
									<span class="error"><?php echo $email_error; ?></span>
								</div>
							</div>

							<div class="row form-group <?php echo (!empty($phone_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="phone">Phone</label>
									<input type="text" id="phone" class="form-control" name="phone"
										placeholder="Your phone number">
									<span class="error"><?php echo $phone_error; ?></span>
								</div>
							</div>
							<div class="row form-group <?php echo (!empty($subject_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Subject</label>
									<input type="text" id="subject" class="form-control" name="subject"
										placeholder="Message subject">
									<span class="error"><?php echo $subject_error; ?></span>
								</div>
							</div>

							<div class="row form-group <?php echo (!empty($message_error)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="message">Message</label>
									<textarea name="message" id="message" cols="30" rows="10" class="form-control"
										placeholder="Say something about us"></textarea>
									<span class="error"><?php echo $message_error; ?></span>
								</div>
							</div>
							<div class="form-group text-center">
								<input type="submit" value="Send Message" class="btn btn-primary">
							</div>

						</form>
					</div>
				</div>

			</div>
		</div>


		<footer id="ky-footer" role="contentinfo">
			<div class="overlay"></div>
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-3 ky-widget ">
						<h1 class="text-center"
							style="color:#fff;display: flex;justify-content: center;margin: 10vh 0;font-size: 50px;">
							<span class="color">Med</span>Bay</h1>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-6 ky-widget text-center">
						<h3>About us</h3>
						<ul class="ky-footer-links">
							<p class="text-center">online medical reservations and free consultation,
							 Making it easier for you to book an appointment or have a consultation
							  without having to come to the clinic in person.</p>
						</ul>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-6 ky-widget text-center">
						<h3>Links</h3>
						<ul class="ky-footer-links">
							<li><a href="index.php">Home</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="doctors.php">Doctors</a></li>
							<li><a href="signup.php">Sign up</a></li>
						</ul>
					</div>



					<div class="col-md-3 col-sm-4 col-xs-6 ky-widget text-center">
						<ul class="ky-footer-links"
							style="display: flex;justify-content: space-evenly;font-size: xx-large;">

							<li><a href="#"><i class="fab fa-facebook-square color"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter-square color"></i></a></li>
							<li><a href="#"><i class="fab fa-google color"></i></a></li>
						</ul>
						<ul class="ky-footer-links"
							style="display: flex;justify-content: space-evenly;font-size: xx-large;">
							<li><a href="#"><i class="fab fa-linkedin color"></i></a></li>
							<li><a href="#"><i class="fas fa-phone color"></i></a></li>
							<li><a href="#"><i class="fas fa-comment-dots color"></i></a></li>
						</ul>
						<ul class="ky-footer-links"
							style="display: flex;justify-content: space-evenly;font-size: xx-large;">
							<li><a href="#"><i class="fas fa-map-marker-alt color"></i></a></li>
						</ul>

					</div>
				</div>
			</div>
			<div class="row copyright">
				<div class="col-md-12 text-center">

					<small class="block">© 2020-2021 MedBay | All Rights Reserved.</small>

				</div>
			</div>


		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
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