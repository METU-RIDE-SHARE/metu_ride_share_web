<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if(isset($_POST["insert_taxi_reservation_b"])){
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $date_time = $_POST["date_time"];
        $creator_id = (int) $_SESSION["currentUser"];
        
        $query = "INSERT INTO taxi_reservation (`datetime`, `location`, `destination`, `creator_id`) VALUES ('$date_time', '$departure', '$destination',  '$creator_id');";
        $query_run = mysqli_query($connection, $query);
        if($query_run)  {
            header('Location: ../taxi_reservation_user.php?acknowledge=datasaved');
        }
        else{
            header('Location: ../taxi_reservation_user.php?acknowledge=datanotsaved');
        }
    }
    
    $connection -> close();
?>