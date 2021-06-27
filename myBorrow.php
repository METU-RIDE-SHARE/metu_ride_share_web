<?php include_once 'header.php'?>


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
                    <div class="alert alert-danger" role="alert" id=error_message>
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
        <!-- Cancel TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="cancel_borrow_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Taxi Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/cancel_borrow.inc.php" method="POST">
                    <div class="modal-body">

                        <p> Do you want to cancel this borrow? </p>
                        
                        <input type="hidden" name="user_from_id" id="user_from_id"/>

                        <!-- the id of the taxi_id which is hidden to the user -->
                        <input type="hidden" name="car_id" id="car_id" />

                        <!-- date and times-->
                        <input type="hidden" name="from_time" id="from_time">
                        <input type="hidden" name="to_time" id="to_time">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="cancel_borrow_b"class="btn btn-danger">Yes</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
<!-- ################################################################################################################################## -->
        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> Borrows</h2>
                </div>

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="borrow.php">Borrowed From Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">My borrow Requests</a>
                            </li>
                        </ul>


                        <!-- ******************************************************************************************************* -->
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $connection -> connect_error;
                                exit();
                            }
                            $current_user_id = (int) $_SESSION['currentUserID'];

                            $query = "  SELECT car.vehicle_id, vehicle.vehicle_model, vehicle.license_plate_no, vehicle.vehicle_color, 
                                                borrow.from_time, borrow.to_time, car.user_from, borrow.status
                                        FROM borrow
                                        INNER JOIN car
                                        ON car.vehicle_id = borrow.car_id
                                        INNER JOIN vehicle
                                        ON vehicle.vehicle_id = car.vehicle_id
                                        WHERE borrow.user_from_id = '$current_user_id'; ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">car ID</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Plate Number</th>
                                    <th scope="col">Vehicle Color</th>
                                    <th scope="col">Requested From Time</th>
                                    <th scope="col">Requested To Time</th>
                                    <th scope="col">Show Owner</th>
                                    <th scope="col">Request Status</th>
                                    <th scope="col">Cancel Borrow</th>
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['vehicle_id']; ?> </td>
                                    <td> <?php echo $row['vehicle_model']; ?> </td>
                                    <td> <?php echo $row['license_plate_no']; ?> </td>
                                    <td> <?php echo $row['vehicle_color']; ?> </td>
                                    <td> <?php echo $row['from_time']; ?> </td>
                                    <td> <?php echo $row['to_time']; ?> </td>
                                    <td> <div style="display: none;"><?php echo $row['user_from']; ?></div>
                                        <button type="button" class="btn btn-primary show_user_btn"> Show User </button>
                                    </td>
                                    <td> <?php echo $row['status']; ?> </td>
                                    <td> 
                                        <button type="button" class="btn btn-primary cancel_btn"> Cancel </button>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        <?php       
                                }
                            }
                            else{
                                echo "No record is found due to internal error.";
                            }
                        ?>                        
                        </table>
                        <!-- *********************************************************************************************************************** -->



                    </div>
                </div>
            </div>
            
            


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
<script>
    $(document).ready(function(){
        $('.show_user_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var owner_id = data[6];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });

        $('.cancel_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var current_status = data[7];
                if (current_status.trim() == "Canceled"){
                    $('#error_message').text("You have already canceled this reservation.");
                    $('#error_modal').modal('show');
                }else{
                    $('#user_from_id').val(data[6]);
                    $('#car_id').val(data[0]);
                    
                    var htmlLocalDate = data[4];
                    var correct_format = htmlLocalDate.substring(1 ,htmlLocalDate.length-1).replace(" ", "T");
                    console.log(correct_format);
                    $('#from_time').val(correct_format);

                    var htmlLocalDate = data[5];
                    var correct_format = htmlLocalDate.substring(1 ,htmlLocalDate.length-1).replace(" ", "T");
                    console.log(correct_format);
                    $('#to_time').val(correct_format);

                    $('#cancel_borrow_modal').modal('show');
                }
        });
    });

</script>

</body>
</html>