<?php
    // Connect to the database
    $connection = new mysqli("localhost","root","","metu_ride_share");

    // Check connection
    if ($connection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if(isset($_POST["update_account"])){
        
        // $update_reservation_id = $_POST["update_reservation_id"];
        
		$metuMail = $_POST['metu_mail'];
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$facebook = $_POST['facebook'];
		$whatsapp = $_POST['whatsapp'];
		$phone = $_POST['phone'];
      
        $query = "UPDATE metu_users SET first_name = '$firstname', surname = '$surname', phone = '$phone', facebook = '$facebook', WhatsApp = '$whatsapp' WHERE metu_mail = '$metuMail';";
        $query_run = mysqli_query($connection, $query);
        if($query_run)  {
            header('Location: ../userAccount.php?acknowledge=datasaved');
        }
        else{
            header('Location: ../userAccount.php?acknowledge=datanotsaved');
        }
    }
    
    $connection -> close();
?>