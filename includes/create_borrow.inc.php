<?php
    session_start();

    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }


    if(isset($_POST["create_borrow_b"])){
        
        $car_id = $_POST["car_id"];
        $user_from_id = $_POST["user_from_id"];
        //$user_from_id = (int) $_SESSION["currentUserID"];
        $from_time = $_POST["from_time"];
        $to_time = $_POST["to_time"];

        echo $car_id."_".$user_from_id;

        //check if this taxi has already requested for the same tai reservation
        $query_check = "  SELECT COUNT(*) as count_row
                    FROM borrow b
                    WHERE b.car_id = '$car_id'
                    AND b.user_from_id = '$user_from_id'
                    AND b.from_time = '$from_time'
                    AND b.to_time = '$to_time'
                    ;";
        $query_run_check = mysqli_query($connection, $query_check);
                
        if($query_run_check){
            $row = $query_run_check -> fetch_array(MYSQLI_ASSOC); 
            if ($row['count_row'] > 0){
                $params = '&acknowledge=same_borrow';
                echo $params;
                header("Location: ../cars.php?$params");
                exit();
            }
            
        }else{
            echo 'SOMETHING WRONG WITH the QUERY';
            exit();
        }

    
        $query = "  INSERT INTO borrow (car_id, user_from_id, from_time, to_time)
                    VALUES ('$car_id', '$user_from_id', '$from_time', '$to_time');";
        $query_run = mysqli_query($connection, $query);
                
        if($query_run){ 
            $params = '&acknowledge=datasaved';
            echo $params;
            header("Location: ../cars.php?$params");
        }
        else{
            $params = '&acknowledge=datanotsaved';
            echo $params;
            header("Location: ../cars.php?$params");
        }
    }
    
    $connection -> close();
?>