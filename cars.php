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
        <!-- Borrow car (Bootstrap Modal) -->
        <div class="modal fade" id="create_borrow_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrow request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/create_borrow.inc.php" method="POST">
                    <div class="modal-body">
                        
                        <div class="form_group">
                            <label class="form-label">From Time</label>
                            <input type="datetime-local" name="from_time" id="from_time" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                        
                        <div class="form_group">
                            <label class="form-label">To Time</label>
                            <input type="datetime-local" name="to_time" id="to_time" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                        <input type="hidden" name="user_from_id" id="user_from_id"/>
                        <input type="hidden" name="car_id" id="car_id"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_borrow_b"class="btn btn-primary">Save</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
<!-- ################################################################################################################################## -->
        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> All Cars</h2>
                </div>

                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">All Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="myCars.php">My cars</a>
                            </li>
                        </ul>
                    
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $connection -> connect_error;
                                exit();
                            }
                            
                            $query = "  SELECT * FROM car
                                        INNER JOIN vehicle
                                        ON car.vehicle_id = vehicle.vehicle_id
                                        INNER JOIN metu_users mu
                                        ON car.user_from = mu.id; ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Owner ID</th>
                                    <th scope="col">Owner Name</th>
                                    <th scope="col">Owner Surname</th>
                                    <th scope="col">Owner Phone</th>
                                    <th scope="col">Vehicle ID</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Vehicle Capacity</th>
                                    <th scope="col">Vehicle Color</th>
                                    <th scope="col">Plate No.</th>
                                    <th scope="col">Details of User</th>
                                    <th scope="col">Borrow</th>
                                    
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['id']; ?> </td>
                                    <td> <?php echo $row['first_name']; ?> </td>
                                    <td> <?php echo $row['surname']; ?> </td>
                                    <td> <?php echo $row['phone']; ?> </td>
                                    <td> <?php echo $row['vehicle_id']; ?> </td>
                                    <td> <?php echo $row['vehicle_model']; ?> </td>
                                    <td> <?php echo $row['vehicle_capacity']; ?> </td>
                                    <td> <?php echo $row['vehicle_color']; ?> </td>
                                    <td> <?php echo $row['license_plate_no']; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-primary show_user_btn"> Show User </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary borrow_btn"> Borrow </button>
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

                var owner_id = data[0];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });

        $('.borrow_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var car_id = data[4];
                console.log(car_id);

                $('#car_id').val(car_id);

                var php_var = "<?php echo $_SESSION['currentUserID']; ?>";
                console.log("current user id: "+ php_var);
                console.log(typeof php_var);

                $('#user_from_id').val(php_var)
                $('#create_borrow_modal').modal("show")
        });


    });
    </script>

<?php
    $show_success_modal = false;
    $show_error_modal = false;
    $show_error_same_borrow_modal = false;
    if(isset($_GET['acknowledge'])){
        if($_GET['acknowledge'] == "datasaved"){
            $show_success_modal = true;
        }
        else if ($_GET['acknowledge'] == "datanotsaved"){
            $show_error_modal = true;
        }elseif ($_GET['acknowledge'] == "same_borrow") {
            $show_error_have_request_modal = true;
            
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

<?php if($show_error_same_borrow_modal){?>
    <script>  
        $(document).ready(function(){
            $('#error_message').text("you have created the same borrow request");
            $('#error_modal').modal('show'); 
        }); 
    </script>
<?php }?>
</body>
</html>