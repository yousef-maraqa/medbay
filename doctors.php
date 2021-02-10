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
 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MedBay</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Facebook and Twitter integration -->
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
									<li class="active"><a href="doctors.php">Doctors</a></li>
									<li><a href="contact.php">Contact</a></li>
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
									<li class="active"><a href="doctors.php">Doctors</a></li>
									<li><a href="contact.php">Contact</a></li>
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
					<li style="background-image: url(images/doctors.jpg);">
						<div class="overlay"></div>
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2 text-center slider-text">
									<div class="slider-text-inner">
										<h1>Our Experienced <strong class="color">Doctors</strong></h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>

		<div id="svgCloud"></div>


		<div id="ky-doctor">
			<div class="container-fluid">
				<div class="row animate-box">
					<div class="col-md-6 col-md-offset-3 text-center ky-heading">
						<h2>Professional Doctors</h2>
						<p>These are our experienced doctors divided by their clinics.</p>
					</div>
				</div>

			</div>
		</div>




		<!-- Doctor info section -->





		<section id="doctors-info-container">
			<div class="Outter-wrapper">
				<hr id="d-c">
				<h1>Dental Clinic</h1>
				<div class="inner-wrapper">


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/6.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Sansa Stark</h4>
							<h4 class="single-info">Dentist</h4>
							<h4 class="single-info">6 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 1st floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/1.jpeg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Bob Barker</h4>
							<h4 class="single-info">Dentist</h4>
							<h4 class="single-info">20 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 1st floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/3.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Mark Bowman</h4>
							<h4 class="single-info">Dentist</h4>
							<h4 class="single-info">10 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 1st floor</h4>
						</div>
					</div>



				</div>
			</div>
		</section>




		<section id="doctors-info-container">
			<div class="Outter-wrapper">
				<hr id="o-c">
				<h1>Orthopedic Clinic</h1>
				<div class="inner-wrapper">


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/8.jpeg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Mary Smith</h4>
							<h4 class="single-info">Orthopedist</h4>
							<h4 class="single-info">5 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 2nd floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/4.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Marry Lou</h4>
							<h4 class="single-info">Orthopedist</h4>
							<h4 class="single-info">4 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 2nd floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/5.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Robert Johnson</h4>
							<h4 class="single-info">Orthopedist</h4>
							<h4 class="single-info">8 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 2nd floor</h4>
						</div>
					</div>



				</div>
			</div>
		</section>




		<section id="doctors-info-container">
			<div class="Outter-wrapper">
				<hr id="s-c">
				<h1>Surgical Clinic</h1>
				<div class="inner-wrapper">


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/2.jpeg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Thomas Henry</h4>
							<h4 class="single-info">Surgeon</h4>
							<h4 class="single-info">4 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 3rd floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/7.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Alexandar James</h4>
							<h4 class="single-info">Surgeon</h4>
							<h4 class="single-info">20 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 3rd floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/10.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Edward John</h4>
							<h4 class="single-info">Surgeon</h4>
							<h4 class="single-info">12 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 3rd floor</h4>
						</div>
					</div>



				</div>
			</div>
		</section>


		<section id="doctors-info-container">
			<div class="Outter-wrapper">
				<hr id="e-c">
				<h1>Emergency Clinic</h1>
				<div class="inner-wrapper">


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/9.jpeg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Adam Rose</h4>
							<h4 class="single-info">General Doctor</h4>
							<h4 class="single-info">10 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 4th floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/11.jpg">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Lana Rodriguez</h4>
							<h4 class="single-info">General Doctor</h4>
							<h4 class="single-info">5 Years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 4th floor</h4>
						</div>
					</div>


					<div class="doctorBox">
						<div class="doctor-image-social">
							<img src="./images/12.png">
							<ul class="ky-social">
								<li><a href="#"><i class="icon-facebook2"></i></a></li>
								<li><a href="#"><i class="icon-twitter2"></i></a></li>
								<li><a href="#"><i class="icon-yahoo2"></i></a></li>
								<li><a href="#"><i class="icon-google2"></i></a></li>
							</ul>
						</div>

						<div class="doctor-info">
							<h4 class="single-info">Dr. Samantha Walker</h4>
							<h4 class="single-info">General Doctor</h4>
							<h4 class="single-info">3 years Experience</h4>
							<h4 class="single-info">Zarqa, 36St, Building NO(41), 4th floor</h4>
						</div>
					</div>



				</div>
			</div>
		</section>



		<div id="ky-register" style="background-image: url(images/img_bg_5.jpg); z-index :10000;"
			data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<div class="date-counter text-center">
							<h2>We offer <strong class="color">Free Consultation</strong></h2>
							<p><a class="btn btn-primary btn-lg" id="myBtn">Free Consultation <i
										class="icon-calendar3"></i></a></p>

							<div id="myModal" class="modal  animate-box fadeInUp ">

								<!-- Modal content -->
								<div class="modal-content">
									<span class="close">&times;</span>

									<?php
								 include('config.php');
								 $name_error = $phone_error = $email_error = $clinic_error = $doctor_error = $age_error= $message_error = $free_consultation_err = "";
								 $name =  $phone = $email = $clinic = $doctor = $age = $message  = "";
								 
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
									   
									   if (empty($_POST["phone"])) {
										 $phone_error = "Phone is required";
									   } else {
										 $phone = test_input($_POST["phone"]);
										 // check if e-mail address is well-formed
										 if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)){
										   $phone_error = "Invalid phone number"; 
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
									   if (empty($_POST["clinic"])) {
										 $clinic_error = "Adding a clinic is required";
									   } else {
										 $clinic = test_input($_POST["clinic"]);}
									   if (empty($_POST["doctor"])) {
										 $doctor_error = "Adding a doctor is required";
									   } else {
										 $doctor = test_input($_POST["doctor"]);}
									   if (empty($_POST["age"])) {
										 $age_error = "Adding a age is required";
									   } else {
										 $age = test_input($_POST["age"]);}
								 
										 if (empty($_POST["message"])) {
										   $message_error = "Message is Empty";
										 } else {
										   $message = test_input($_POST["message"]);}
											$check="SELECT * FROM free_consultation
												WHERE name = '$_POST[name]'
												AND phone = '$_POST[phone]'
												AND email = '$_POST[email]'												
												AND clinic = '$_POST[clinic]'
												AND message = '$_POST[message]'";
													$rs = mysqli_query($link,$check);
										$data = mysqli_fetch_array($rs, MYSQLI_NUM);
										if($data > 1) {
											$free_consultation_err = "Message already sent. Thank you.";}
															
									   if ($free_consultation_err == '' && $name_error == ''  && $phone_error == '' && $email_error == '' && $clinic_error == '' && $doctor_error == '' && $age_error == ''&& $message_error == '')
									   {
										 $sql = "INSERT INTO free_consultation (name,phone,email,clinic,doctor,age,message)
										 VALUES ('$name','$phone','$email','$clinic','$doctor','$age','$message')";
										 if(mysqli_query($link, $sql)){
											 //reset form values to empty strings

											 $name = $email = $phone = $clinic = $doctor = $age = $message = '';

											 
										 }else{
										   echo  "Something went wrong. Please try again.";
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

									<form action="<?php ($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="off">
										<h3 style="margin: 3vh 0;color: #000;"> <b class="color">Free</b>
											<b>Consultation</b> </h3>
										<!-- name -->
										<div class="row marg">
											<div class="col-md-6" style="display: flex;align-items: center;">
												<label>Name&nbsp;&nbsp;</label>
												<input type="text" placeholder="Name" class="form-control" name="name">
												<span class="error"><?php echo $name_error; ?></span>
											</div>
											<!-- phone -->
											<div class="col-md-6" style="display: flex;align-items: center;">
												<label>Phone&nbsp;</label>
												<input type="text" placeholder="Phone" class="form-control"name="phone">
												<span class="error"><?php echo $phone_error; ?></span>
											</div>
										</div>
										<!-- email -->
										<div class="row marg">
											<div class="col-md-6" style="display: flex;align-items: center;">
												<label>Email&nbsp;&nbsp;&nbsp;</label>
												<input type="text" placeholder="Email" class="form-control"name="email">
												<span class="error"><?php echo $email_error; ?></span>
											</div>
											<!-- clinic	-->
											<div class="col-md-6" style="display: flex;align-items: center;">
												<label>Clinic&nbsp;&nbsp;</label>
												<select class="selectpicker form-control" name="clinic" id="clinselect">
													<option></option>
													<option>Dental</option>
													<option>Orthopedic</option>
													<option>Surgical</option>
													<option>General</option>
												</select>
												<span class="error"><?php echo $clinic_error; ?></span>
											</div>
										</div>
										<!-- LL -->
										<div class="row marg">
								<div class="col-md-6" style="display: flex;align-items: center;">
									<label>Doctor&nbsp;&nbsp;</label>
									<select class="selectpicker form-control" name="doctor" id="docselect">
										<option></option>
										<option rel="Dental">Sansa Stark</option>
										<option rel="Dental">Bob Barker</option>
										<option rel="Dental">Mark Bowman</option>
										<option rel="Orthopedic">Mary Smith</option>
										<option rel="Orthopedic">Marry Lou</option>
										<option rel="Orthopedic">Robert Johnson</option>
										<option rel="Surgical">Thomas Henry</option>
										<option rel="Surgical">Alexandar James</option>
										<option rel="Surgical">Edward John</option>
										<option rel="General">Lana Rodriguez</option>
										<option rel="General">Adam Rose</option>
										<option rel="General">Samantha Walker</option>
									</select>
									<span class="error"><?php echo $doctor_error; ?></span>
								</div>
								<div class="col-md-6" style="display: flex;align-items: center;">
									<label for="age">BirthDate&nbsp;&nbsp;</label>
									<input type="date" name="age" id="age" class="form-control" placeholder="Patient Age" min="1920-01-01">
									<span class="error"><?php echo $age_error; ?></span>
								</div>
							</div>

										<!-- massege -->
										<div class="row marg">
											<div class="col-md-12">
												<label style="display: flex;">Message</label>
												<textarea name="message" id="message" cols="30" rows="5"
													class="form-control"
													placeholder="Enter a full description of the case. Please fill in the data accurately."></textarea>
													<span class="error"><?php echo $message_error; ?></span>
											</div>
										</div>
										<!-- btn -->
										<div class="marg text-center">
											<input type="submit" value="Send Message" class="btn btn-primary">
										</div>

									</form>


								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="marg"></div>

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
	<script>$(function () {

var $clinselect = $("#clinselect"),
	$docselect = $("#docselect");

$clinselect.on("change", function () {
	var _rel = $(this).val();

	$docselect.val('');

	$docselect.find("option").css("display", "none");
	$docselect.find("[rel=" + _rel + "]").show();


});
});
</script>
<!-- age date -->
<script>
		$(function () {
			var dtToday = new Date();

			var month = dtToday.getMonth() + 1;
			var day = dtToday.getDate();
			var year = dtToday.getFullYear();
			if (month < 10)
				month = '0' + month.toString();
			if (day < 10)
				day = '0' + day.toString();

			var maxDate = year + '-' + month + '-' + day;
			$('#age').attr('max', maxDate);
		});
	</script>
	<script>// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>

</html>