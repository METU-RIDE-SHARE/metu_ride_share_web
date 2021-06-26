<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="taxi_reservation_user" content="width=device-width, initial-scale=1.0">
        <title>taxi reservation for users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"> -->
		
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
						
						
						<li class="nav-item">
							<a class="nav-link" href="events.php">All Events</a>
						</li>
						 
						<li class="nav-item">
							<a class="nav-link" href="packageEvents.php">Package Events</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="rideEvents.php">Ride Events</a>
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

        
        <!-- success modal -->
        <!-- Modal -->
        <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        You data has been saved.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div> 

        <!-- error modal -->
        <!-- Modal -->
        <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        You data has NOT been saved.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
    

        <!-- ADD TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="add_reservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Taxi Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/insert_taxi_reservation.inc.php" method="POST">
                    <div class="modal-body">
                        <div class="form_group">
                            <label class="form-label">Departure</label>
                            <input type="text" name="departure" class="form-control" placeholder="Enter the Departure City">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" class="form-control" placeholder="Enter the Destination City">
                        </div>
                        
                        
                        <div class="form_group">
                            <label class="form-label">Date and Time</label>
                            <input type="datetime-local" name="date_time" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="insert_taxi_reservation_b"class="btn btn-primary">Save Reservation</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- ################################################################################################################################## -->
        <!-- EDIT TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="edit_reservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Taxi Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/update_taxi_reservation.inc.php" method="POST">
                    <div class="modal-body">

                        <div class="form_group">
                            <label class="form-label">Departure</label>
                            <input type="text" name="departure" id="departure" class="form-control" placeholder="Enter the Departure City">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" id="destination" class="form-control" placeholder="Enter the Destination City">
                        </div>
                        
                        <div class="form_group">
                            <label class="form-label">Date and Time</label>
                            <input type="datetime-local" name="date_time" id="dateTime" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                        <!-- the id of the reservation which is hidden to the user -->
                        <input type="hidden" name="update_reservation_id" id="update_reservation_id"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_taxi_reservation_b"class="btn btn-primary">Update Reservation</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> Your Taxi Reservations</h2>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- button type="button" class="btn btn-primary">Present Reservations</button -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_reservation">
                            Add Taxi Reservation
                        </button>

                    </div>            
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
                            
                            $current_metu_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            $current_date = date('y-m-d h:i:s');

                                
                            // $query = "  SELECT tr.Id, tr.datetime, tr.location, tr.destination, tr.status
                            //             FROM taxi_reservation tr
                            //             INNER JOIN metu_users mu
                            //                 ON tr.creator_id = mu.id
                            //             WHERE tr.creator_id = $current_metu_user_id
                            //                 AND datetime > '$current_date'
                            //             ORDER BY tr.datetime DESC;";

                            $query = "  SELECT tr.Id, tr.datetime, tr.location, tr.destination, tr.status
                                        FROM taxi_reservation tr
                                        INNER JOIN metu_users mu
                                            ON tr.creator_id = mu.id
                                        WHERE tr.creator_id = $current_metu_user_id
                                        ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">ID</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Show Requests</th>
                                    
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['Id']; ?> </td>
                                    <td> <?php echo $row['location']; ?> </td>
                                    <td> <?php echo $row['destination']; ?> </td>
                                    <td> <?php echo $row['datetime']; ?> </td>
                                    <td> <?php echo $row['status']; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit_btn"> EDIT </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary show_request_btn"> Requests </button>
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

    
    <!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('#tableid').DataTable();
        } );
    </script> -->

    <script>
    $(document).ready(function(){
        $('.edit_btn').on('click', function(){
            $('#edit_reservation').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_reservation_id').val(data[0])
                $('#departure').val(data[1]);
                $('#destination').val(data[2]);

                
                var htmlLocalDate = data[3];
                var correct_format = htmlLocalDate.substring(1 ,htmlLocalDate.length-1).replace(" ", "T");
        
                console.log(correct_format);
                $('#dateTime').val(correct_format);
        });

        $('.show_request_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var reservation_id = data[0];
                window.location.href = "./reservation_request_user.php?reservation_id=" + reservation_id;
        });


    });
    </script>


<?php
    $show_success_modal = false;
    $show_error_modal = false;
    if(isset($_GET['acknowledge'])){
        if($_GET['acknowledge'] == "datasaved"){
            $show_success_modal = true;
        }
        else if ($_GET['acknowledge'] == "datanotsaved"){
            $show_error_modal = true;
        } 
    } 
?>

<?php if($show_success_modal){?>
    <script>  
        $(document).ready(function(){
                $('#success_modal').modal('show'); 
        }); 
    </script>
<?php }?>

<?php if($show_error_modal){?>
    <script>  
        $(document).ready(function(){
                $('#error_modal').modal('show'); 
        }); 
    </script>
<?php }?>

    </body>
</html>
