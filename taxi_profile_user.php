<?php include_once 'header.php'?>

    <body>
            <div class="container">
                <div class="jumbotrom">

                    <div class="card">
                        <h2> Taxi Profile</h2>
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
                                
                                if(isset($_GET["taxi_id"])){
                                    $taxi_id = $_GET["taxi_id"];

                                    $query = "  SELECT * FROM taxi
                                                WHERE vehicle_id = $taxi_id;";
                                    $query_run = mysqli_query($connection, $query);
                                    if($query_run)  {
                                        $row = $query_run -> fetch_array(MYSQLI_ASSOC);  
                                        if($row){
                                            echo "<p><strong>Name: </strong>". $row['first_name']."</p>";
                                            echo "<p><strong>Surname: </strong>". $row['surname']."</p>";
                                            echo "<p><strong>Phone: </strong>". $row['phone']."</p>";
                                            echo "<p><strong>Facebook: </strong>". $row['facebook']."</p>";
                                            echo "<p><strong>WhasApp: </strong>". $row['WhatsApp']."</p>";
                                            echo "<p><strong>Company: </strong>". $row['company_name']."</p>";
                                            echo "<p><strong>City: </strong>". $row['city']."</p>";
                                        }else{
                                            echo "the taxi is not found!";
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    </body>
</html>