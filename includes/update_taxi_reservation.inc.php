<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $connection -> connect_error;
        exit();
    }

    if(isset($_POST["update_taxi_reservation_b"])){
        $update_reservation_id = $_POST["update_reservation_id"];
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $date_time = $_POST["date_time"];
        $date_time_formatted = str_replace('T', ' ', $date_time);
        echo $date_time_formatted;
        

        //checking if they are any requests so far for this reservation if so the change cannot be done
        $query_ckeck = "SELECT COUNT(*) as count_row
                        FROM reservation_request rr
                        INNER JOIN taxi_reservation tr
                        ON rr.reservation_id = tr.id
                        WHERE tr.id = '$update_reservation_id'";

        $query_run_check = mysqli_query($connection, $query_ckeck);
        if($query_run_check)  {
            $row = $query_run_check -> fetch_array(MYSQLI_ASSOC);
            echo $row['count_row']; 
            if ($row['count_row'] > 0){
                $params = '&acknowledge=have_requests';
                echo $params;
                header("Location: ../taxi_reservation_user.php?$params");
                exit();
            }
        }
        else{
            echo "ERORR in the DATABASE QUERY";
            exit();
        }


        $query = "UPDATE taxi_reservation SET datetime = '$date_time_formatted', location = '$departure', destination = '$destination' WHERE id = '$update_reservation_id';";
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