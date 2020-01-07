<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Contact</title>
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
	
	if(isset($_POST['send-contact'])){
		$name = $_POST['name'];
		$comment = $_POST['comment'];
		$email = $_POST['email'];
		
		if((!empty($name) && !empty($comment) && !empty($email)) || (!empty($name) && !empty($comment)) || (!empty($email) && !empty($comment))){
			// send to business email and store in mysql database
			$insert_comment_query = "INSERT INTO comments (name, comment, email, date_sent) VALUES (?,?,?,CURDATE())"; 
		
			$insert_comment = mysqli_prepare($conn, $insert_comment_query);
			mysqli_stmt_bind_param($insert_comment, "sss", $name, $comment, $email);
			mysqli_stmt_execute($insert_comment);
		}
		
		else{
			echo "<div class='container'><p class='text-danger'>Comment not sent. Please try again.</p></div>";
		}
	}
?>

<div class="container">
	<h1>Contact Us</h1>
	<h3>Tell us how we're doing!</h3>
	<form action="contact.php" method="post">
	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<label for="fname">Name</label>
			<input type="text" class="form-control" name="name" size="2" maxlength="255" value="" /><p></p>
			<label for="lname">Comment</label>
			<textarea type="text" class="form-control" name="comment" size="2" value="" rows="6" cols="40"></textarea><p></p>
			<label for="email">Email</label>
			<input type="text" class="form-control" name="email" size="2" maxlength="255" value="" /><p></p>	
			<input type="submit" name="send-contact" class="btn btn-success" value="Send"><p></p>
		</div>
	</form>
</div>
<?php 
	mysqli_close($conn);
?>