<?php

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
if(isset($_POST['create_event']))
{
    
$pickLoc = $_POST['pickLoc'];
$destLoc = $_POST['destLoc'];
$date = $_POST['date'];
$price = $_POST['price'];
$note = $_POST['note'];
$selected = $_POST['eventType'];
$seatNo = $_POST['seatNo'];
$weight = $_POST['weight'];
$content = $_POST['content'];
$radioVal = $_POST["MyRadio"];

$last_id ='';


$sql = "INSERT INTO event (`datetime`, `price`, `destination`, `departure`, `note`, `creator_id`, responsible_user_id, `event_status`) VALUES ('$date','$price', '$destLoc', '$pickLoc', '$note', 5, null, 'active')";

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
		header('Location: ../rideEvents.php?acknowledge=datasaved');}
	else{
		header('Location: ../packageEvents.php?acknowledge=datasaved');}
}
else {
	if ($selected=="Ride"){
		header('Location: ../rideEvents.php?acknowledge=datanotsaved');}
	else{
		header('Location: ../packageEvents.php?acknowledge=datanotsaved');}
	
}
}

$conn->close();
?>