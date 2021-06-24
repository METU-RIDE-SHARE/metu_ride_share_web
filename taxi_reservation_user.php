<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="taxi_reservation_user" content="width=device-width, initial-scale=1.0">
        <title>taxi reservation for users</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- ADD TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="add_reservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Taxi Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="insert_taxi_reservation.php" method="POST">
                    <div class="modal-body">
                        <div class="form_group">
                            <label class="form-label">Departure</label>
                            <input type="text" name="departure" class="form-control" placeholder="Enter the Departure City">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" class="form-control" placeholder="Enter the Destination City">
                        </div>
                        
                        <!--TODO: enhance the data and time chooser -->
                        <div class="form_group">
                            <label class="form-label">Date and Time</label>
                            <input type="datetime-local" name="date_time" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                        <!-- the id of the creator which is hidden to the user -->
                        <!-- TODO: the creator id should be gotten from the login page -->
                        <input type="hidden" name="creator_id" value="1" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="insert_taxi_reservation_b"class="btn btn-primary">Save Reservation</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- ################################################################################################################################## -->
        <!-- EDIT TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="edit_reservation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Taxi Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update_taxi_reservation.php" method="POST">
                    <div class="modal-body">

                        <div class="form_group">
                            <label class="form-label">Departure</label>
                            <input type="text" name="departure" id="departure" class="form-control" placeholder="Enter the Departure City">
                        </div>

                        <div class="form_group">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" id="destination" class="form-control" placeholder="Enter the Destination City">
                        </div>
                        
                        <!--TODO: enhance the data and time chooser -->
                        <div class="form_group">
                            <label class="form-label">Date and Time</label>
                            <input type="datetime-local" name="date_time" id="dateTime" class="form-control" placeholder="Enter the the date and time">
                            <!-- div id="date_time_help" class="form-text">Enter the data and time in this format: "yyyy-mm-dd hh:mm".</div-->
                        </div>
                        
                        <!-- the id of the creator which is hidden to the user -->
                        <!-- TODO: the creator id should be gotten from the login page -->
                        <input type="hidden" name="creator_id" value="1" />
                        <input type="hidden" name="update_reservation_id" id="update_reservation_id"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_taxi_reservation_b"class="btn btn-primary">Update Reservation</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> Your Taxi Reservations</h2>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- button type="button" class="btn btn-primary">Present Reservations</button -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_reservation">
                            Add Taxi Reservation
                        </button>

                    </div>            
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
        
        //TODO: the creator id should be gotten from the login page
        $current_metu_user_id = 1;

        //current data and time
        $current_date = date('y-m-d h:i:s');

            
        $query = "  SELECT tr.Id, tr.datetime, tr.location, tr.destination, tr.status
                    FROM taxi_reservation tr
                    INNER JOIN metu_users mu
                        ON tr.creator_id = mu.id
                    WHERE tr.creator_id = $current_metu_user_id
                        AND datetime > '$current_date'
                    ORDER BY tr.datetime DESC;";
        $query_run = mysqli_query($connection, $query);
    ?>
                        <table class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Show Requests</th>
                                    
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
                                        <button type="button" class="btn btn-primary edit_btn"> EDIT </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary show_request_btn"> Requests </button>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
        $('.edit_btn').on('click', function(){
            $('#edit_reservation').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_reservation_id').val(data[0])
                $('#departure').val(data[1]);
                $('#destination').val(data[2]);

                //TODO convert the time better
                var htmlLocalDate = data[3];
                var correct_format = htmlLocalDate.substring(1 ,htmlLocalDate.length-1).replace(" ", "T");
        
                console.log(correct_format);
                $('#dateTime').val(correct_format);
        });

        $('.show_request_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var reseravation_id = data[0];
                window.location.href = "./reservation_request_user.php?reseravation_id=" + reseravation_id;
        });


    });
    </script>

    </body>
</html>
