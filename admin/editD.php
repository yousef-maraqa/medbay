<?php
 session_start();

include('../config.php');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
if($_SESSION["username"] == "admin"){
?>

<!doctype html>
<html lang="en">

<head>
	<title>admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
					<i class="fa fa-bars"></i>
					<span class="sr-only">Toggle Menu</span>
				</button>
			</div>
			<div class="p-4 pt-5">
				<div style="text-align: center; font-size: 2.5rem;">MED<span style="color: #71cd29;">BAY</span></div>
				<ul class="list-unstyled components mb-5">
					<li>
						<a href="usersA.php">users</a>

					</li>
					<li>
						<a href="doctorsA.php">Doctors</a>
					</li>
					<li>
						<a href="appointmentA.php">Appointment</a>

					</li>
					<li>
						<a href="contactA.php">Contact</a>

					</li>

					<li class="">
						<a href="free_consultationA.php">Free Consultation</a>

					</li>
				</ul>
				<ul class="list-unstyled components mb-5">
					<li>
						<a class="btn btn-danger" href="../logout.php">logout</a>
					</li>
				</ul>

		</nav>

		<!-- Page Content  -->

		<?php 
		if (isset($_POST['update_btn'])) { 
			$id =$_POST['edit_id'];

			$dname = $_POST['dname'];
			$dpassword = $_POST['dpassword'];
			$clinic = $_POST['clinic'];
			$experience = $_POST['experience'];
			$floor = $_POST['floor'];
			$query ="UPDATE doctors SET dname='$dname' ,dpassword= '$dpassword' , clinic ='$clinic' , experience='$experience' , floor='$floor' WHERE id='$id'";
			$query_run=mysqli_query($link,$query);
			if($query_run){
				header('location:doctorsA.php');

			}
			 
		}
		
		?>
		<?php
							if (isset($_POST['edit_btn_d'])) {
								$id =$_POST['edit_id'];
								$query="SELECT * FROM doctors WHERE id='$id'";
								$query_run=mysqli_query($link,$query);

							 

								foreach($query_run as $row)
								{
									?>







		<form action="<?php ($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="off">
			<div class="card shadow mb-4 edit_box">
				<div class="card-header py-3">
					<h3 class="m-0 font-weight-bold text-primary" id="EDT">edit doctor information</h3>

				</div>
				<div class="card-body">
					<input type="hidden" value="<?php echo $row['id']; ?>" name="edit_id" class="form-control">
					<div class="form-group">
						<label>Name</label>
						<input type="text" value="<?php echo $row['dname']; ?>" name="dname" class="form-control"
							placeholder="Enter name">

					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="text" name="dpassword" class="form-control" placeholder="Enter Password"
							value="<?php echo $row['dpassword'] ?>">

					</div>

					<div class="row form-group">
						<div class="col-md-12">
							<label>Clinic&nbsp;&nbsp;</label>
							<select class="selectpicker form-control" name="clinic" id="clinselect">
								<option></option>
								<option>Dental</option>
								<option>Orthopedic</option>
								<option>Surgical</option>
								<option>General</option>
							</select>
							<span class="help-block"> </span>
						</div>
					</div>

					<div class="form-group">
						<label>experience</label>
						<input type="text" name="experience" class="form-control" placeholder="Enter experience"
							value="<?php echo $row['experience']?>">

					</div>

					<div class="form-group">
						<label>Floor</label>
						<input type="text" name="floor" class="form-control" placeholder="Enter floor"
							value="<?php echo $row['floor'] ?>">


					</div>
					<a href="doctorsA.php" class="btn btn-danger">Cancel</a>
					<button class="btn btn-primary" name="update_btn">Update</button>




				</div>
		</form>
		<?php
								}
								 
							}
						   	?>
	</div>
	</div>



	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
<?php 
 $_SESSION['previousA'] = basename($_SERVER['PHP_SELF']);
}else{
	header("location: ../index.php");
}
 ?>