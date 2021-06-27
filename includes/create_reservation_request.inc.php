<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }


    // TODO: this should have been done in a transaction
    if(isset($_POST["create_reservation_request_b"])){
        
        $taxi_id = $_POST["taxi_id"];
        $reservation_id = $_POST["reservation_id"];
        $price = $_POST["price"];

        //check if this taxi has already requested for the same tai reservation
        $query_check = "  SELECT COUNT(*) as count_row
                    FROM reservation_request rr
                    INNER JOIN taxi_reservation tr
                    ON rr.reservation_id=tr.id
                    WHERE rr.reservation_id = '$reservation_id'
                    AND rr.taxi_id = '$taxi_id';";
        $query_run_check = mysqli_query($connection, $query_check);
                
        if($query_run_check){
            $row = $query_run_check -> fetch_array(MYSQLI_ASSOC); 
            if ($row['count_row'] > 0){
                $params = '&acknowledge=already_requested';
                echo $params;
                header("Location: ../taxi_reservation_taxi.php?$params");
            }
            echo 'inside query';
            
        }else{
            echo 'SOMETHING WRONG WITH the QUERY';
            exit();
        }

    
        $query = "  INSERT INTO reservation_request (taxi_id, reservation_id, price)
                    VALUES ('$taxi_id', '$reservation_id', '$price');";
        $query_run = mysqli_query($connection, $query);
                
        if($query_run){ 
            $params = '&acknowledge=datasaved';
            echo $params;
            header("Location: ../taxi_reservation_taxi.php?$params");
        }
        else{
            $params = '&acknowledge=datanotsaved';
            echo $params;
            header("Location: ../taxi_reservation_taxi.php?$params");
        }
    }
    
    $connection -> close();
?>