<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Delete</title>
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
		
	if(isset($_GET['id']) && ($_GET['user'])){
		$mid = $_GET['id'];
		$username= $_GET['user'];
	}
	// add password validator
?>
<div class="container">
	<h1>Delete A Review</h1>
	<div class="p-3 mb-2 bg-danger text-dark"><b>Warning: By deleting your review, it will be removed permanently.</b></div>
	<p></p>
	<form action="details.php?id=<?php echo $mid ?>" method="post">
		<input type="hidden" name="username" value="<?php echo $username ?>">
		<input type="hidden" name="mid" value="<?php echo $mid ?>">
		<input type="submit" name="review-delete" class="btn btn-danger" value="Delete">
	</form>
</div>