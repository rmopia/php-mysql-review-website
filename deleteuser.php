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
	
	$servername = "localhost";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, "root", $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
	
	if(isset($_POST['delete-user'])){
		$username = $_POST['username'];
	}
?>
<div class="container">
	<h1>Delete Account</h1>
	<div class="p-3 mb-2 bg-danger text-dark"><b>Warning: This will permanently delete your account, <?php echo $username ?>.</b></div>
	<p></p>
	<form action="home.php" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<input type="hidden" name="username" value="<?php echo $username ?>" />
				<label for="pw1">Password</label>
				<input type="password" class="form-control" name="pw1" size="2" maxlength="255" value="" /><p></p>
				<label for="pw2">Confirm Password</label>
				<input type="password" class="form-control" name="pw2" size="2" maxlength="255" value="" /><p></p><p></p>
				<input type="submit" name="delete-user-confirm" class="btn btn-danger" value="Delete Account"><p></p>
			</div>
		</div>
	</form>
</div>