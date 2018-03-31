<?php
include('login.php');
?>
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
<div class="container">
<div class="row">
<div class="col-md-4 mx-auto">
<?php
	if(isset($_GET['loggedOut'])) {
		$loggedOut = $_GET['loggedOut'];
		if ($loggedOut == 1) {
			?>
			<br/>
			<div class="alert alert-success">
				You have successfully logged out.
			</div>
			<br/>
			<?php
		}
	}
?>

<form method="post" action="">
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
  <div>
  <?php 
	if ($error != '') {
	 ?>
	 <br/>
	 <div class="alert alert-danger">
		<?php echo $error; ?>
	</div>
	<?php
	}
?>
  </div>
</form>
</div> <!-- col -->
</div> <!-- row -->
</div> <!-- container -->
</body>
</html>