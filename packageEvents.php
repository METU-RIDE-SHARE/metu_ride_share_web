<?php include_once 'header.php'?>

    <body>
		
		<div class="container">
			<div class="jumbotrom">

				<div class="card">
					<h2>  Package Events</h2>
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

                            $query = "  SELECT * FROM package";
							
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Car Id</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Event Details</th>
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['car_id']; ?> </td>
                                    <td> <?php echo $row['weight']; ?> </td>
                                    <td> <?php echo $row['content']; ?> </td>
									<td> <div style="display: none;"><?php echo $row['eid']; ?></div>
									<button type="button" class="btn btn-primary show_event_details_btn"> Show Details</button>
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
        $('.show_event_details_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

				var owner_id = data[3];
                window.location.href = "./show_specific_event.php?event_id=" + owner_id;
        });


    });
	
    </script>

    </body>
</html>
