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
	
	if(isset($_GET['mid'])){ // if hyperlink is clicked, mid is grabbed
		$mid = $_GET['mid'];
		
		$find_type_query = "SELECT * FROM media WHERE mid=".$mid;
			$type_response = mysqli_query($conn, $find_type_query);
			if($type_response){
				while($row = mysqli_fetch_array($type_response)){
					$title = $row['title'];
					$year = $row['year'];
				}
			}
		}
?>
<div class="container">
	<h1>Reviews: <?php echo $title.' ('.$year.')'?></h1>
	<!-- Add review filter options -->
	<?php
	
		$check_query = "SELECT * FROM reviews WHERE mid=".$mid;
		$check_response = mysqli_query($conn, $check_query);
		if($check_response){
			while($row = mysqli_fetch_array($check_response)){
				$check = $row['mid'];
			}
		}
		
		if(empty($check)){
			echo "<b>Currently no reviews available! </b>";
		}
		else{
			$rvw_query = "SELECT * FROM reviews WHERE mid=".$mid." ORDER BY date_posted DESC";
			$rvw_response = mysqli_query($conn, $rvw_query);
		
			if($rvw_response){
				echo '<div class="container"><table class="table table-striped table-hover"><thead><tr>
				<th scope="col">Username</th>
				<th scope="col">Score</th>
				<th scope="col">Review</th>
				<th scope="col">Date Posted</th></tr></thead>';
				while($row = mysqli_fetch_array($rvw_response)){
					echo '<tr><td align="left">' . $row['username'] . '</td> 
					<td align="left">' . $row['score'] . '</td>
					<td align="left">' . $row['review'] . '</td>
					<td align="left">' . $row['date_posted'] . '</td>
					<td align="left"><a href="delete.php?id='.$row['mid'].'&user='.$row['username'].'">Delete</a></td><td align="left">';
				}
				echo '</tr></table></div>';
			}
		}
		
	?>
</div>