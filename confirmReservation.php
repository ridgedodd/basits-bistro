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
      <a class="nav-link" href="logout.php">Log Out</a>
    </li>
  </ul>
  
</nav>
<div class="container-fluid">
<?php

	if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['numPeople']) && !empty($_POST['tableNum'])) {
		$date = $_POST['date'];
		$time = $_POST['time'];
		$numPeople = $_POST['numPeople'];
		$tableNum = $_POST['tableNum'];
		echo "date: $date";
		echo "<br/>";
		echo "time: $time";
		echo "<br/>";
		echo "numPeople: $numPeople";
		echo "<br/>";
		echo "tableNum: $tableNum";
	}
	
	?>
</div>
</body>
<?php
mysqli_close($con);
?>
</html>
