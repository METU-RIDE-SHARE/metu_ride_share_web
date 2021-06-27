<?php include_once 'headertaxi.php'?>
    <body>

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2>  Your taxi Information</h2>
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
                            
                            $current_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            $current_date = date('y-m-d h:i:s');

                            $query = "  SELECT *
                                        FROM taxi
                                        WHERE vehicle_id = $current_user_id
                                        ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Mail</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Facebook</th>
                                    <th scope="col">WhatsApp</th>
                                    <th scope="col">company</th>
                                    <th scope="col">city</th>
                                    <th scope="col">license number</th>
									
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['mail']; ?> </td>
                                    <td> <?php echo $row['first_name']; ?> </td>
                                    <td> <?php echo $row['surname']; ?> </td>
                                    <td> <?php echo $row['phone']; ?> </td>
                                    <td> <?php echo $row['facebook']; ?> </td>
									<td> <?php echo $row['WhatsApp']; ?> </td>
                                    <td> <?php echo $row['company_name']; ?> </td>
                                    <td> <?php echo $row['city']; ?> </td>
                                    <td> <?php echo $row['licence number']; ?> </td>
									
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

	

    </body>
</html>
