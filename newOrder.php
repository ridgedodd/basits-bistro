<html>
<head>
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<!-- jQuery UI -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
$(document).ready(function(){
	var orderList = {
		"items": [
		]
	};
	
    $('.addFoodButton').click(function() {
		var foodName = $(this).data("foodname");
		var foodID = $(this).data("foodid");
		$('#orderTable tbody').append("<tr><td align=\"center\">" + foodName + "</td><td><div style=\"text-align:center\"><button type=\"submit\" class=\"btn btn-danger removeFoodButton\" data-foodname=\"" + foodName + "\" data-foodid=\"" + foodID + "\" name=\"removedFoodID\" value=\"" + foodID + "\"><i class=\"fa fa-trash\" style=\"color:white\"></i></button></div></td></tr>");
		orderList.items.push({id: foodID, name: foodName});
	});
	
	$(document).on('click', '.removeFoodButton', function() {
		var foodName = $(this).data("foodname");
		var foodID = $(this).data("foodid");
		$(this).closest('tr').remove();
		var index = orderList.items.findIndex(x => x.id==foodID);
		if (index > -1) {
			orderList.items.splice(index, 1);
		}
	});
	
	$('#submitOrderButton').click(function() {
		var dataToPost = orderList;
		dataToPost.tableNum = $('#tableNum').val();
		$.post("processNewOrder.php", dataToPost, function(data) {
			window.location.replace("home.php");
		});
	});
	
	
});
</script>
</head>
<body  style="padding-top:70px">
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
<!-- Brand/logo -->
  <a class="navbar-brand" href="home.php">Basit's Bistro</a>
  <!-- Links -->
  
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="menu.php">Menu</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="reservations.php">Reservations</a>
    </li>
	<li class="nav-item active">
      <a class="nav-link" href="newOrder.php">New Order</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Log Out</a>
    </li>
  </ul>
  
</nav>



<div class="container-fluid">
<div class="row">
<div class="col-md-11 mx-auto">
<div class="row">
<div class="col-6">
<div class="table-responsive" style="max-height:300px" id="menuTable">
<table class="table">
	<thead>
		<tr>
			<th class="text-center">Food Name</th>
			<th class="text-center">Add to Order</th>
		</tr>
	</thead>
	<tbody>
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
	 $sql="SELECT * FROM Food";
	 $result = mysqli_query($con,$sql);
	 // Print the data from the table row by row
	 while($row = mysqli_fetch_array($result)) {
		 ?>
		<tr>
		<td align="center">
			<?php echo $row['food_name']; ?>
		</td>
		<td>
			<div style="text-align:center">
			<!--<form method="post" action="deleteFood.php" style="display: inline-block; padding-left:5px">-->
				<button type="submit" class="btn btn-success addFoodButton" data-foodname="<?php echo $row['food_name']; ?>" data-foodid="<?php echo $row['foodID']; ?>" name="addedFoodID" value=<?php echo $row['foodID']; ?> >
				    <i class="fa fa-check" style="color:white"></i>
				</button>	
			<!--</form>-->
			</div>
		</td>
		</tr>
		<?php
		}
	?>
	</tbody>
</table>
</div> <!-- end of responsive scrollbar thing -->

</div> <!-- end of first column -->
<div class="col-6">
<div class="table-responsive" style="max-height:300px" id="orderTable">
<table class="table">
	<thead>
		<tr>
			<th class="text-center">Food Name</th>
			<th class="text-center">Remove From Order</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
</div> <!-- end of responsive scrollbar thing -->
</div> <!-- end of 2nd column -->
</div> <!-- end of nested row -->
</div> <!-- end of centered column -->
</div>  <!-- end of menu row -->

<label for="tableNum">Table #:</label>
<input type="number" class="form-control" id="tableNum" name="tableNum">
<br/>
<div style="text-align:center">
<button id="submitOrderButton" type="submit" class="btn btn-primary" name="newOrder" value="newOrder">Submit Order</button>
</div>
</div> <!-- end of container-->
</body>
</html>