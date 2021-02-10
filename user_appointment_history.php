<?php
session_start();
include('config.php');
if (isset($_SESSION['previous'])) {
	if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
		$_SESSION = array();
		 session_destroy();}}
		 if (isset($_SESSION['previousA'])) {
			if (basename($_SERVER['PHP_SELF']) != $_SESSION['previousA']) {
				$_SESSION = array();
				 session_destroy();}}
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
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
									<li><a href="pass_change.php" title="Change Password"><span class="size"> <i class="fa fa-lock"></i></span></a></li>
									<li><a class="logout_icon" href="logout.php" title="Log out"><span class="size"><i class="fas fa-sign-out-alt"></i></span></a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</nav>


		<h1 class ="text-center pass_change_mar">My <span class="color">Appointments</span></h1>
		<?php
					$username = htmlspecialchars($_SESSION["username"]);
					
					$result = mysqli_query($link, "SELECT * FROM appointment WHERE username='$username'");
					?>
		<?php 
								if(mysqli_num_rows($result)>0)

							{
								
					 ?>
		<div class="table-responsive">
			<table class="table table-borderd" id="appoTable" cellspacing="0">
				<thead>
					<tr>
						<th>Doctor</th>
						<th>Clinic</th>
						<th>Patient Name</th>
						<th>BirthDate</th>
						<th>Gender</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Appointment Date</th>
						<th>Appointment Time</th>
						<th>Treatment</th>
						<th>Delete</th>

					</tr>
				</thead>
				<tbody>
					<?php while($row= mysqli_fetch_assoc($result)){?>
					<tr>
						<td><?php echo $row['doctor']; ?></td>
						<td><?php echo $row['clinic']; ?></td>
						<td><?php echo $row['patient_name']; ?></td>
						<td><?php echo $row['age']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone_number']; ?></td>
						<td><?php echo $row['appointment_date']; ?></td>
						<td><?php echo $row['appointment_time']; ?></td>
						<td><?php echo $row['treatment']; ?></td>


						<td>
							<?php
							 if (isset($_POST['delete_btn'])) {
								$id =$_POST['delete_id'];
								$query="DELETE  FROM appointment WHERE id='$id' ";
								$query_run=mysqli_query($link,$query);
								header('location:user_appointment_history.php');
							 }
							 ?>
							<form  autocomplete="off" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
								<input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
								<button name="delete_btn" type="submit" class="btn btn-danger">DELETE</button>
							</form>
						</td>




					</tr>
					<?php
				}
					}
					else{
					$noRecord= "No Appointments Booked";
					?>
					<div class="table text-center">
						<h1 class="color"><?php echo $noRecord; ?></h1>
					</div>
					<?php	
				} ?>


				</tbody>
			</table>

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