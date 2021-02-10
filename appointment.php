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
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include('config.php');

$user = $_SESSION["username"];
$patient_name = $age = $gender = $email = $phone_number = $clinic = $doctor = $appointment_date = $appointment_time = $success = $failed ="";
$patient_name_err =  $age_err = $gender_err = $email_err = $phone_number_err = $clinic_err = $doctor_err = $appointment_date_err = $appointment_time_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Val
    if (empty($_POST["patient_name"])) {
        $patient_name_err = "Name is required";
      } else {
        $patient_name = test_input($_POST["patient_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z\s]*$/",$patient_name)) {
          $patient_name_err = "Only letters and white space allowed"; 
        }
      }
    // Age Val
    if (empty($_POST["age"])) {
        $age_err = "Age is required";
      } else {
        $age = test_input($_POST["age"]);
        }
        // gender Val
    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required";
      } else {
        $gender = test_input($_POST["gender"]);
        }
    
    // Email Val
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_err = "Invalid email format"; 
        }
      }
    // Phone Val
    if (empty($_POST["phone_number"])) {
        $phone_number_err = "Phone is required";
      } else {
        $phone_number = test_input($_POST["phone_number"]);
        // check if e-mail address is well-formed
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone_number)){
          $phone_number_err = "Invalid phone number"; 
        }
      }
    // Clinic Val 
    if (empty($_POST["clinic"])) {
        $clinic_err = "Choosing a clinic  is required";
      } else {
        $clinic = test_input($_POST["clinic"]);
        }
    // Doctor Val
    if (empty($_POST["doctor"])) {
        $doctor_err = "Choosing a doctor is required";
      } else {
        $doctor = test_input($_POST["doctor"]);
        }
    // Appointment Date Vall 
    if (empty($_POST["appointment_date"])) {
        $appointment_date_err = "Selecting the appointment date is required";
      } else {
        $appointment_date = test_input($_POST["appointment_date"]);
        }
        // Appointment time Vall 
    if (empty($_POST["appointment_time"])) {
        $appointment_time_err = "Selecting the appointment time is required";
      }else {
        $appointment_time = test_input($_POST["appointment_time"]);
        }
  
        $check="SELECT * FROM appointment
                   WHERE appointment_time = '$_POST[appointment_time]'
                   AND appointment_date = '$_POST[appointment_date]'
                   AND doctor = '$_POST[doctor]'";
           $rs = mysqli_query($link,$check);
           $data = mysqli_fetch_array($rs, MYSQLI_NUM);
           if($data > 1) {
               $appointment_time_err = "Time is already taken. Try another time.";}
        // same time same user
               $check1="SELECT * FROM appointment
                   WHERE appointment_time = '$_POST[appointment_time]'
                   AND appointment_date = '$_POST[appointment_date]'
                   AND age = '$_POST[age]'
                   AND gender = '$_POST[gender]'
                   AND patient_name = '$_POST[patient_name]'";
           $rs1 = mysqli_query($link,$check1);
           $data1 = mysqli_fetch_array($rs1, MYSQLI_NUM);
           if($data1 > 1) {
               $appointment_time_err = "This Patient Has Another Appointment At The Same Time .";}
        

        // insert to Db
        if(empty($patient_name_err) && empty($age_err) && empty($email_err) && empty($phone_number_err) && empty($clinic_err) && empty($doctor_err) && empty($appointment_date_err) && empty($appointment_time_err)){

            $sql = "INSERT INTO appointment (username, patient_name, age, gender, email, phone_number, clinic, doctor, appointment_date, appointment_time)
                    VALUES ('$user','$patient_name', '$age', '$gender' ,'$email', '$phone_number', '$clinic', '$doctor', '$appointment_date', '$appointment_time')";
                    if(mysqli_query($link, $sql)){
						header("location: user_appointment_history.php");
						//reset form values to empty strings
            $patient_name =  $age = $gender = $email = $phone_number = $clinic = $doctor = $appointment_date = $appointment_time = "";
		} else{
            $failed = "Something went wrong. Please try again.";

            }
        }
		

       

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
	  
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

	<link rel="shortcut icon" type="image/png" href="./images/medbay-titel.PNG">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


	<script>
		$(document).ready(function () {
			$('#appTime').timepicker({

				timeFormat: 'h:mm p',
				interval: 60,
				minTime: '9',
				maxTime: '6:00pm',
				// defaultTime: '9',
				startTime: '09:00',
				dynamic: false,
				dropdown: true,
				scrollbar: false
			});
		});

	</script>
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
									<li><a class="logout_icon" href="logout.php" title="Log out"><span class="size"><i class="fas fa-sign-out-alt"></i></span></a></li>

								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</nav>



		<div id="ky-contact">

			<div class="container">
				<div class="row animate-box">
					<div class="col-md-6 col-md-offset-3 text-center ky-heading">
						<h2>Book an Appointment</h2>
						<p>Book an appointment for you, friends, or family<br>Please fill in the data accurately.</p>
						<div class="color"> <?php echo $success; ?></div>
						<div class="error"> <?php echo $failed; ?></div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8 col-md-offset-2">

						<form autocomplete="off" action="<?php $_SERVER["PHP_SELF"] ?>" method="post"
							class="appointment-wrap  animate-box">

							<div class="row form-group <?php echo (!empty($patient_name_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="fname">Patient Name</label>
									<input type="text" name="patient_name" id="fname" class="form-control"
										value="<?php echo $patient_name; ?>" placeholder="Patient Name">
									<span class="error"><?php echo $patient_name_err; ?></span>

								</div>
							</div>

							<div class="row form-group  <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="age">Patient BirthDate</label>
									<input type="date" name="age" id="age" class="form-control"
										value="<?php echo $age; ?>" placeholder="Patient Age" min="1920-01-01">
									<span class="error"><?php echo $age_err; ?></span>

								</div>
							</div>
							<div class="row form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Patient Gender</label>
									<select class="selectpicker form-control" name="gender"
										value="<?php echo $gender; ?>">
										<option></option>
										<option>Male</option>
										<option>Female</option>

									</select>
									<span class="error"><?php echo $gender_err; ?></span>
								</div>
							</div>

							<div class="row form-group  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" class="form-control"
										value="<?php echo $email; ?>" placeholder="Email Address">
									<span class="error"><?php echo $email_err; ?></span>
								</div>
							</div>

							<div class="row form-group  <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Contact Number</label>
									<input type="text" name="phone_number" id="subject" class="form-control"
										value="<?php echo $phone_number; ?>" placeholder="Contact Number">
									<span class="error"><?php echo $phone_number_err; ?></span>
								</div>
							</div>

							<div class="row form-group <?php echo (!empty($clinic_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Choose The Clinic</label>
									<select class="selectpicker form-control" name="clinic" id="clinselect"
										value="<?php echo $clinic; ?>">
										<option></option>
										<option>Dental</option>
										<option>Orthopedic</option>
										<option>Surgical</option>
										<option>General</option>
									</select>
									<span class="error"><?php echo $clinic_err; ?></span>
								</div>
							</div>
							<!-- new edit start -->

							
							<div class="row form-group  <?php echo (!empty($doctor_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Doctor</label>
									<select class="selectpicker form-control" name="doctor" id="docselect"
										value="<?php echo $doctor; ?>">
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
										<?php $result = mysqli_query($link,"SELECT * FROM doctors WHERE id > '12'");
										if(mysqli_num_rows($result)==1){
										while($row= mysqli_fetch_assoc($result)){?>
										<option rel =<?php echo $row['clinic']; ?> ><?php echo $row['dname'];}};?></option>
										<?php if(mysqli_num_rows($result)==2){
										while($row= mysqli_fetch_assoc($result)){?>
										<option rel =<?php echo $row['clinic']; ?> ><?php echo $row['dname'];}};?></option>
										<?php if(mysqli_num_rows($result)==3){
										while($row= mysqli_fetch_assoc($result)){?>
										<option rel =<?php echo $row['clinic']; ?> ><?php echo $row['dname'];}};?></option>
										<?php if(mysqli_num_rows($result)==4){
										while($row= mysqli_fetch_assoc($result)){?>
										<option rel =<?php echo $row['clinic']; ?> ><?php echo $row['dname'];}};?></option>
									</select>
									<span class="error"><?php echo $doctor_err; ?></span>
								</div>
							</div>

							<!-- Appointment Date -->
							<div
								class="row form-group  <?php echo (!empty($appointment_date_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Appointment Date</label>
									<input type="date" name="appointment_date" id="appDate" class="form-control"
										value="<?php echo $appointment_date; ?>">
									<span class="error"><?php echo $appointment_date_err; ?></span>
								</div>
							</div>
							<!-- Appointment Time -->
							<div
								class="row form-group  <?php echo (!empty($appointment_time_err)) ? 'has-error' : ''; ?>">
								<div class="col-md-12">
									<label for="subject">Appointment Time</label>
									<input type="text" name="appointment_time" id="appTime" class="form-control"
										min='09:00' max='18:00' value="<?php echo $appointment_time; ?>">
									<span class="error"><?php echo $appointment_time_err; ?></span>
								</div>
							</div>
							<!-- new edit end -->

							<div class="form-group">
							<input type="submit" value="Book Appointment" class="btn btn-primary" style="margin-top: 2vh;width: 100%;">
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
						<h3>Help</h3>
						<ul class="ky-footer-links">
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Help Disk</a></li>
							<li><a href="#">Legal & Policy</a></li>
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
	<!-- time picker -->

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
	<!-- app date -->
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
			$('#appDate').attr('min', maxDate);
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


	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

</body>

</html>