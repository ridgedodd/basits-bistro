<html>
<body>
<h1>Reservations</h1>
<table border="0" cellspacing="2" cellpadding="2">
<tr>
<td align="center">
Reservation #
</td>
<td align="center">
Customer
</td>
<td align="center">
Date
</td>
<td align="center">
Num People
</td>
<td align="center">
Table Num
</td>
</tr>
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
</table>

</body>
</html>