<?php include_once 'header.php'?>

    <body>

        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2>  My Ride Events</h2>
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
                            
                            $current_metu_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            //$current_date = date('y-m-d h:i:s');
                            //$query = "  SELECT * FROM event WHERE creator_id = '$current_metu_user_id'";
							$query = "  SELECT * 
                                        FROM package p, event e
                                        WHERE p.eid = e.event_id
										AND e.creator_id = '$current_metu_user_id';
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
									<th scope="col">Car Id</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Content</th>
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
									<td> <?php echo $row['car_id']; ?> </td>
                                    <td> <?php echo $row['weight']; ?> </td>
                                    <td> <?php echo $row['content']; ?> </td>
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
