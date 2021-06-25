<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="taxi_reservation_taxi" content="width=device-width, initial-scale=1.0">
        <title>taxi reservation for taxi user</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"> -->
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

        <!-- already requested modal -->
        <!-- Modal -->
        <div class="modal fade" id="already_requested_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        You data has NOT been saved. Because you have already requested for this reservation.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
    
        <!-- ################################################################################################################################## -->
        <!-- create taxi reservation request (Bootstrap Modal) -->
        <div class="modal fade" id="create_reservation_request_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Reservation Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/create_reservation_request.inc.php" method="POST">
                    <div class="modal-body">

                        <div class="form_group">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Enter the Price">
                        </div>

                    
                        <!-- the id of the reservation which is hidden to the user -->
                        <input type="hidden" name="reservation_id" id="reservation_id"/>
                        <!-- the id of the reservation which is hidden to the user -->
                        <input type="hidden" name="taxi_id" id="taxi_id"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_reservation_request_b"class="btn btn-primary">Create Request</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> Available Taxi Reservations for Taxi to Request</h2>
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
                        
                            //current data and time TODO: check the current date
                            $current_date = date('y-m-d h:i:s');

                            $query = "  SELECT tr.Id, tr.datetime, tr.location, tr.destination, tr.status
                                        FROM taxi_reservation tr
                                        WHERE tr.status = 'Pending' AND datetime > '$current_date'
                                        ORDER BY tr.datetime DESC;";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Create Request</th>
                                    <th scope="col">Show User</th>
                                    
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
                                        <button type="button" class="btn btn-primary create_request_btn"> REQUEST </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary show_user_btn"> Show User </button>
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
                <!-- -************************************************************************************************** -->

                <div class="card">
                    <h2> Taxi Reservations That You Have Requested</h2>
                </div>

                <div class="card">
                    <div class="card-body">
                    
                        <?php
                            //current data and time
                            $current_date = date('y-m-d h:i:s');
                            //$current_taxi_user = $_SESSION['currrentTaxiUserID']; TODO
                            $current_taxi_user = 1;
                            
                            //TODO: the current date and time
                            $query = "  SELECT tr.Id, tr.datetime, tr.location, tr.destination, tr.status, rr.price, rr.status as request_status
                                        FROM taxi_reservation tr
                                        INNER JOIN reservation_request rr
                                        ON tr.id = rr.reservation_id
                                        WHERE rr.taxi_id = $current_taxi_user AND datetime < '$current_date'
                                        ;";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Reservation Status</th>
                                    <th scope="col">Your price</th>
                                    <th scope="col">Your request Status</th>
                                    <th scope="col">Show User</th>
                                    
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
                                    <td> <?php echo $row['price']; ?> </td>
                                    <td> <?php echo $row['request_status']; ?> </td>
                                    <td>
                                        <button type="button" class="btn btn-primary show_user_btn"> Show User </button>
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
        $('.create_request_btn').on('click', function(){
            $('#create_reservation_request_modal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#reservation_id').val(data[0])
                
                //TODO: the current taxi user logged in 
                $('#taxi_id').val(1);
                
            
        });

        $('.show_user_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var reservation_id = data[0];
                window.location.href = "./user_profile_noedit.php?reservation_id=" + reservation_id;
        });


    });
    </script>


<?php
    $show_success_modal = false;
    $show_error_modal = false;
    $already_requested = false;
    if(isset($_GET['acknowledge'])){
        if($_GET['acknowledge'] == "datasaved"){
            $show_success_modal = true;
        }
        else if ($_GET['acknowledge'] == "datanotsaved"){
            $show_error_modal = true;
        }
        else if ($_GET['acknowledge'] == "already_requested"){
            $already_requested = true;
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

<?php if($already_requested){?>
    <script>  
        $(document).ready(function(){
                $('#already_requested_modal').modal('show'); 
        }); 
    </script>
<?php }?>

    </body>
</html>
