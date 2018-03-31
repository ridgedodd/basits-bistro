<?php
	session_start();
	//Checking User Logged or Not
	if(empty($_SESSION['role'])){
	 header('location:index.php');
	}
	
	if(isset($_POST['addItem'])) {
		if(empty($_POST['fName'])) {
			$_SESSION['addItemError'] = "You must add a name to the new food item";
		}
		elseif(empty($_POST['fCategory'])) {
			$_SESSION['addItemError'] = "You must add a category to the new food item";
		}
		elseif(empty($_POST['fPrice'])) {
			$_SESSION['addItemError'] = "You must add a price to the new food item";
		}
		else {
			$fName = $_POST['fName'];
			$fCategory = $_POST['fCategory'];
			$fPrice = $_POST['fPrice'];
			if ($_POST['fVeg'] == 'Yes') {
				$fVeg = 1;
			}
			else {
				$fVeg = 0;
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
			 $sql="INSERT INTO Food (food_name, category, price, vegetarian) 
				VALUES ('$fName', '$fCategory', $fPrice, $fVeg)";
			 
			if (mysqli_query($con, $sql)) {
				
			} else {
				$error = "Error: " . $sql . "<br>" . $conn->error;
			}
			 mysqli_close($con);
		 
		}
	}
	
	header("location:menu.php");
?>