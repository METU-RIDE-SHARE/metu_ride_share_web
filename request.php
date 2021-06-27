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
    $selected = $_POST['requestType'];
    $vehicle_id = $_POST['vehicle_id'];
    $event_id = $_POST["event_id"];
    $user_from_id = $_SESSION['currentUserId'];
    echo("_".$event_id."_");

    $sql;
    $sql_run;
    if($event_type=="Ride"){
      $sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`) VALUES ('$user_from_id', '2020-01-01 10:30', '$event_id', 'Pending', '$selected')";
      $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }else{
      $sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`) VALUES ('$user_from_id', '2020-01-01 10:30', '$event_id', 'Pending', 'Driver')";
      $sql_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
    
    
    

    if ($sql_run == true){
      if ($event_type=="Ride"){
        header('Location: ./rideEvents.php?acknowledge=datasaved');
        echo "saved";
      }
      else{
        header('Location: ./packageEvents.php?acknowledge=datasaved');
        echo "saved";
      }
    }
    else {
      if ($event_type=="Ride"){
        header('Location: ./rideEvents.php?acknowledge=datanotsaved');
        echo "not saved";
      }
      else{
        header('Location: ./packageEvents.php?acknowledge=datanotsaved');
        echo "NOT saved";
      }
      
    }
}

$conn->close();
?>