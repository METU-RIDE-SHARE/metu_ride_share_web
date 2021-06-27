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
        <!-- change status (Bootstrap Modal) -->
        <div class="modal fade" id="change_status_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Request Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./includes/change_borrow_status.inc.php" method="POST">
                        <div class="modal-body">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_radio_btn" value="Accepted" id="accept_rbtn">
                                <label class="form-check-label" for="accept_rbtn">
                                    Accept
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_radio_btn" value="Rejected" id="reject_rbtn" checked>
                                <label class="form-check-label" for="reject_rbtn">
                                    Reject
                                </label>
                            </div>
                            
                            <!-- the id of the reservation_id which is hidden to the user -->
                            <input type="hidden" name="user_from_id" id="user_from_id"/>

                            <!-- the id of the taxi_id which is hidden to the user -->
                            <input type="hidden" name="car_id" id="car_id" />

                            <!-- date and times-->
                            <input type="hidden" name="from_time" id="from_time">
                            <input type="hidden" name="to_time" id="to_time">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="save_status_b"class="btn btn-primary">Save</button>
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
                                <a class="nav-link active" aria-current="page" href="#">Borrowed From Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="MyBorrow.php">My borrow Requests</a>
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
                                                borrow.from_time, borrow.to_time, borrow.user_from_id, borrow.status
                                        FROM borrow
                                        INNER JOIN car
                                        ON car.vehicle_id = borrow.car_id
                                        INNER JOIN vehicle
                                        ON vehicle.vehicle_id = car.vehicle_id
                                        WHERE car.user_from = '$current_user_id'; ";
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
                                    <th scope="col">Show Requester</th>
                                    <th scope="col">Request Status</th>
                                    <th scope="col">Change Status</th>
                                    
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
                                    <td> <div style="display: none;"><?php echo $row['user_from_id']; ?></div>
                                        <button type="button" class="btn btn-primary show_user_btn"> Show User </button>
                                    </td>
                                    <td> <?php echo $row['status']; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-primary change_status_btn"> Change Status </button>
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

        $('.change_status_btn').on('click', function(){

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            console.log(data);

            var current_status = data[7];
            console.log("-" + current_status.trim() + "-");

            if(current_status.trim() == "Pending"){
                
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

                $('#change_status_modal').modal('show');
            }
            else{
                $('#error_message').text('you have already assigned a status for this request! you cannot change it.');
                $('#error_modal').modal('show');
            }

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
            $('#error_message').text("your data has not been saved because of an internal error.");
            $('#error_modal').modal('show'); 
        }); 
    </script>
<?php }?>


</body>
</html>