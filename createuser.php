<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php
	session_start();
	include_once("navbar.php");
	
	if(!empty($_SESSION['username'])){
		$message = "<div class='container'><b class='text-warning'>You are already logged in. Logout to proceed.</b></div>";
	}

	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
?>

<div class="container">
	<h1>Create User</h1>
	<a href="login.php">Already have an account? <b>Login</b></a><p></p>

	<form action="login.php" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" size="2" maxlength="255" value="" /><p></p>
				<label for="fname">First Name (Optional)</label>
				<input type="text" class="form-control" name="fname" size="2" maxlength="255" value="" /><p></p>
				<label for="lname">Last Name (Optional)</label>
				<input type="text" class="form-control" name="lname" size="2" maxlength="255" value="" /><p></p>
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" size="2" maxlength="255" value="" /><p></p>
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" size="2" maxlength="255" value="" /><p></p>
				<label for="password2">Confirm Password</label>
				<input type="password" class="form-control" name="password2" size="2" maxlength="255" value="" /><p></p>
				<input type="submit" name="create-user" class="btn btn-primary" value="Create User"><p></p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div>
		</div>
	</form>
</div>
<?php 
	mysqli_close($conn);
?>