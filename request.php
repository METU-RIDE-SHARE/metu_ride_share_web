<?php  
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "metu_ride_share";
                                     

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["create_request_btn"]))
{
    
    $event_type = $_POST['event_type'];
    $vehicle_id = $_POST['vehicle_id'];
    $event_id = $_POST["event_id"];
    $user_from_id = $_SESSION['currentUserId'];
    

    $sql;
    $sql_run;

    if($event_type=="Ride"){
      $selected = $_POST['requestType'];
      echo("_".$event_type."_".$selected."_".$vehicle_id."_".$event_id."_".$user_from_id);
      if($selected == "Driver"){
        echo "ride driver";
        $sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`, requester_car_id) VALUES ('$user_from_id', '2020-01-01 10:30', '$event_id', 'Pending', '$selected', '$vehicle_id')";
        $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      }else if (($selected == "Passenger")){
        echo "ride Passnger";
        $sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`) VALUES ('$user_from_id', '2020-01-01 10:30', '$event_id', 'Pending', '$selected')";
        $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
      }
      
    }else if($event_type=="Package"){ 
      echo("_".$event_type."_".$vehicle_id."_".$event_id."_".$user_from_id);
      echo "package";
      $sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`, requester_car_id) VALUES ('$user_from_id', '2020-01-01 10:30', '$event_id', 'Pending', 'Driver', '$vehicle_id')";
      $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    
    
    

    if ($sql_run){
      if ($event_type=="Ride"){
        header('Location: ./rideEvents.php?acknowledge=datasaved');
        echo "saved";
      }
      else if($event_type=="Package"){
        header('Location: ./packageEvents.php?acknowledge=datasaved');
        echo "saved";
      }
    }
    else  {
      if ($event_type=="Ride"){
        header('Location: ./rideEvents.php?acknowledge=datanotsaved');
        echo "not saved";
      }
      else if($event_type=="Package"){
        header('Location: ./packageEvents.php?acknowledge=datanotsaved');
        echo "NOT saved";
      }
      
    }
}

$conn->close();
?>