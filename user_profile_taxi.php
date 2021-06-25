<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Taxi Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
            <div class="container">
                <div class="jumbotrom">

                    <div class="card">
                        <h2> User Profile</h2>
                    </div>


                    <!-- ******************************************************************************************** -->
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
                                
                                if(isset($_GET["reservation_id"])){
                                    $reservation_id = $_GET["reservation_id"];
                                    

                                    $query = "  SELECT * FROM metu_users mu
                                                INNER JOIN taxi_reservation tr
                                                ON mu.id = tr.creator_id
                                                WHERE tr.id = '$reservation_id';";
                                    $query_run = mysqli_query($connection, $query);
                                    if($query_run)  {
                                        $row = $query_run -> fetch_array(MYSQLI_ASSOC);  
                                        if($row){
                                            echo "<p><strong>Name: </strong>". $row['first_name']."</p>";
                                            echo "<p><strong>Surname: </strong>". $row['surname']."</p>";
                                            echo "<p><strong>Phone: </strong>". $row['phone']."</p>";
                                            echo "<p><strong>Facebook: </strong>". $row['facebook']."</p>";
                                            echo "<p><strong>WhasApp: </strong>". $row['WhatsApp']."</p>";
                                            echo "<p><strong>rating: </strong>". $row['rating']."</p>";
                                            echo "<p><strong>not reviews: </strong>". $row['no_review']."</p>";
                                        }else{
                                            echo "the user is not found!";
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