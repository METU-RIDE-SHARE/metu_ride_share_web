<!DOCTYPE HTML>

<html>

<head>
  <title>Registration</title>

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
		$metuMail = $_POST['metu_mail'];
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$facebook = $_POST['facebook'];
		$whatsapp = $_POST['whatsapp'];
		$phone = $_POST['phone'];
		$pass = $_POST['pass1'];
		
		$allusers=mysqli_query($link,"SELECT * FROM metu_users where metu_mail='$metuMail'");
		if(mysqli_num_rows($allusers)>0)
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
			$sql = "INSERT INTO metu_users (metu_mail,first_name,surname,phone,facebook,WhatsApp,password)
				  VALUES ('$metuMail','$firstname', '$surname','$phone','$facebook','$whatsapp','$pass')";

			$result = mysqli_query($link,$sql);

			if ($result)
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
	<div class="panel-heading">Registration form</div>
	<div class="panel-body">

		<form method=POST action=registration.php>

			<div class="form-group">
				<label>Metu Mail:</label>
				<input type="email" class="form-control" name="metu_mail" required/>
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

