<?php
    include('connect.php');
    session_start();
    $UserId = $_SESSION['id'];
    $name = $_SESSION['name'];

if (isset($_POST['rentalSubmit'])) {
    include('connect.php');
    
    $address = mysqli_real_escape_string($conn, $_REQUEST['address']);
    $city = mysqli_real_escape_string($conn, $_REQUEST['city']);
    $type = mysqli_real_escape_string($conn, $_REQUEST['PropertyType']);
    $price = mysqli_real_escape_string($conn, $_REQUEST['rent']);
    $description = mysqli_real_escape_string($conn, $_REQUEST['description']);
    $typeRental = "rental";

    $query1 = "SELECT agentId FROM agents WHERE agentArea = '$city'";
    $result1 = mysqli_query($conn, $query1);
    $row = mysqli_fetch_assoc($result1);
    // $agentId = $row['agentId'] ? $row['agentId'] : "Null";
    $agentId = $row['agentId'];



    $stmt = "INSERT INTO property (userId, agentId, address, city, type, description) 
        VALUES ('$UserId', '$agentId' ,'$address', '$city', '$typeRental', '$description')";

    // $stmt2 = "SELECT propertyId from property"
    


    if (mysqli_query($conn, $stmt)) {
        $last_id = $conn->insert_id;
        $stmt2 = "INSERT INTO rentalproperty (propertyId, type,  rent)
        VALUES ('$last_id', '$type',  '$price')";

        if(mysqli_query($conn, $stmt2)){
            echo "<script>alert('Property add has been posted');
                    window.location.href='UserDashboard.php'; 
                </script>";
        }
        else{
            echo "<script>alert('Error! Something Went Wrong');
                        window.location.href='AddRentalProperty.php';
                    </script>";
        }
        
        
        
    } else {
        echo "<script>alert('Error! Something Went Wrong');
                    window.location.href='AddRentalProperty.php'; 
                </script>";
    }

    // Close connection
    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Selling Property</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome\css\all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="responsive.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#SellingPropertyForm').modal('show');
        });
    </script>
    <div class="modal fade" id="SellingPropertyForm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content " style="background: linear-gradient(to bottom, #0099ff 0%, #66ffff 100%);padding: 5% 15%;">
                <h1 class="text-center text-white">Add Rental Property</h1>


                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <label class="text-white">Name</label>
                            <input disabled class="form-control" placeholder="<?php echo $name ?>" />
                        </div>
                        <div class="form-group">
                            <label class="text-white">Property Location</label>
                            <input type="text" class="form-control" placeholder="Address*" name="address" />
                        </div>
                        <div class="form-group">
                            <label class="text-white">City</label>
                            <input type="text" class="form-control" placeholder="City*" name="city" />
                        </div>
                        <div class="form-group">
                            <label class="text-white">Property Type</label>
                            <select name="PropertyType" class="form-control">
                                <option>Select Property Type</option>
                                <option value="Flat">Flat</option>
                                <option value="Single Room">Single Room</option>
                                <option value="Guest House">Guest House</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="text-white">Asking Rent</label>
                            <input type="text" class="form-control" placeholder="Rent*" name="rent" />
                        </div>
                        <div class="form-group">
						    <label class="text-white">Property Details</label>
						    <textarea class="form-control" name="description" required placeholder="Details e.g. Plot (Area) / House (Details)" pattern="[A-Za-z]{20,50}"></textarea>
					    </div>

                        <br>
                        <button type=" submit" class="btn btn-light mx-auto d-block" name="rentalSubmit">Submit</button>
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>