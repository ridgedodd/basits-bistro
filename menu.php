<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
$(document).ready(function(){
    $("#toggleAddButton").click(function(){
        $("#addForm").show();
		$("#toggleAddButton").hide();
    });
	
	$('#cancelAdd').click(function(){
		$('#name').val('');
		$('#category').get(0).selectedIndex = 0;
		$('#price').val('');
		$('#veg').prop('checked', false);
		$("#addForm").hide();
		$("#toggleAddButton").show();
	});
});
</script>
</head>
<body style="padding-top:70px">
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
<!-- Brand/logo -->
  <a class="navbar-brand" href="home.php">Basit's Bistro</a>
  <!-- Links -->
  
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="menu.php">Menu</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="reservations.php">Reservations</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Log Out</a>
    </li>
  </ul>
  
</nav>
<div class="container-fluid">
<h1 class="text-center">Menu</h1>
<div class="row">
<div class="col-md-4 mx-auto">
<div class="row">
<div class="col-6">
<h2 class="text-center">Apps</h2>
<?php
	session_start();
	//Checking User Logged or Not
	if(empty($_SESSION['role'])){
	 header('location:index.php');
	}
	
	 $con = new mysqli($_SESSION['dbServer'], $_SESSION['dbUsername'], $_SESSION['dbPassword'], $_SESSION['dbDatabase']);
	 // Check connection
	 if (mysqli_connect_errno()) {
		 echo("Can't connect to MySQL Server. Error code: " .
		mysqli_connect_error());
		 return null;
	 }
	 // Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Appetizer' and active=1";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center" style="display: inline-block">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		<form method="post" action="editFood.php" style="display: inline-block; padding-left:5px">
		<button type="submit" class="btn btn-primary" name="foodID" value=<?php echo $row['foodID']; ?> >
		  <i class="fa fa-pencil" style="color:white"></i>
		</button>
		</form method="post" action="deleteFood.php" style="display: inline-block; padding-left:5px">
		<button type="button" class="btn btn-danger" name="foodID" value=<?php echo $row['foodID']; ?>>
		  <i class="fa fa-trash" style="color:white"></i>
		</button>
		</p>
		<?php
	 }
		?>
</table>
<h2 class="text-center">Entrees</h2>

	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Entree' and active=1";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center" style="display: inline-block">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		<form method="post" action="editFood.php" style="display: inline-block; padding-left:5px">
		<button type="submit" class="btn btn-primary" name="foodID" value=<?php echo $row['foodID']; ?> >
		  <i class="fa fa-pencil" style="color:white"></i>
		</button>
		</form>
		</p>
		<?php
	 }
		?>
</div> <!-- end of first column -->
<div class="col-6">
<h2 class="text-center">Sides</h2>
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Side' and active=1";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center" style="display: inline-block">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<?php 
		if ($row['vegetarian'] == 1) {
			?>
			<i class="fa fa-pagelines"></i>
			<?php
		}
		?>
		<form method="post" action="editFood.php" style="display: inline-block; padding-left:5px">
		<button type="submit" class="btn btn-primary" name="foodID" value=<?php echo $row['foodID']; ?> >
		  <i class="fa fa-pencil" style="color:white"></i>
		</button>
		</form>
		</p>
		<?php
	 }
		?>
<h2 class="text-center">Drinks</h2>
	<?php
	// Form the SQL query (a SELECT query)
	 $sql="SELECT * FROM Food where category='Drink' and active=1";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		?>
		<p class="text-center" style="display: inline-block">
		<?php echo $row['food_name']; ?>
		$<?php echo $row['price']?>
		<form method="post" action="editFood.php" style="display: inline-block; padding-left:5px">
		<button type="submit" class="btn btn-primary" name="foodID" value=<?php echo $row['foodID']; ?> >
		  <i class="fa fa-pencil" style="color:white"></i>
		</button>
		</form>
		</p>
		<?php
	 }
		?>
</div> <!-- end of second column -->
</div> <!-- end of nested row -->
</div> <!-- end of centered column -->
</div>  <!-- end of menu row -->
	<p class="text-center"><i class="fa fa-pagelines"></i> - Vegetarian </p>
	<div class="row">
	<div class="col-md-2 mx-auto">
		<div style="text-align:center">
		<button type="button" class="btn btn-primary" id="toggleAddButton">Add Menu Item</button>
		</div>
		<form id="addForm" style="display:none" method="post" action="addMenuItem.php">
			<label for="name">Food Name:</label>
			<input type="text" class="form-control" id="name" name="fName">
			<div class="form-group">
				<label for="category">Category:</label>
				<select class="form-control" id="category" name="fCategory">
					<option>Appetizer</option>
					<option>Entree</option>
					<option>Side</option>
					<option>Drink</option>
				</select>
			</div>
			<label for="price">Price:</label>
			<input type="number" step="1" class="form-control" id="price" name="fPrice">
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="checkbox" id="veg" name="fVeg" value="Yes">Vegetarian?
				</label>
			</div>
			<div style="text-align:center">
			<button type="submit" class="btn btn-primary" name="addItem">Add to Menu</button>
			<button class="btn btn-danger" id="cancelAdd">Cancel</button>
			</div>
		</form>
		<div>
			<?php if (!empty($_SESSION['addItemError'])) {
				?>
				<div class="alert alert-danger">
				  <?php
					echo $_SESSION['addItemError'];
				  ?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
	</div>
</div> <!-- end of container -->
<?php
	mysqli_close($con);
	?>
</body>
</html>