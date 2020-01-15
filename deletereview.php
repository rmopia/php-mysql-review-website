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
<?php
	session_start();
	include_once("navbar.php");

	$servername = "localhost";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, "root", $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
	
	if($_GET['user'] != $_SESSION['username']){
		$message = "<div class='container'><p class='text-danger'>Error: Not allowed to remove this review.</p></div>";
		header('Location:details.php?id='.$_GET['id'].'&message='.$message);
		die;
	}
	
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
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<form action="details.php?id=<?php echo $mid ?>" method="post">
		<input type="hidden" name="username" value="<?php echo $username ?>">
		<input type="hidden" name="mid" value="<?php echo $mid ?>">
		<label for="password">Password</label>
		<input type="password" class="form-control" name="password" size="2" maxlength="255" value="" /><p></p>
		<input type="submit" name="review-delete" class="btn btn-danger" value="Delete">
	</form>
	</div>
</div>
<?php 
	mysqli_close($conn);
?>