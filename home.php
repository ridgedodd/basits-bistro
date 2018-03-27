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
<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['role'])){
 header('location:index.php');
}

?>
<div class="container-fluid">
<h1>Welcome to Basit's Bistro!</h1>
<p>Work in progress...</p>
<form action="menu.php">
    <input type="submit" value="View Menu" />
</form>
<form action="reservations.php">
    <input type="submit" value="View or Make Reservations" />
</form>
<form action="logout.php">
    <input type="submit" value="Log Out" />
</form>
</div>

</body>
</html>