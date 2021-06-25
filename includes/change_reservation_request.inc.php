<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }


    // TODO: this should have been done in a transaction
    if(isset($_POST["save_status_b"])){
        
        $taxi_id = $_POST["taxi_id"];
        $reservation_id = $_POST["reservation_id"];
        echo "this is reservation id coming in:  ".$reservation_id."finished    ";
        $status = $_POST["status_radio_btn"];
    
        $query = "  UPDATE reservation_request 
                    SET status = '$status'
                    WHERE reservation_id = '$reservation_id'
                          AND
                          taxi_id = $taxi_id;";
        $query_run = mysqli_query($connection, $query);
        

        // $query2 = " UPDATE reservation_request 
        //             SET status = 'Rejected'
        //             WHERE reservation_id = '$reservation_id'
        //                 AND taxi_id = $taxi_id
        //                 AND status = 'Pending';";
        // $query_run2 = mysqli_query($connection, $query2);
        
        
        // $query3 = " UPDATE taxi_reservation
        //             SET status = 'Accepted'
        //             WHERE id = '$reservation_id';";
        // $query_run3 = mysqli_query($connection, $query3);
                
        if($query_run){ //&& $query_run2 && $query_run3 )  {
            $params = 'reservation_id='.$reservation_id.'&acknowledge=datasaved';
            echo $params;
            header("Location: ../reservation_request_user.php?$params");
        }
        else{
            $params = 'reservation_id='.$reservation_id.'&acknowledge=datanotsaved';
            echo $params;
            header("Location: ../reservation_request_user.php?$params");
        }
    }
    
    $connection -> close();
?>