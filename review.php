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
    </ul>
  </div>
</nav>
<?php
		$servername = "localhost";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, "root", $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
		if(isset($_POST['review'])){
			$username = "rmoo"; // change later to be dynamic
			$title = $_POST['title'];
			$mid = $_POST['mid'];
		}
		
?>

<div class="container">
	<h1>Add/Update a Review</h1>
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
				<p></p>
				<p></p>
				<input type="submit" name="review-submit" class="btn btn-primary" value="Add">
				<input type="submit" name="review-update" class="btn btn-primary" value="Update">
			</form>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
		</div>
	</div>
</div>
<?php 
	mysqli_close($conn);
?>


