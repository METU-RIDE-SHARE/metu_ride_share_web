<?php include_once 'header.php'?>

    <body>

        
        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2>Reviews</h2>
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
                            $user_id = $_GET["user_id"];
                            //$current_metu_user_id = $_SESSION['currentUserID'];
							
                            //current data and time
                            $current_date = date('y-m-d h:i:s');

                            $query = "  SELECT *
                                        FROM review
                                        WHERE user_to_id = $user_id
                                        ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">Events ID</th>
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">From User</th>
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['event_id']; ?> </td>
                                    <td> <?php echo $row['datetime']; ?> </td>
                                    <td> <?php echo $row['comment']; ?> </td>
                                    <td> <?php echo $row['rating']; ?> </td>
                                    <td> <div style="display: none;"><?php echo $row['user_from_id']; ?></div>
									<button type="button" class="btn btn-primary show_user_btn"> Show User </button>
									</td>
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

	<script>
    $(document).ready(function(){
        $('.show_user_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                var owner_id = data[4];
                window.location.href = "./user_profile_noedit.php?user_id=" + owner_id;
        });


    });
    </script>

    </body>
</html>
