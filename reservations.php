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
 
/*
$(document).ready(function(){
	$('#reservationSpecs :input').change(function() {
		var show_check = true;
		$("#reservationSpecs :input").each(function() {
			if ($(this).val() === "") {
				show_check = false;
			}
		});
		if (show_check) {
			$("#checkBtn").show();
		}
		else {
			$("#checkBtn").hide();
		}
	});		
});
*/

  
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
      <a class="nav-link" href="newOrder.php">New Order</a>
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
            <th class="text-center">Delete?</th>
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

		<td>
			<form method="post" action="deleteFood.php" style="display: inline-block; padding-left:5px">
				<button type="submit" class="btn btn-danger" name="reservationID" value=<?php echo $row['reservationID']; ?> >
				    <i class="fa fa-trash" style="color:white"></i>
				</button>	
			</form>
		</td>
		</tr>
		<?php
		}
	?>
	</tbody>
</table>
<form id="reservationSpecs" method="post" action="reservations.php#openTable">
<h2>Make a Reservation</h2>
<p>Date: <input type="text" id="datepicker" name="date" value="<?php echo $_POST['date']; ?>"></p>
<p># of People: <input type="number" id="numPeople" name="numPeople" value="<?php echo $_POST['numPeople']; ?>"></p>
<button type="submit" id="checkBtn" name="checkBtn" class="btn btn-primary">Check Availability</button>
</form>

<?php
	if(isset($_POST['date']) && isset($_POST['numPeople'])) {
?>


<table class="table table-striped" id="openTable">
	<thead>
		<tr>
			<th class="text-center">12:00</th>
			<th class="text-center">12:30</th>
			<th class="text-center">1:00</th>
			<th class="text-center">1:30</th>
			<th class="text-center">2:00</th>
            <th class="text-center">2:30</th>
			<th class="text-center">3:00</th>
			<th class="text-center">3:30</th>
			<th class="text-center">4:00</th>
			<th class="text-center">4:30</th>
			<th class="text-center">5:00</th>
            <th class="text-center">5:30</th>
			<th class="text-center">6:00</th>
			<th class="text-center">6:30</th>
			<th class="text-center">7:00</th>
			<th class="text-center">7:30</th>
			<th class="text-center">8:00</th>
            <th class="text-center">8:30</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php
			$date = date("Y-m-d", strtotime($_POST['date']));
			$numPeople = $_POST['numPeople'];
			
			for ($x = 0; $x < 18; $x++) {
				switch ($x) {
					case 0:
						$time = "12:00:00"; break;
					case 1:
						$time = "12:30:00"; break;
					case 2:
						$time = "13:00:00"; break;
					case 3:
						$time = "13:30:00"; break;
					case 4:
						$time = "14:00:00"; break;
					case 5:
						$time = "14:30:00"; break;
					case 6:
						$time = "15:00:00"; break;
					case 7:
						$time = "15:30:00"; break;
					case 8:
						$time = "16:00:00"; break;
					case 9:
						$time = "16:30:00"; break;
					case 10:
						$time = "17:00:00"; break;
					case 11:
						$time = "17:30:00"; break;
					case 12:
						$time = "18:00:00"; break;
					case 13:
						$time = "18:30:00"; break;
					case 14:
						$time = "19:00:00"; break;
					case 15:
						$time = "19:30:00"; break;
					case 16:
						$time = "20:00:00"; break;
					case 17:
						$time = "20:30:00"; break;
				}
				
				$sql = "SELECT * FROM RestaurantTable WHERE seats >= $numPeople AND 
				NOT EXISTS (SELECT * FROM Reservation WHERE RestaurantTable.tableID 
				= Reservation.tableID AND DATE(dateTime) = '$date' AND TIME(dateTime) = '$time') ORDER BY seats";
			
				$result = mysqli_query($con,$sql);
				$count=mysqli_num_rows($result);
				
				?>
				<td align="center">
				<?php
				if($count==0){
					?>
					<button type="button" class="btn btn-danger disabled">
					<i class="fa fa-times" style="color:white"></i>
					</button>
					<?php
				}
				else {
					$row=mysqli_fetch_array($result);
					$tableNum = $row['tableID'];
					?>
					
					<form action="confirmReservation.php" method="post">
						<input type="hidden" name="date" value="<?php echo $date; ?>" />
						<input type="hidden" name="time" value="<?php echo $time; ?>" />
						<input type="hidden" name="numPeople" value="<?php echo $numPeople; ?>" />
						<input type="hidden" name="tableNum" value="<?php echo $tableNum; ?>" />
						<button type="submit" class="btn btn-success">
						<i class="fa fa-check-circle" style="color:white"></i>
						</button>
					</form>
					<?php
				}
				?>
				</td>
				<?php
			}
		?>
		</tr>
	</tbody>
</table>

<?php
	}
?>

</div>
<?php
mysqli_close($con);
?>
</body>
</html>