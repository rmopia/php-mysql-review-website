<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Home</title>
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
          <a class="dropdown-item" href="edituser.php?username=rmoo">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
	<h1>Home</h1>
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3iXeAwsGhV0" allowfullscreen></iframe>
	</div>
</div>
<p></p>
<?php
		$servername = "localhost";
		$username = "root";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
		if(isset($_POST['edit-user'])){
			$profile_pic = $_POST['profile_pic'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
		
			if(empty($password)){ //add validator to compare password input and mysql stored password 
				echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
			}
			else{
				$edit_user_query = "UPDATE reviewers SET fname=?, lname=?, email=?, portrait=? WHERE username='".$_POST['username']."'";
			
				$update_user = mysqli_prepare($conn, $edit_user_query);
				mysqli_stmt_bind_param($update_user, "sssb", $fname, $lname, $email, $profile_pic);
				mysqli_stmt_execute($update_user);
			}
	}
?>
<?php
		mysqli_close($conn);
?>