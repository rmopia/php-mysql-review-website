<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It!</title>
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
		
		if(isset($_POST['review'])){
			$username = $_SESSION['username']; // change later to be dynamic
			$title = $_POST['title'];
			$mid = $_POST['mid'];
		}
		
?>

<div class="container">
	<h1>Add a Review</h1>
	<h2><?php echo $title ?></h2>
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<form action="details.php?id=<?php echo $mid ?>" method="post">
				<h6>Thoughts?</h6>
				<textarea class="form-control" type="text" name="review-text" value="" rows="6" cols="40"></textarea>
				<div class="form-group">
				  <label for="sc">Score:</label>
				  <select class="form-control" name="score">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				  </select>
				</div>
				<input type="hidden" name="title" value="<?php echo $title ?>">
				<input type="hidden" name="mid" value="<?php echo $mid ?>">
				<input type="hidden" name="username" value="<?php echo $username ?>">
				<p></p>
				<p></p>
				<input type="submit" name="review-submit" class="btn btn-primary" value="Add">
			</form>
		</div>
	</div>
</div>
<?php 
	mysqli_close($conn);
?>


