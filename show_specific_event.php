<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="taxi_reservation_user" content="width=device-width, initial-scale=1.0">
        <title>Specific Event</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-light static-top" style="background-color:#00C0CE;">
			<div class="container">
				<!--<a class="navbar-brand" href="#">
					<img src="pictures/logo.png" alt="">
				</a>-->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="main.html">Home
							</a>
						</li>
						
						
						<!--<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Events
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">All Events</a>
								<a class="dropdown-item" href="#">Ride Events</a>
								<a class="dropdown-item" href="#">Package Events</a>
							</div>
						 </li>-->
						 
						<li class="nav-item">
							<a class="nav-link" href="#">Package Events</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Ride Events</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="taxies.php">Taxies</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="taxi_reservation_user.php">Taxi Reservations</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cars.php">Cars</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">sss</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="userAccount.php"><img src="pictures/person-circle.svg" class="img-fluid " alt=""></a>
						</li>
					</ul>
					
				</div>
			</div>
		</nav>
		
		<div class="container" style="background-color:black; margin-top:20px; margin-bottom:20px;">
			<h1 style="color:white; text-align:center;"> METU RIDE SHARE </h1>
		</div>
	</head>
    <body>

        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2>  Event Details</h2>
                </div>


                <div class="card">
                    <div class="card-body">
                    
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                                exit();
                            }
                            
                            //$current_metu_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            //$current_date = date('y-m-d h:i:s');
							$event_id = $_GET["event_id"];
                            $query = "  SELECT * FROM event where event_id = '$event_id'";
							
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departure</th>
									<th scope="col">Notes</th>
									<th scope="col">Creator</th>
									<th scope="col">Responsible User</th>
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['datetime']; ?> </td>
                                    <td> <?php echo $row['event_status']; ?> </td>
                                    <td> <?php echo $row['price']; ?> </td>
                                    <td> <?php echo $row['destination']; ?> </td>
									<td> <?php echo $row['departure']; ?> </td>
									<td> <?php echo $row['note']; ?> </td>
									<td> <div style="display: none;"><?php echo $row['creator_id']; ?></div>
									<button type="button" class="btn btn-primary show_creator_user_btn"> Show User </button>
									</td>
									<td> <div style="display: none;"><?php echo $row['responsible_user_id']; ?></div>
									<button type="button" class="btn btn-primary show_responsible_user_btn"> Show User </button>
									</td>
                                </tr>
                            </tbody>
                        <?php       
                                }
                            }
                            else{
                                //TODO: the message is not shown: show it in the taxi_reservatio_user.php page
                                echo "No Record Found";
                            }
                        ?>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    

	<script>
    $(document).ready(function(){
        $('.show_creator_user_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

				var owner_id = data[7];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });


    });
	
	$(document).ready(function(){
        $('.show_responsible_user_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

				var owner_id = data[8];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });


    });
	
    </script>

    </body>
</html>
