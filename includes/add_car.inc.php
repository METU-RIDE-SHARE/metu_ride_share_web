<?php
    session_start();
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if(isset($_POST["add_car_b"])){
        $vehicle_model = $_POST["vehicle_model"];
        $vehicle_capacity = $_POST["vehicle_capacity"];
        $license_plate_no = $_POST["license_plate_no"];
        $vehicle_color = $_POST["vehicle_color"];
        $license_number = $_POST["license_number"];
        $user_from = $_POST["add_car_user_from"];

    }
    
    $connection -> close();
?>