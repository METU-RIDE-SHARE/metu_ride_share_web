<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if(isset($_POST["cancel_taxi_reservation_b"])){
        $cancel_reservation_id = $_POST["cancel_reservation_id"];
        echo "this is the cacel id: " . $cancel_reservation_id;

        $query = "UPDATE taxi_reservation tr SET tr.status = 'Canceled' WHERE tr.id = '$cancel_reservation_id';";
        $query_run = mysqli_query($connection, $query);

        $query2 = " UPDATE reservation_request rr
                    SET rr.status = 'Canceled'
                    WHERE rr.reservation_id = '$cancel_reservation_id';";
        $query_run2 = mysqli_query($connection, $query2);

        
        if($query_run && $query_run2)  {
            header('Location: ../taxi_reservation_user.php?acknowledge=datasaved');
            echo "saved";
        }
        else{
            header('Location: ../taxi_reservation_user.php?acknowledge=datanotsaved');
        }
    }
    echo "not post";
    $connection -> close();
?>