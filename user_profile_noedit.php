<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users</title>
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
            <div class="container">
                <div class="jumbotrom">

                    <div class="card">
                        <h2> User Profile</h2>
                    </div>


                    <!-- ******************************************************************************************** -->
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
                                
                                if(isset($_GET["reservation_id"])){
                                    $reservation_id = $_GET["reservation_id"];
                                    

                                    $query = "  SELECT * FROM metu_users mu
                                                INNER JOIN taxi_reservation tr
                                                ON mu.id = tr.creator_id
                                                WHERE tr.id = '$reservation_id';";
                                    $query_run = mysqli_query($connection, $query);
                                    if($query_run)  {
                                        $row = $query_run -> fetch_array(MYSQLI_ASSOC);  
                                        if($row){
                                            echo "<p><strong>Name: </strong>". $row['first_name']."</p>";
                                            echo "<p><strong>Surname: </strong>". $row['surname']."</p>";
                                            echo "<p><strong>Phone: </strong>". $row['phone']."</p>";
                                            echo "<p><strong>Facebook: </strong>". $row['facebook']."</p>";
                                            echo "<p><strong>WhasApp: </strong>". $row['WhatsApp']."</p>";
                                            echo "<p><strong>rating: </strong>". $row['rating']."</p>";
                                            echo "<p><strong>not reviews: </strong>". $row['no_review']."</p>" ;
                                        }else{
                                            echo "the user is not found!";
                                        }
                                    }
                                    else{
                                        echo "Query is not performed successfully.";
                                    }
                                }

                                if(isset($_GET["user_id"])){
                                    $user_id = $_GET["user_id"];
                                    

                                    $query = "  SELECT * FROM metu_users mu
                                                WHERE mu.id = '$user_id';";
                                    $query_run = mysqli_query($connection, $query);
                                    if($query_run)  {
                                        $row = $query_run -> fetch_array(MYSQLI_ASSOC);  
                                        if($row){
                                            echo "<p><strong>Name: </strong>". $row['first_name']."</p>";
                                            echo "<p><strong>Surname: </strong>". $row['surname']."</p>";
                                            echo "<p><strong>Phone: </strong>". $row['phone']."</p>";
                                            echo "<p><strong>Facebook: </strong>". $row['facebook']."</p>";
                                            echo "<p><strong>WhasApp: </strong>". $row['WhatsApp']."</p>";
                                            echo "<p><strong>rating: </strong>". $row['rating']."</p>";
                                            echo "<p><strong>not reviews: </strong>". $row['no_review']."</p>";
											echo "<button type='button' class='btn btn-primary show_review_btn'> Show Reviews</button>";
                                        }else{
                                            echo "the user is not found!";
                                        }
                                    }
                                    else{
                                        echo "Query is not performed successfully.";
                                    }
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
                    <!-- ******************************************************************************************** -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
		
		<script>
		$(document).ready(function(){
			$('.show_review_btn').on('click', function(){
				$tr = $(this).closest('tr');
					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					var owner_id = <?php echo $row['id']; ?>;
					window.location.href = "./show_user_review.php?user_id=" + owner_id;
			});


		});
		</script>
	
	</body>
</html>