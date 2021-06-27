<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $connection -> connect_error;
        exit();
    }


    
    if(isset($_POST["save_status_b"])){
        
        $car_id = $_POST["car_id"];
        $user_from_id = $_POST["user_from_id"];

        $from_time = $_POST["from_time"];
        $from_time_formatted = str_replace('T', ' ', $from_time);
        

        $to_time = $_POST["to_time"];
        $to_time_formatted = str_replace('T', ' ', $to_time);



        $status = $_POST["status_radio_btn"];

        echo $car_id . "_" . $user_from_id . "_" . $from_time_formatted . "_" . $to_time_formatted . "_" . $status;
    
        $query = "  UPDATE borrow b
                    SET status = '$status'
                    WHERE b.user_from_id = '$user_from_id'
                          AND
                          b.car_id = '$car_id'
                          AND
                          b.to_time = '$to_time_formatted'
                          AND
                          b.from_time = '$from_time_formatted';";
        $query_run = mysqli_query($connection, $query);

        
        if($query_run){
            $params = '&acknowledge=datasaved';
            echo $params;
            header("Location: ../borrow.php?$params");
        }
        else{
            $params = '&acknowledge=datanotsaved';
            echo $params;
            header("Location: ../borrow.php?$params");
        }
        
    }
    
    $connection -> close();
?>