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
	
	if(isset($_POST['change-pw'])){
		$username = $_POST['username'];
	}
?>
<div class="container">
	<h1>Change Password</h1>
	<form action="edituser.php?username=<?php echo $username ?>" method="post">
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
