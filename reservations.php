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
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body style="padding-top:70px">
<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
<!-- Brand/logo -->
  <a class="navbar-brand" href="home.php">Basit's Bistro</a>
  <!-- Links -->
  
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="menu.php">Menu</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="reservations.php">Reservations</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Log Out</a>
    </li>
  </ul>
  
</nav>
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
	session_start();
	//Checking User Logged or Not
	if(empty($_SESSION['role'])){
	 header('location:index.php');
	}
	
	require_once('./library-manager.php');
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

<h2>Make a Reservation</h2>
<p>Date: <input type="text" id="datepicker"></p>

</div>
</body>
</html>