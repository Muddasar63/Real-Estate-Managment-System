<?php
include('connect.php');
$query = "SELECT P.propertyId,RP.rent,RP.type,P.address,P.description,P.agentId 
FROM property P INNER JOIN rentalproperty RP 
ON RP.propertyId = P.propertyId AND RP.rent<=15000 ";
$result = mysqli_query($conn, $query);

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome\css\all.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="responsive.css">
</head>
<body>


<div class="table-responsive">
						<table class="table text-white table-hover " style="background-color:#0099cc; border:2px solid black;">
							<thead>
								<tr>
									<th>Property Id</th>
									<th>Rent</th>
									<th>Type</th>
									<th>Address</th>
									<th>Description</th>
									<th>Agent Id</th>

								</tr>
							</thead>

							<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tbody>
									<tr>
										<td><?php echo $row[0] ?></td>
										<td><?php echo $row[1] ?></td>
										<td><?php echo $row[2] ?></td>
										<td><?php echo $row[3] ?></td>
										<td><?php echo $row[4] ?></td>
										<td><?php echo $row[5] ?></td>

									</tr>
								</tbody>
							<?php
							}
							?>
						</table>
					</div>
</body>
</html>