<?php include_once 'header.php'?>

    <body>
		
        
        <!-- success modal -->
        <!-- Modal -->
        <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ride Event Created Succefully</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Ride Event Creation Failed!</h5>
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
    

        <!-- ################################################################################################################################## -->
        <!-- EDIT TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="add_event" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/create_event.php" method="POST">
                    <div class="modal-body">
                        <div class="form_group">
                            <label class="form-label">Pick-up location</label>
                            <input type="text" name="pickLoc" class="form-control" placeholder="Pick-up location" required>
                        </div>

                        <div class="form_group">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destLoc" class="form-control" placeholder="Destination" required>
                        </div>
                        
						<div class="form_group">
                            <label class="form-label">Pickup Date</label>
                            <input type="text" name="date" class="form-control" placeholder="Pickup Date" required>
                        </div>
						
						<div class="form_group">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Price" required>
                        </div>
						
						<div class="form_group">
                            <label class="form-label">Note</label>
                            <input type="text" name="note" class="form-control" placeholder="Note" required>
                        </div>
						
						<div class="form-group">
							<label id="selected">Select Event Type</label>
							<select name="eventType" class="form-select form-select-lg mb-3" id="eventType">
								<option>Choose Event Type</option>
								<option value="Ride">Ride</option>
								<option value="Package">Package Delievery</option>
							</select>
							<div id="rideType" style="display:none;">    
								<label for="seat_no">Total seat</label>
								<input type="text" class="form-control" name = "seatNo" id="seatNo" placeholder="ie.1" >
								<div class="form-check">
								<input class="form-check-input" type="radio" name="MyRadio" value="car" checked>
								<label class="form-check-label" for="flexRadioDefault1">
									Car Ride
								</label>
								</div>
								<div class="form-check">
								<input class="form-check-input" type="radio" name="MyRadio" value="taxi" >
								<label class="form-check-label" for="flexRadioDefault2">
									Taxi Ride
								</label>
								</div>
							</div>
                    
						</div>
						
                        
                    <div class="form-group">
                     <div id="packageType" style="display:none;">
                                <label for="pweight">Package weight</label>
                                <input type="text" class="form-control" name="weight" id="weight" placeholder="ie.1kg" >
                                <label for="pcontent">Package content</label>
                                <input type="text" class="form-control" name="content" id="content" placeholder="ie.'documents'" >
                     </div>
                     <br>
                    
					</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_event"class="btn btn-primary">Create</button>
                    </div>
					
					</div>
                </form>
                </div>
            </div>
        </div>
        <!-- ############################################################################################################################################# -->

		<div class="container">
			<div class="jumbotrom">

				<div class="card">
					<h2>  Ride Events</h2>
				</div>
				
				<div class="card">
                    <div class="card-body">
                        <!-- button type="button" class="btn btn-primary">Present Reservations</button -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_event">
                            Create Event
                        </button>
						
						<a href="myRideEvents.php"> <button type="button" name="my_ride_events" class="btn btn-primary">
                            My Ride Events
                        </button> </a>
                    </div>            
                </div>
        
                <div class="card">
                    <div class="card-body">
                    
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $connection -> connect_error;
                                exit();
                            }
                            
                            //$current_metu_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            //$current_date = date('y-m-d h:i:s');

                           // $query = "  SELECT * FROM package ";
							$query = "  SELECT * 
                                        FROM ride r, event e
                                        WHERE r.eid = e.event_id
                                        ";
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
									<th scope="col">Total Seats</th>
                                    <th scope="col">Ride Type</th>                                  
									<th scope="col">Vehicle Details</th>
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
									<td> <?php echo $row['total_seats']; ?> </td>
                                    <td> <?php echo $row['ride_type']; ?> </td>
									<td> <div style="display: none;"><?php echo $row['vehicle_id']; ?></div>
									<button type="button" class="btn btn-primary show_vehicle_details_btn"> Show Vehicle Details</button>
									</td>
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
                                
                                echo "No record is found due to an internal error.";
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

				var owner_id = data[9];
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

				var owner_id = data[10];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });


    });
	
	$(document).ready(function(){
        $('.show_vehicle_details_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

				var owner_id = data[8];
                window.location.href = "./show_vehicle.php?vehicle_id=" + owner_id;
        });


    });

	$('#eventType').on('change',function(){
		if( $(this).val()==="Ride"){
		$("#rideType").show()
		$("#packageType").hide()
		}
		else if ($(this).val()==="Package"){
		$("#rideType").hide()
		$("#packageType").show()
		}
		else{
		$("#packageType").hide()
		$("#rideType").hide()
		}
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
