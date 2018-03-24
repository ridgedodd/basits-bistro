<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<h1>Reservations</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="text-center">Reservation #</th>
			<th class="text-center">Customer</th>
			<th class="text-center">Date</th>
			<th class="text-center">Num People</th>
			<th class="text-center">Table Num</th>
		</tr>
	</thead>
	<tbody>
<?php
	require_once('./library.php');
	 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	 // Check connection
	 if (mysqli_connect_errno()) {
		 echo("Can't connect to MySQL Server. Error code: " .
		mysqli_connect_error());
		 return null;
	 }
	 // Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Customer NATURAL JOIN Reservation NATURAL JOIN RestaurantTable";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		 ?>
		<tr>
		<td align="center">
		<?php echo $row['reservationID']; ?>
		</td>
		<td align="center">
		<?php echo $row['first_name'] . " " . $row['last_name']; ?>
		</td>
		<td align="center">
		<?php echo $row['dateTime']; ?>
		</td>
		<td align="center">
		<?php echo $row['num_people']; ?>
		</td>
		<td align="center">
		<?php echo $row['tableID']; ?>
		</td>
		</tr>
		<?php
		}
	mysqli_close($con);
	?>
	</tbody>
</table>
</div>

</body>
</html>