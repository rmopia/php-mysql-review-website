<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Homepage</title>
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
	
	if(isset($_POST['unwatch']) && !empty($_SESSION['username'])){
		$title = $_POST['title'];
		$mid = $_POST['mid'];
		$username = $_SESSION['username'];
		
		$update_wl_query = "UPDATE watchlist SET watch=0 WHERE mid=".$mid." AND username='".$username."'"; 
		$update_wl_response = mysqli_query($conn, $update_wl_query);
		if($update_wl_response){
			echo "<div class='container'><p class='text-success'>".$title." removed from watchlist!</p></div>";
		}
	}
?>
<div class="container">
	<h1>Watchlist</h1>
</div>
<?php
	if(empty($_SESSION['username'])){
		$message = "<div class='container'><p class='text-danger'>Please login to proceed.</p></div>";
		header("Location:home.php?message=".$message);
	}
	else{
		$username = $_SESSION['username'];
		$wl_query = 'SELECT * FROM watchlist WHERE username="'.$username.'" AND watch=1';
		$wl_response = mysqli_query($conn, $wl_query);
		if($wl_response){
			echo '<div class="container"><table class="table table-striped table-hover"><thead class="thead-dark"><tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Age Rating</th>
			<th scope="col">Services</th></thead>';
			while($row = mysqli_fetch_array($wl_response)){
				$content_query = "SELECT * FROM media WHERE mid=".$row['mid'];
				$content_response = mysqli_query($conn, $content_query);
				if($content_response){
					$row2 = mysqli_fetch_array($content_response);
					$title = $row2['title'];
					$year = $row2['year'];
					$age_rating = $row2['age_rating'];
					$services = $row2['services'];
				}
				echo '<tr><td align="left"><a href="details.php?id='.$row['mid'].'">' . $title . '</a></td>
				<td align="left">' . $year . '</td>
				<td align="left">' . $age_rating . '</td>
				<td align="left">' . $services . '</td>
				<form action="watchlist.php" method="post">
				<input type="hidden" name="title" value="'.$title.'">
				<input type="hidden" name="mid" value="'.$row['mid'].'">
				<td align="right"><button type="submit" name="unwatch" class="btn btn-link"><i>Remove</i></button></td>
				</form>';
			}
			echo '</tr></table></div>';
		}
	}		
?>