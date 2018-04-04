<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/jquery-1.11.3.min.js"></script>
<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="padding-top:70px">
<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['role'])){
 header('location:index.php');
}

?>
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
<img class="mx-auto d-block" src="logo-60.png">
<div class="text-center">
<h1>Welcome to Basit's Bistro!</h1>
<p>Work in progress...</p>
<?php
echo $_SESSION['dbUsername'];
echo "<br/>";
echo $_SESSION['role'];
?>
</div>
</div>

</body>
</html>