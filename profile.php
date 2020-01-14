<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Profile</title>
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
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
	  <li><form action="search.php" class="form-inline my-2 my-lg-0" method="GET">
			<input class="form-control mr-sm-2" name="t" type="search" placeholder="..." aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form></li>
    </ul>
  </div>
</nav>
<?php
	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
	
	if(isset($_GET['username'])){
		$username = $_GET['username'];
		
		$info_query = 'SELECT * FROM reviewers WHERE username="'.$username.'"';
		$info_response = mysqli_query($conn, $info_query);
		if($info_response){
			while($row = mysqli_fetch_array($info_response)){
				$fname = $row['fname'];
				$lname = $row['lname'];
				$email = $row['email'];
				$portrait = $row['portrait'];
			}
		}
		
	}
	
?>

<div class="container">
	<h1>Profile</h1>
	<a href="edituser.php?username=<?php echo $username ?>"><b>Edit Profile</b></a><br />
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<label>Username</label>
				<h5><?php echo $username ?></h5>
				<label>Name</label><br />
				<h5><?php echo $fname ?> <?php echo $lname ?></h5><br />
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<label>Email</label><br />
				<h5><?php echo $email ?></h5><br />
				<label>Profile Picture</label><br />
				<?php echo '<img src="data:portrait/jpeg;base64,'.base64_encode( $portrait ).'"/>'; ?>
				<!-- add option to change profile picture here -->
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<h2>Recent Reviews</h2>
<?php
	$rvws_query = "SELECT * FROM reviews WHERE username='".$username."' ORDER BY date_posted DESC LIMIT 3";
	$rvws_response = mysqli_query($conn, $rvws_query);
	
	if($rvws_response){
		echo '<div class="container"><table class="table table-striped table-hover"><thead><tr>
		<th scope="col">Score</th>
		<th scope="col">Review</th>
		<th scope="col">Date Posted</th></tr></thead>';
		while($row = mysqli_fetch_array($rvws_response)){
			if(empty($row['score']) || empty($row['username']) || empty($row['review']) || empty($row['mid'])){
				echo "<b>Currently no reviews available! </b>";
			}
			else{
				echo '<tr><td align="left">' . $row['score'] . '</td> 
				<td align="left">' . $row['review'] . '</td>
				<td align="left">' . $row['date_posted'] . '</td>
				<td align="left"><a href="delete.php?id='.$row['mid'].'&user='.$row['username'].'">Delete</a></td><td align="left">';
			}
		}
		echo '</tr></table></div>';
	}				
?>
			</div>
		</div>
		<form action="deleteuser.php" method="post">
			<div class="footer">
				<input type="hidden" name="username" value="<?php echo $username ?>" />
				<input type="submit" name="delete-user" class="btn btn-danger" value="Delete Account"><p></p>
			</div>
		</form>
</div>
<?php 
	mysqli_close($conn);
?>