<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $connection -> connect_error;
        exit();
    }


    
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

        //if the status is accepted
        if($status == "Accepted"){
            //we have to make other requests for this reservation rejected
            $query2 = " UPDATE reservation_request 
                        SET status = 'Rejected'
                        WHERE reservation_id = '$reservation_id'
                            AND status = 'Pending';";
            $query_run2 = mysqli_query($connection, $query2);
            //we have to make the status of the reservation itself assigned
            $query3 = " UPDATE taxi_reservation
                        SET status = 'Assigned'
                        WHERE id = '$reservation_id';";
            $query_run3 = mysqli_query($connection, $query3);

            if($query_run && $query_run2 && $query_run3 )  {
                $params = 'reservation_id='.$reservation_id.'&acknowledge=datasaved';
                echo $params;
                header("Location: ../reservation_request_user.php?$params");
            }
            else{
                $params = 'reservation_id='.$reservation_id.'&acknowledge=datanotsaved';
                echo $params;
                header("Location: ../reservation_request_user.php?$params");
            }

        }else{
            if($query_run){
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
    }
    
    $connection -> close();
?>