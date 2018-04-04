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
	 
	$tableNum = $_POST['tableNum'];
	$itemsArray = $_POST['items'];
	
	 // Form the SQL query (a SELECT query)
	$sql="INSERT INTO `Order` (orderID, dateTime, tableID) VALUES (NULL, '2018-12-25 20:00:00', '$tableNum')";
	 
	if (mysqli_query($con, $sql)) {
		
	} else {
		$error = "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "SELECT MAX(orderID) FROM `Order`";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$orderID = $row['MAX(orderID)'];

	foreach($itemsArray as $item) {
		$idToAdd = $item[id];
		$sql="INSERT INTO OrderContainsFood (ocfID, orderID, foodID) VALUES (NULL, '$orderID', '$idToAdd')";
		mysqli_query($con, $sql);
	}
	 mysqli_close($con);
 
	header("location:home.php");
?>