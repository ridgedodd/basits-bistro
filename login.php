<?php
session_start();
$error='';

if(isset($_POST['username']) && isset($_POST['password'])) {
	
	require_once('./library.php');
	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	// Check connection
	if (mysqli_connect_errno()) {
		echo("Can't connect to MySQL Server. Error code: " .
		mysqli_connect_error());
		return null;
	}
	
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	
	$sql="SELECT * FROM User where username = '$username' AND password_hash = md5('$password')";
	$result = mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count==1){
		$row=mysqli_fetch_array($result);
		$_SESSION['role'] = $row['role'];
		header('location:home.php');
	}
	else {
		$error = "Username or Password is invalid";
	}
	
	mysqli_close($con);
	
	
	#$_SESSION['role'] = 'role1';
	#header('location:home.php');
}


?>