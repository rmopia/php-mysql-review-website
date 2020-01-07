<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Login</title>
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
	  <li><a href="edituser.php">Account</a></li>
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
	
	if(isset($_POST['create-user'])){
		$username = $_POST['username'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if(empty($username) || empty($email) || empty($password)){
			echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
		}
		else{
			$insert_user_query = "INSERT INTO reviewers (username, fname, lname, email, password) 
			VALUES (?,?,?,?,?)"; 
		
			$insert_user = mysqli_prepare($conn, $insert_user_query);
			mysqli_stmt_bind_param($insert_user, "sssss", $username, $fname, $lname, $email, $password);
			mysqli_stmt_execute($insert_user);
			
			echo "<div class='container'><p class='text-success'>Error: User creation successful.</p></div>";
		}
	}
?>

<div class="container">
	<h1>Login User</h1>
	<a href="createuser.php">New? <b>Create An Account</b></a>

	<form action="home.php" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" size="2" maxlength="255" value="" /><p></p>
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" size="2" maxlength="255" value="" /><p></p>
				<input type="submit" name="login-user" class="btn btn-primary" value="Login"><p></p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				
			</div>
		</div>
	</form>
</div>