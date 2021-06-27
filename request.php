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
    

$selected = $_POST['requestType'];
$vehicle_id = $_POST['vehicle_id'];
$event_id = $_POST["event_id"];
echo($event_id);
$last_id ='';


$sql = "INSERT INTO request (`user_from_id`, `timestamp`, `event_id`, `req_status`, `requester_type`) VALUES (5, '2020-01-01 10:30', 5, 'Pending', '$selected')";
if ($conn->query($sql) === TRUE) {

  $last_inserted_query = "SELECT event_id FROM event";
  $query_run = mysqli_query($conn,$last_inserted_query);
  foreach ($query_run as $row){
  $last_id = $row['event_id']; 
}

} else {
echo "<script>alert('Opps, an error happened!!');</script>";
}

$success = '';
if($selected=="Ride"){
    $sqlRide = "INSERT INTO ride (`eid`, `total_seats`, `ride_type`, `vehicle_id`) VALUES ('$last_id', '$seatNo', '$radioVal', null)";
    if ($conn->query($sqlRide) === TRUE) {
		$success = true;
      } else {
		  $success = false;
      }
}else if($selected=="Package"){
    $sqlPackage = "INSERT INTO package (`eid`, `car_id`, `weight`, `content`) VALUES ('$last_id', null, '$weight', '$content')";
    if ($conn->query($sqlPackage) === TRUE) {
		$success = true;
      } else {
		  $success = false;
      }
}

if ($success == true){
	if ($selected=="Ride"){
		header('Location: ./rideEvents.php?acknowledge=datasaved');}
	else{
		header('Location: ./packageEvents.php?acknowledge=datasaved');}
}
else {
	if ($selected=="Ride"){
		header('Location: ./rideEvents.php?acknowledge=datanotsaved');}
	else{
		header('Location: ./packageEvents.php?acknowledge=datanotsaved');}
	
}
}

$conn->close();
?>