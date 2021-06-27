<?php
    session_start();
    // Connect to the database
    $conn = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

    if(isset($_POST["add_car_b"])){
        $vehicle_model = $_POST["vehicle_model"];
        $vehicle_capacity = $_POST["vehicle_capacity"];
        $license_plate_no = $_POST["license_plate_no"];
        $vehicle_color = $_POST["vehicle_color"];
        $license_number = $_POST["license_number"];
        $user_from = $_POST["add_car_user_from"];
        echo $vehicle_model . "_" . $vehicle_capacity . "_" . $license_plate_no . "_" .$vehicle_color . "_" .$license_number . "_" .$user_from ;

        $last_id;


        $sql = "INSERT INTO vehicle (`vehicle_model`, `vehicle_capacity`, `license_plate_no`, `vehicle_color`) VALUES ( '$vehicle_model', '$vehicle_capacity', '$license_plate_no', '$vehicle_color');";


        $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($sql_run) {

            $last_inserted_query = "SELECT MAx(vehicle_id) as maxi_id FROM vehicle";
            $query_run = mysqli_query($conn, $last_inserted_query);
            if ($query_run){
                foreach ($query_run as $row){
                    $last_id = $row['maxi_id']; 
                }
            }else{
                echo "<script> alert('Opps, an error happened!! last inserted');</script>";
            }
            

        } else {
            echo "<script> alert('Opps, an error happened!!');</script>";
            exit();
        }

        echo "last_id: " . $last_id;

        $sqlinsert = "INSERT INTO car (`vehicle_id`, `license_number`, `user_from`) VALUES ('$last_id', '$license_number', '$user_from');";
        $sqlinsert_run = mysqli_query($conn, $sqlinsert) or die(mysqli_error($conn));

        
        if ($sqlinsert_run) {
            header('Location: ../myCars.php?acknowledge=datasaved');
            echo "saved";
        } else {
            header('Location: ../myCars.php?acknowledge=datanotsaved');
            echo "not saved";
        }


    }

    $conn -> close();
?>