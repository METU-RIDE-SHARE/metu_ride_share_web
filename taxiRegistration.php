<!DOCTYPE HTML>

<html>

<head>
  <title> Taxi Registration</title>

      <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	

<div class="p-5 text-center" style="background-color:black;">
    <h1 style="color:white;"> METU RIDE SHARE </h1>
</div>
</head>
<body>


<?php

	require('database.php');

    
    if (isset($_POST['save']))
    {
		$mail = $_POST['mail'];
		$license_number = $_POST['license_number'];
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$facebook = $_POST['facebook'];
		$whatsapp = $_POST['whatsapp'];
		$phone = $_POST['phone'];
		$company_name = $_POST['company_name'];
		$city = $_POST['city'];
		$pass = $_POST['pass1'];
		
		$vehicle_color = $_POST['vehicle_color'];
		$plate_number = $_POST['plate_number'];
		$vehicle_capacity = $_POST['vehicle_capacity'];
		$vehicle_model = $_POST['vehicle_model'];
		
		$taxiDrivers=mysqli_query($link,"SELECT * FROM taxi where mail='$mail'");
		if(mysqli_num_rows($taxiDrivers)>0)
		{
			echo "<div class='container p-3' style='width:520px;'>
							<div class='panel panel-danger'>
								<div class='panel-heading'>Registration FAILED!</div>
								<div class='panel-body'>Email Already Exists</div>
							</div>
				</div>"	;		
		}
		else
		{
			$sql = "INSERT INTO `vehicle` (`vehicle_color`,`license_plate_no`,`vehicle_capacity`,`vehicle_model`)
				  VALUES ('$vehicle_color','$plate_number', '$vehicle_capacity','$vehicle_model')";
			$last_id='';
			if ($link->query($sql) === TRUE) {

				$last_inserted_query = "SELECT * FROM vehicle";
				$query_run = mysqli_query($link,$last_inserted_query);
				
				foreach ($query_run as $row){
					$last_id = $row['vehicle_id']; 
				}

			} else {
				echo "<script>alert('Opps, an error happened!!');</script>";
			}
			echo $last_id;
			$addTaxi = "INSERT INTO `taxi` (`vehicle_id`,`mail`,`licence number`,`first_name`,`surname`,`phone`,`facebook`,`WhatsApp`,`company_name`,`city`,`password`)
				  VALUES ('$last_id','$mail','$license_number','$firstname', '$surname','$phone','$facebook','$whatsapp','$company_name','$city','$pass')";

			$addTaxisql = mysqli_query($link,$addTaxi);

			if ($addTaxisql)
			{ 
			echo "
				<div class='container p-3' style='width:520px;'>
							<div class='panel panel-success'>
								<div class='panel-heading'>Success!</div>
								<div class='panel-body'>Your registration was successful.</div>
								<div <br/>Click here to <a href='login.php'>Login</a>. </div>
							</div>
				</div>" ;
			//echo "Success!"; 
			}
			else  {
			//mysqli_error()) 
			echo "MySQL Error: "; 
			}
		}
    }
?>

<div class="container p-4" style="width:520px;">
	
	<p> <b>Create your account</b></p>
	
	<div class="panel panel-default">
	<div class="panel-heading"> Taxi Driver Registration form</div>
	<div class="panel-body">

		<form method=POST action=taxiRegistration.php>

			<div class="form-group">
				<label>Mail:</label>
				<input type="email" class="form-control" name="mail" required/>
			</div>

			<div class="form-group">
				<label>License Number:</label>
				<input type="text" class="form-control"  name="license_number" required/>
			</div>
			
			<div class="form-group">
				<label>First Name:</label>
				<input type="text" class="form-control"  name="firstname" required/>
			</div>
			
			<div class="form-group">
				<label>Surname:</label>
				<input type="text" class="form-control"  name="surname" required/>
			</div>
			
			<div class="form-group">
				<label>Phone:</label>
				<input type="text" class="form-control"  name="phone" required/>
			</div>
			
			<div class="form-group">
				<label>Facebook:</label>
				<input type="text" class="form-control"  name="facebook" />
			</div>
			
			<div class="form-group">
				<label>WhatsApp:</label>
				<input type="text" class="form-control"  name="whatsapp" />
			</div>
			
			<div class="form-group">
				<label>Company Name:</label>
				<input type="text" class="form-control"  name="company_name" />
			</div>
			
			<div class="form-group">
				<label>City:</label>
				<input type="text" class="form-control"  name="city" />
			</div>
			
			<div class="form-group">
				<label>Vehicle Model:</label>
				<input type="text" class="form-control"  name="vehicle_model" />
			</div>
			
			<div class="form-group">
				<label>Vehicle Capacity:</label>
				<input type="text" class="form-control"  name="vehicle_capacity" />
			</div>
			
			<div class="form-group">
				<label>Plate Number:</label>
				<input type="text" class="form-control"  name="plate_number" />
			</div>
			
			<div class="form-group">
				<label>Vehicle Color:</label>
				<input type="text" class="form-control"  name="vehicle_color" />
			</div>
			
			<div class="form-group">
				<label>Password:</label>
				<input type="password" class="form-control"  required name="pass1" onChange="form.pass2.pattern=this.value" />
			</div>

			<div class="form-group">
				<label>Password confirmation:</label>
				<input type="password" class="form-control"  name="pass2" required />
			</div>
			
			<div class="form-group">
				<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
			</div>
			
			<div class="form-group">
			   <!-- <label>Confirm</label> -->
				<input type="submit" class="btn btn-primary" name="save" />
			</div>
			
			
			
			<div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
			
		</form>
	 </div>
	 </div>

</div>
</body>
</html>

