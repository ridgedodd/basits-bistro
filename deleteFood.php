<?php
	session_start();
	//Checking User Logged or Not
	if(empty($_SESSION['role'])){
	 header('location:index.php');
	}

	require_once('./library-manager.php');
	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

	$error = "";
	
	// Check connection
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .
		mysqli_connect_error());
		return null;
	}
	#$currentFoodID = '';
	if(!empty($_POST['foodID'])) {
		$currentFoodID = $_POST['foodID'];
		$_SESSION['currentFoodIDToEdit'] = $currentFoodID;
		$sql="SELECT * FROM Food where foodID = $currentFoodID";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$oldFoodName = $row['food_name'];
		$oldFoodCategory = $row['category'];
		# need to do logic for this
		
		$oldFoodPrice = $row['price'];
		$oldFoodVeg = $row['vegetarian'];
	}
	elseif (!empty($_POST['completeFoodEdit'])) {
		$currentFoodID = $_SESSION['currentFoodIDToEdit'];
		$_SESSION['currentFoodIDToEdit'] = '';

		#$sql="DELETE FROM Food WHERE foodID=$currentFoodID";
		$sql = "UPDATE Food SET active = 0 WHERE foodID=$currentFoodID";
		
		if (mysqli_query($con, $sql)) {
				
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
		}
		header("location:menu.php");
	}
	else {
		header("location:menu.php");
	}
	
	mysqli_close($con);
?>
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
<h1 class="text-center">Delete Food Item</h1>
<div class="row">
<div class="col-md-4 mx-auto">
	<br>
	Are you sure you want to delete menu item <?php echo $oldFoodName; ?>?
	<br>
	<br>
	<form id="deleteForm" method="post" action="">
			
			<div style="text-align:center">
				<button type="submit" class="btn btn-primary" name="completeFoodEdit" value="completeFoodEdit">Delete</button>
				<button type="submit" class="btn btn-danger" name="cancelFoodEdit">Cancel</button>
			</div>
	</form>
	<?php
		echo $error;
	?>
</div>
</div>
</div>
</body>
</html>