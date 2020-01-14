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
          <a class="dropdown-item" href="logout.php">Logout</a>
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
	
	if(isset($_POST['change-pw'])){
		$username = $_POST['username'];
	}
?>
<div class="container">
	<h1>Change Password</h1>
	<form action="edituser.php?username=rmoo" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<input type="hidden" name="username" value="<?php echo $username ?>" />
				<label for="oldpw1">Old Password</label>
				<input type="password" class="form-control" name="oldpw1" size="2" maxlength="255" value="" /><p></p>
				<label for="oldpw2">Reconfirm Old Password</label>
				<input type="password" class="form-control" name="oldpw2" size="2" maxlength="255" value="" /><p></p>
				<label for="newpw">New Password</label>
				<input type="password" class="form-control" name="newpw" size="2" maxlength="255" value="" /><p></p>
				<input type="submit" name="change-user-pw" class="btn btn-success" value="Save"><p></p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div>
		</div>
	</form>
</div>
