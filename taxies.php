<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.8.0/mdb.min.css"
    rel="stylesheet"
    />

    <!-- <link rel="stylesheet" href="css_files/expand_table_style.css"> -->
</head>
<body>
        <div class="container">
            <div class="jumbotrom">

                <div class="card">
                    <h2> Taxies</h2>
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
                            
                            $query = "  SELECT * FROM taxi t; ";
                            $query_run = mysqli_query($connection, $query);
                        ?>
                        <table id="tableid" class="table table-bordered table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Facebook</th>
                                    <th scope="col">WhatsApp</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">City</th>
                                    
                                </tr>
                            </thead>
                        <?php
                            if($query_run)  {
                                foreach($query_run as $row){
                        ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['first_name']; ?> </td>
                                    <td> <?php echo $row['surname']; ?> </td>
                                    <td> <?php echo $row['phone']; ?> </td>
                                    <td> <?php echo $row['facebook']; ?> </td>
                                    <td> <?php echo $row['WhatsApp']; ?> </td>
                                    <td> <?php echo $row['company_name']; ?> </td>
                                    <td> <?php echo $row['city']; ?> </td>
                                </tr>
                            </tbody>
                        <?php       
                                }
                            }
                            else{
                                //TODO: the message is not shown
                                echo "No Record Found";
                            }
                        ?>                        
                        </table>




                        <!-- ####################################################################################### -->

<!-- 
                        <div class="container my-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Heading</th>
                                        <th scope="col">Heading</th>
                                        <th scope="col">Heading</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                                            <td class="expand-button"></td>
                                            <td>Cell</td>
                                            <td>Cell</td>
                                            <td>Cell</td>
                                        </tr>

                                        <tr class="hide-table-padding">
                                            <td></td>
                                            <td colspan="3">
                                                <div id="collapseOne" class="collapse in p-3">
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value 1</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value 2</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value 3</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value 4</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr class="accordion-toggle collapsed" id="accordion2" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                            <td class="expand-button"></td>
                                            <td>Cell</td>
                                            <td>Cell</td>
                                            <td>Cell</td>

                                        </tr>
                                        
                                        <tr class="hide-table-padding">
                                            <td></td>
                                            <td colspan="4">
                                                <div id="collapseTwo" class="collapse in p-3">
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2">label</div>
                                                        <div class="col-6">value</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <!-- ####################################################################################### -->
                    </div>
                </div>
            </div>
        </div>


        


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.8.0/mdb.min.js"
    ></script>
</body>
</html>