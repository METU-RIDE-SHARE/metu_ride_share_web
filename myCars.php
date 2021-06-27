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
        <!-- add car (Bootstrap Modal) -->
        <div class="modal fade" id="add_car_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Borrow request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/add_car.inc.php" method="POST">
                    <div class="modal-body">
                        
                        <div class="form_group">
                            <label class="form-label">Vehicle model</label>
                            <input type="text" name="vehicle_model" class="form-control">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Vehicle Capacity</label>
                            <input type="number" name="vehicle_capacity" class="form-control">
                        </div>

                        <div class="form_group">
                            <label class="form-label">license plate number</label>
                            <input type="text" name="license_plate_no" class="form-control">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Vehicle color</label>
                            <input type="text" name="vehicle_color" class="form-control">
                        </div>
                        <div class="form_group">
                            <label class="form-label">licence number</label>
                            <input type="number" name="license_number" class="form-control">
                        </div>
            
                        <input type="hidden" name="add_car_user_from" id="add_car_user_from"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_car_b"class="btn btn-primary">Add</button>
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
                                <a class="nav-link" href="myCars.php">All Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">My Cars</a>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary add_car_btn">
                            Add car
                        </button>
                    
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $connection -> connect_error;
                                exit();
                            }
                            
                            $current_user_id = (int) $_SESSION['currentUserID'];
                            
                            $query = "  SELECT * FROM car
                                        INNER JOIN vehicle
                                        ON car.vehicle_id = vehicle.vehicle_id
                                        WHERE car.user_from = '$current_user_id'; ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Vehicle ID</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Vehicle Capacity</th>
                                    <th scope="col">Vehicle Color</th>
                                    <th scope="col">Plate No.</th>
                                    <th scope="col">license_number</th>
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
                                    <td> <?php echo $row['vehicle_capacity']; ?> </td>
                                    <td> <?php echo $row['vehicle_color']; ?> </td>
                                    <td> <?php echo $row['license_plate_no']; ?> </td>
                                    <td> <?php echo $row['license_number']; ?> </td>
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
        

        $('.add_car_btn').on('click', function(){

                var php_var = "<?php echo $_SESSION['currentUserID']; ?>";
                console.log("current user id: "+ php_var);
                console.log(typeof php_var);
                $('#add_car_user_from').val(php_var);

                $('#add_car_modal').modal('show');
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