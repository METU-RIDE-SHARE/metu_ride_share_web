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
        $creator_id = (int) $_POST["creator_id"];
        
        $query = "INSERT INTO taxi_reservation (`datetime`, `location`, `destination`, `creator_id`) VALUES ('$date_time', '$departure', '$destination',  '$creator_id');";
        $query_run = mysqli_query($connection, $query);
        if($query_run)  {
            //TODO: the message is not shown: show it in the taxi_reservatio_user.php page
            echo '<script> alert("Data Saved"); </script>';
            //TODO: change the index.php to the taxi_reservatio_user.php
            header('Location: taxi_reservation_user.php') ;
        }
        else{
            //TODO: the message is not shown: show it in the taxi_reservatio_user.php page
            echo '<script> alert(Data Not Saved) </script>';
        }
    }
    
    $connection -> close();
?>