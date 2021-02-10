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
						<a href="usersA.php">Users</a>

					</li>
					<li>
						<a href="doctorsA.php">Doctors</a>
					</li>
					<li class="active">
						<a href="appointmentA.php">Appointments</a>

					</li>
					<li>
						<a href="free_consultationA.php">Consultations</a>

					</li>
					<li>
						<a href="contactA.php">Contact</a>

					</li>
					
				</ul>
				<ul class="list-unstyled components mb-5">
					<li>
						<a class="btn btn-danger" href="../logout.php">logout</a>
					</li>
				</ul>

		</nav>

		<!-- Page Content  -->
		<div id="content" class="p-4 p-md-5 pt-5">


			<?php
					
					
					$result = mysqli_query($link, "SELECT * FROM appointment ");
					$row_num=mysqli_num_rows($result);

					?>
			<?php 
								if(mysqli_num_rows($result)>0)

							{
								
					 ?>
			<div class="table-responsive">
				<table class="table table-borderd" id="appoTable" cellspacing="0">
					<thead>
						<tr>
							<th>User</th>
							<th>Doctor</th>
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
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['doctor']; ?></td>
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
							 if (isset($_POST['delete_btn_A'])) {
								$id =$_POST['delete_id'];
								$query="DELETE  FROM appointment WHERE id='$id' ";
                                $query_run=mysqli_query($link,$query);
                                header('location:appointmentA.php');
						   	}
						   ?>
								<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
									<input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
									<button name="delete_btn_A" type="submit" class="btn btn-danger">DELETE</button>
								</form>
							</td>




						</tr>
						<?php
				}
				echo '<h5>'.'Number Of Appointments :   ' .$row_num. '</h5>';

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