<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
<h1 class="text-center">Menu</h1>
<h2 class="text-center">Apps</h2>
<table>
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
<h2 class="text-center">Entrees</h2>
<table>
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
<h2 class="text-center">Sides</h2>
<table>
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
<h2 class="text-center">Drinks</h2>
<table>
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
</div>
<?php
	mysqli_close($con);
	?>
</body>
</html>