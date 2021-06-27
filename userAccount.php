<?php include_once 'header.php'?>
    <body>

        
        <!-- success modal -->
        <!-- Modal -->
        <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Updated</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        You data has been saved.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div> 

        <!-- error modal -->
        <!-- Modal -->
        <div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Update Failed!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        You data has NOT been saved.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
    

        <!-- ################################################################################################################################## -->
        <!-- EDIT TAXI RESERVATION (Bootstrap Modal) -->
        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./includes/update_user_account.php" method="POST">
                    <div class="modal-body">
                        <div class="form_group">
                            <label class="form-label">METU MAIL</label>
                            <input readonly type="text" name="metu_mail" class="form-control" value="<?php echo $_SESSION['currentUserMail']?>" >
                        </div>

                        <div class="form_group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $_SESSION['currentUserFName']?>">
                        </div>
                        
						<div class="form_group">
                            <label class="form-label">Surname</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $_SESSION['currentUserSName']?>">
                        </div>
						
						<div class="form_group">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $_SESSION['currentUserPhone']?>">
                        </div>
						
						<div class="form_group">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="<?php echo $_SESSION['currentUserFB']?>">
                        </div>
						
						<div class="form_group">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" value="<?php echo $_SESSION['currentUserWhats']?>">
                        </div>
						
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_account"class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- ############################################################################################################################################# -->

        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2>  Your Information</h2>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- button type="button" class="btn btn-primary">Present Reservations</button -->

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_profile">
                            Edit Profile
                        </button>

                    </div>            
                </div>

                <div class="card">
                    <div class="card-body">
                    
                        <?php
                            // Connect to the database
                            $connection = new mysqli("localhost","root","","metu_ride_share");
                            // Check connection
                            if ($connection -> connect_errno) {
                                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                                exit();
                            }
                            
                            $current_metu_user_id = $_SESSION['currentUserID'];

                            //current data and time
                            $current_date = date('y-m-d h:i:s');

                            $query = "  SELECT *
                                        FROM metu_users
                                        WHERE id = $current_metu_user_id
                                        ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr style="color:orange";>
                                    <th scope="col">METU Mail</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Facebook</th>
                                    <th scope="col">WhatsApp</th>
									<th scope="col">No. of Reviews</th>
									<th scope="col">Rating</th>
									<th scope="col">Reviews Details</th>
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['metu_mail']; ?> </td>
                                    <td> <?php echo $row['first_name']; ?> </td>
                                    <td> <?php echo $row['surname']; ?> </td>
                                    <td> <?php echo $row['phone']; ?> </td>
                                    <td> <?php echo $row['facebook']; ?> </td>
									<td> <?php echo $row['WhatsApp']; ?> </td>
									<td> <?php echo $row['no_review']; ?> </td>
									<td> <?php echo $row['rating']; ?> </td>
									<td>
                                        <button type="button" class="btn btn-primary show_review_btn"> Show Reviews </button>
                                    </td>
                                </tr>
                            </tbody>
                        <?php       
                                }
                            }
                            else{
                                echo "No record is found due to an internal error.";
                            }
                        ?>                        
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    

	<script>
    $(document).ready(function(){
        $('.show_review_btn').on('click', function(){
            $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                //console.log(data);

                var owner_id = <?php echo $row['id']; ?>;
                window.location.href = "./show_user_review.php?user_id=" + owner_id;
        });


    });
    </script>

<?php
    $show_success_modal = false;
    $show_error_modal = false;
    if(isset($_GET['acknowledge'])){
        if($_GET['acknowledge'] == "datasaved"){
            $show_success_modal = true;
        }
        else if ($_GET['acknowledge'] == "datanotsaved"){
            $show_error_modal = true;
        } 
    } 
?>

<?php if($show_success_modal){?>
    <script>  
        $(document).ready(function(){
                $('#success_modal').modal('show'); 
        }); 
    </script>
<?php }?>

<?php if($show_error_modal){?>
    <script>  
        $(document).ready(function(){
                $('#error_modal').modal('show'); 
        }); 
    </script>
<?php }?>

    </body>
</html>
