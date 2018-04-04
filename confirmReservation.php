<?php
	session_start();
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
?>
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

	$(document).ready(function() {
		$( "#searchCustomerInput" ).change(function() {
		
			$.ajax({
				url: 'searchCustomerName.php', 
				data: {searchCustomers: $( "#searchCustomerInput" ).val()},
				success: function(data){
					$('#searchCustomerResult').html(data);	
				
				}
			});
		});
		
		$("#newCustomerButton").click(function(){
			$("#addCustomerForm").show();
			$("#newCustomerButton").hide();
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
    <li class="nav-item">
      <a class="nav-link" href="menu.php">Menu</a>
    </li>
    <li class="nav-item">
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
<div class="row">
<div class="col-md-4 mx-auto">
<?php

	# User clicks button to confirm reservation with new customer
	if (!empty($_POST['newCustomer']) && !empty($_POST['newCustomerFirstName']) && !empty($_POST['newCustomerLastName'])) {
		$firstName = $_POST['newCustomerFirstName'];
		$lastName = $_POST['newCustomerLastName'];
		
		$sql = "INSERT INTO Customer (customerID, first_name, last_name) VALUES
				(NULL, '$firstName', '$lastName')";	
		$result = mysqli_query($con, $sql);
		
		$sql = "SELECT * FROM Customer WHERE first_name = '$firstName' AND last_name = '$lastName'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		
		$customerID = $row['customerID'];
		$date = $_SESSION['newResDate'];
		$time = $_SESSION['newResTime'];
		$numPeople = $_SESSION['newResNumPeople'];
		$tableNum = $_SESSION['newResTableNum'];
		unset($_SESSION['newResDate']);
		unset($_SESSION['newResTime']);
		unset($_SESSION['newResNumPeople']);
		unset($_SESSION['newResTableNum']);
		$dateTime = $date . ' ' . $time;
		$sql = "INSERT INTO Reservation (reservationID, num_people, dateTime, customerID, tableID)
		VALUES (NULL, '$numPeople', '$dateTime', '$customerID', '$tableNum')";

		if (mysqli_query($con, $sql)) {
			header("location:reservations.php");
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
			header("location:reservations.php");
		}
	}
	# user clicks button to confirm reservation with existing customer
	elseif (!empty($_POST['chosenCustomer'])) {
		$customerID = $_POST['chosenCustomer'];
		$date = $_SESSION['newResDate'];
		$time = $_SESSION['newResTime'];
		$numPeople = $_SESSION['newResNumPeople'];
		$tableNum = $_SESSION['newResTableNum'];
		unset($_SESSION['newResDate']);
		unset($_SESSION['newResTime']);
		unset($_SESSION['newResNumPeople']);
		unset($_SESSION['newResTableNum']);
		
		$dateTime = $date . ' ' . $time;
		
		$sql = "INSERT INTO Reservation (reservationID, num_people, dateTime, customerID, tableID)
		VALUES (NULL, '$numPeople', '$dateTime', '$customerID', '$tableNum')";

		if (mysqli_query($con, $sql)) {
			header("location:reservations.php");
		} else {
			$error = "Error: " . $sql . "<br>" . $conn->error;
			header("location:reservations.php");
		}
	}
	# initial page is loaded and displays reservation info minus customer
	elseif (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['numPeople']) && !empty($_POST['tableNum'])) {
		$date = $_POST['date'];
		$time = $_POST['time'];
		$numPeople = $_POST['numPeople'];
		$tableNum = $_POST['tableNum'];
		
		$_SESSION['newResDate'] = $date;
		$_SESSION['newResTime'] = $time;
		$_SESSION['newResNumPeople'] = $numPeople;
		$_SESSION['newResTableNum'] = $tableNum;
		
		echo "<h3 class=\"text-center\">Reservation on $date at $time for $numPeople people</h3>";
		echo "<br/>";
	}
	
	?>
	<h3 class="text-center">Search Customer Last Name</h3>	
           
	<div style="text-align:center">
	<input id="searchCustomerInput" type="search" class="form-control" placeholder="Customer Last Name">
	<div id="searchCustomerResult"></div>
	</div>
	
	<h3 class="text-center">OR Add New Customer</h3>
	<div style="text-align:center">
		<button type="button" class="btn btn-primary " id="newCustomerButton">New Customer</button>
		<form id="addCustomerForm" style="display:none" method="post" action="">
			<label for="firstName">First Name:</label>
			<input type="text" class="form-control" id="firstName" name="newCustomerFirstName">
			<label for="lastName">Last Name:</label>
			<input type="text" class="form-control" id="lastName" name="newCustomerLastName">
			<br/>
			<div style="text-align:center">
			<button type="submit" class="btn btn-primary" name="newCustomer" value="newCustomer">Confirm Reservation</button>
			</div>
		</form>
	</div>
	
</div> <!-- end of column -->
</div> <!-- end of row -->
</div> <!-- end of container -->
</body>
<?php
mysqli_close($con);
?>
</html>
