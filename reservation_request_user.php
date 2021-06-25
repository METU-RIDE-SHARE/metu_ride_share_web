<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="reservation_request_user" content="width=device-width, initial-scale=1.0">
    <title>Reservatio Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
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

        <!-- change status (Bootstrap Modal) -->
        <div class="modal fade" id="change_status_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Request Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./includes/change_reservation_request.inc.php" method="POST">
                        <div class="modal-body">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_radio_btn" value="Accepted" id="accept_rbtn">
                                <label class="form-check-label" for="accept_rbtn">
                                    Accepted
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_radio_btn" value="Rejected" id="reject_rbtn" checked>
                                <label class="form-check-label" for="reject_rbtn">
                                    Reject
                                </label>
                            </div>
                            
                            <!-- the id of the reservation_id which is hidden to the user -->
                            <input type="hidden" name="reservation_id" value= '<?php echo $reservation_id ?>' />

                            <!-- the id of the taxi_id which is hidden to the user -->
                            <input type="hidden" name="taxi_id" id="taxi_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="save_status_b"class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    

    <div class="container">
        <div class="jumbotrom">

            <div class="card">
                <h2> Reservations Requests </h2>
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
                            
                            //handle error
                            $reservation_id;
                            if(isset($_GET["reservation_id"])){
                                $reservation_id = $_GET["reservation_id"];
                            }else{
                                echo 'reservation id not found'; 
                            }
                            
                            $query = "  SELECT rr.taxi_id, CONCAT_WS(' ', t.first_name, t.surname) AS `taxi_name`, rr.price, rr.status
                                        FROM reservation_request rr
                                        INNER JOIN taxi_reservation tr
                                            ON tr.id = rr.reservation_id
                                        INNER JOIN taxi t
                                            ON t.vehicle_id = rr.taxi_id
                                        WHERE tr.id = $reservation_id;";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                    <table id="tableid" class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <!-- TODO: add a link to the taxi driver -->
                                <th scope="col">Taxi ID</th> 
                                <th scope="col">Taxi name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Change Status</th>
                                
                            </tr>
                        </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['taxi_id']; ?> </td>
                                <td> <?php echo $row['taxi_name']; ?> </td>
                                <td> <?php echo $row['price']; ?> </td>
                                <td> <?php echo $row['status']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-primary change_status_btn"> Change </button>
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
        $('.change_status_btn').on('click', function(){

            // TODO: if the reservation is not accepted:
            $('#change_status_modal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);

            $('#taxi_id').val(data[0])
            $('#resrevation_id').val('<?php echo $reservation_id ?>');

            //TODO: else: show the message that you cannot change this
            
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
                $('#error_modal').modal('show'); 
        }); 
    </script>
<?php }?>



</body>
</html>