<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Update Review</title>
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
		
		if($_GET['user'] != $_SESSION['username']){
			$message = "<div class='container'><p class='text-danger'>Error: Not allowed to update this review.</p></div>";
			header('Location:details.php?id='.$_GET['id'].'&message='.$message);
			die;
		}
		
		if(isset($_GET['id']) && ($_GET['user'])){
			$mid = $_GET['id'];
			$username= $_GET['user'];
		}
		
		$title_query = "SELECT title FROM media WHERE mid=".$mid;
		$title_response = mysqli_query($conn, $title_query);
			if($title_response){
				$row = mysqli_fetch_array($title_response);
				$title = $row['title'];
			}
		
?>

<div class="container">
<h1>Update A Review</h1>
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
				<input type="hidden" name="mid" value="<?php echo $mid ?>">
				<input type="hidden" name="username" value="<?php echo $username ?>">
				<p></p>
				<p></p>
				<input type="submit" name="review-update" class="btn btn-primary" value="Update">
			</form>
		</div>
	</div>
</div>
<?php 
	mysqli_close($conn);
?>