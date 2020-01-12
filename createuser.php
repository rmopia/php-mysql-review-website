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
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="edituser.php?username=<?php echo $username ?>">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
	  <li><form action="search.php" class="form-inline my-2 my-lg-0" method="GET">
			<input class="form-control mr-sm-2" name="t" type="search" placeholder="..." aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form></li>
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