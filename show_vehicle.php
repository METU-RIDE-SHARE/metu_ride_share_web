<?php include_once 'header.php'?>
    <body>
            <div class="container">
                <div class="jumbotrom">

                    <div class="card">
                        <h2> Vehicle Details</h2>
                    </div>


                    <!-- ******************************************************************************************** -->
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
                                
                                
                                if(isset($_GET["vehicle_id"])){
                                    $user_id = $_GET["vehicle_id"];
                                    

                                    $query = "  SELECT * FROM vehicle v
                                                WHERE v.vehicle_id = '$user_id';";
                                    $query_run = mysqli_query($connection, $query);
                                    if($query_run)  {
                                        $row = $query_run -> fetch_array(MYSQLI_ASSOC);  
                                        if($row){
                                            echo "<p><strong>Vehicle Model: </strong>". $row['vehicle_model']."</p>";
                                            echo "<p><strong>Vehicle Capacity: </strong>". $row['vehicle_capacity']."</p>";
                                            echo "<p><strong>Plate Number: </strong>". $row['license_plate_no']."</p>";
                                            echo "<p><strong>Vehicle Color: </strong>". $row['vehicle_color']."</p>";
                                        }else{
                                            echo "the vehicle is not found!";
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
      
	
	</body>
</html>