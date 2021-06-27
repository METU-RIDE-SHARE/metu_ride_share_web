<!DOCTYPE HTML>

<html>

<head>
  <title>Signing in</title>

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

    session_start();    
    if (isset($_POST['taxi_login']))
    {
		$mail = $_POST['mail'];
		$pass = $_POST['pass1'];
		$allusers=mysqli_query($link,"SELECT * FROM taxi where mail='$mail' AND password='$pass'");
		if(mysqli_num_rows($allusers)==0)
		{
			echo "<div class='container p-3' style='width:520px;'>
							<div class='panel panel-danger'>
								<div class='panel-heading'>Signing in FAILED!</div>
								<div class='panel-body'>Email or password are incorrect</div>
							</div>
				</div>"	;		
		}
		else
		{
			$row = mysqli_fetch_assoc($allusers);
			$_SESSION['currentUserMail'] = $mail;
			$_SESSION['currentUserID'] = $row['id'];
			$_SESSION['currentUserFName'] = $row['first_name'];
			$_SESSION['currentUserSName'] = $row['surname'];
			$_SESSION['currentUserPhone'] = $row['phone'];
			$_SESSION['currentUserFB'] = $row['facebook'];
			$_SESSION['currentUserWhats'] = $row['WhatsApp'];


			echo "<div class='container p-3' style='width:520px;'>
							<div class='panel panel-danger'>
								<div class='panel-heading'>Signing in successfull!</div>
								
							</div>
				</div>"	;
			header("Location:taxi_reservation_taxi.php");

            exit;
			
		}
    }
?>

<div class="container p-4" style="width:520px;">

	<p> <b>Sign in</b></p>
	
	<div class="panel panel-default">
	<div class="panel-heading">Taxi Login form</div>
	<div class="panel-body">

		<form method=POST action=taxi_login.php>

			<div class="form-group">
				<label>Taxi mail:</label>
				<input type="email" class="form-control" name="mail" required/>
			</div>

			
			<div class="form-group">
				<label>Password:</label>
				<input type="password" class="form-control"  required name="pass1" onChange="form.pass2.pattern=this.value" />
			</div>

			
			<div class="form-group">
			   <!-- <label>Confirm</label> -->
				<input type="submit" class="btn btn-primary" name="taxi_login" />
			</div>
			
			
			
			<div class="text-center">Don't have an account? <a href="registration.php">Sign up</a></div>
			
		</form>
	 </div>
	 </div>

</div>
</body>
</html>
