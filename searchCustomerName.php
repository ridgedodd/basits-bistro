<?php
	session_start();
	//Checking User Logged or Not
	if(empty($_SESSION['role'])){
	 header('location:index.php');
	}
	
	$con = new mysqli($_SESSION['dbServer'], $_SESSION['dbUsername'], $_SESSION['dbPassword'], $_SESSION['dbDatabase']);
	
	
	#$date = $_SESSION['newResDate'];
	#$time = $_SESSION['newResTime'];
	#$numPeople = $_SESSION['newResNumPeople'];
	#$tableNum = $_SESSION['newResTableNum'];
	
	$stmt = $con->stmt_init();
	
	if($stmt->prepare("select * from Customer where last_name like ?") or die(mysqli_error($con))) {
		$searchString = '%' . $_GET['searchCustomers'] . '%';
		$stmt->bind_param(s, $searchString);
		$stmt->execute();
		$stmt->bind_result($id, $first_name, $last_name);
		echo "<table class='table'><thead><th>First Name</th><th>Last Name</th><th>Confirm Reservation</th></thead><tbody>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$first_name</td><td>$last_name</td><td>
				<form action=\"confirmReservation.php\" method=\"post\">
						<input type=\"hidden\" name=\"chosenCustomer\" value=\"$id\" />
						<button type=\"submit\" class=\"btn btn-success\">
						<i class=\"fa fa-check-circle\" style=\"color:white\"></i>
						</button>
					</form>
			</td></tr>";
		}
		echo "</tbody></table>";
	
		$stmt->close();
	}
	
	
	
	mysqli_close($con);


?>
