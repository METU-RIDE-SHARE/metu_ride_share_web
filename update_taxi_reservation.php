<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if(isset($_POST["update_taxi_reservation_b"])){
        
        $update_reservation_id = $_POST["update_reservation_id"];
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $date_time = $_POST["date_time"];
        $date_time_formatted = str_replace('T', ' ', $date_time);
        echo $date_time_formatted;
        
        $query = "UPDATE taxi_reservation SET datetime = '$date_time_formatted', location = '$departure', destination = '$destination' WHERE id = '$update_reservation_id';";
        $query_run = mysqli_query($connection, $query);
        if($query_run)  {
            //TODO: the message is not shown: show it in the taxi_reservatio_user.php page
            echo '<script> alert("Data Saved"); </script>';
            //TODO: change the index.php to the taxi_reservatio_user.php
            header('Location: taxi_reservation_user.php') ;
        }
        else{
            //TODO: the message is not shown: show it in the taxi_reservatio_user.php page
            echo '<script> alert("Data Not Saved"); </script>';
        }
    }
    
    $connection -> close();
?>