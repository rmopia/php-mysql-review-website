<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">Review It</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="television.php">TV</a></li>
	  <li><a href="movies.php">Movies</a></li>
	  <li><a href="contact.php">Contact</a></li>
	  <li><a href="login.php">Login</a></li>
    </ul>
  </div>
</nav>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
?>

<div class="container">
	<h1>Edit Account</h1>

	<form action="home.php" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" size="2" maxlength="255" value="" /><p></p>
				<label for="fname">First Name</label>
				<input type="text" class="form-control" name="fname" size="2" maxlength="255" value="" /><p></p>
				<label for="lname">Last Name</label>
				<input type="text" class="form-control" name="lname" size="2" maxlength="255" value="" /><p></p>
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" size="2" maxlength="255" value="" /><p></p>
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" size="2" maxlength="255" value="" /><p></p>
				<input type="submit" name="edit-user" class="btn btn-primary" value="Finish Edit"><p></p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div>
		</div>
	</form>
</div>