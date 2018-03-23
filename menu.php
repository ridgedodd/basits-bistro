<html>
<body>
<h1>Menu</h1>
<h2>Apps</h2>
<table border="0" cellspacing="2" cellpadding="2">
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
	 $sql="SELECT * FROM Food where category='Appetizer'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		 ?>
		<tr>
		<td align="center">
		<?php echo $row['food_name']; ?>
		</td>
		<td align="center">
		$<?php echo $row['price']?>
		</td>
		</tr>
		<?php
	 }
		?>
</table>
<h2>Entrees</h2>
<table border="0" cellspacing="2" cellpadding="2">
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Entree'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
		<td align="center">
		<?php echo $row['food_name']; ?>
		</td>
		<td align="center">
		$<?php echo $row['price']?>
		</td>
		</tr>
		<?php
	 }
		?>
</table>
<h2>Sides</h2>
<table border="0" cellspacing="2" cellpadding="2">
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Side'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
		<td align="center">
		<?php echo $row['food_name']; ?>
		</td>
		<td align="center">
		$<?php echo $row['price']?>
		</td>
		</tr>
		<?php
	 }
		?>
</table>
<h2>Drinks</h2>
<table border="0" cellspacing="2" cellpadding="2">
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Drink'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
		<td align="center">
		<?php echo $row['food_name']; ?>
		</td>
		<td align="center">
		$<?php echo $row['price']?>
		</td>
		</tr>
		<?php
	 }
		?>
</table>
<?php
	mysqli_close($con);
	?>
</body>
</html>