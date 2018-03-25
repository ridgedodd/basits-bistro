<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container-fluid">
<h1 class="text-center">Menu</h1>
<h2 class="text-center">Apps</h2>
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
		<p class="text-center">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		</p>
		<?php
	 }
		?>
</table>
<h2 class="text-center">Entrees</h2>

	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Entree'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		</p>
		<?php
	 }
		?>

<h2 class="text-center">Sides</h2>
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Side'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		</p>
		<?php
	 }
		?>
<h2 class="text-center">Drinks</h2>
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Drink'";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		</p>
		<?php
	 }
		?>
	<p class="text-center"><i class="fa fa-pagelines"></i> - Vegetarian </p>
</div>
<?php
	mysqli_close($con);
	?>
</body>
</html>