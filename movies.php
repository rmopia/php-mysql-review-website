<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Movies</title>
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
	$username = "root";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 

	if(isset($_POST['fav-movie'])){
		$username = $_SESSION['username'];
		$mid = $_POST['mid'];
		$movie_title = $_POST['title'];
		
		if(empty($username) || empty($mid)){
			echo "<div class='container'><p class='text-danger'>A problem has occurred.</p></div>";
		}
		else{
			$fav_query = "SELECT * FROM favorites WHERE username='".$username."' AND mid='".$mid."'";
			$fav_response = mysqli_query($conn, $fav_query);
			if($fav_response){
				$row = mysqli_fetch_array($fav_response);
				$favorite = $row['favorite'];
				
				if(empty($row['favorite']) && empty($row['mid']) && empty($row['username'])){
					$insert_fav_q = "INSERT INTO favorites (mid, username, favorite) VALUES (?,?,1)"; 
					// if new insert then assumed user wants to favorite movie/tv show 0 -> 1
					$insert_fav = mysqli_prepare($conn, $insert_fav_q);
					mysqli_stmt_bind_param($insert_fav, "is", $mid, $username);
					mysqli_stmt_execute($insert_fav);
					
					echo "<div class='container'><p class='text-success'>".$movie_title." favorited!</p></div>";
				}
				else{
					if($favorite == 0){
						$update_fav_query = "UPDATE favorites SET favorite=1 WHERE mid=".$mid." AND username='".$username."'"; 
						$update_fav_response = mysqli_query($conn, $update_fav_query);
						if($update_fav_response){
							echo "<div class='container'><p class='text-success'>".$movie_title." favorited!</p></div>";
						}
					}
					else if($favorite == 1){
						$update_fav_query = "UPDATE favorites SET favorite=0 WHERE mid=".$mid." AND username='".$username."'"; 
						$update_fav_response = mysqli_query($conn, $update_fav_query);
						if($update_fav_response){
							echo "<div class='container'><p class='text-success'>".$movie_title." unfavorited!</p></div>";
						}
					}
				}
			}
			else{
				echo "<div class='container'><p class='text-danger'>A problem has occurred!</p></div>";
			}
		}
	}
		
		if(isset($_POST['add-movie'])){
			if(empty($_POST['title']) || empty($_POST['year']) || empty($_POST['age_rating'])
				|| empty($_POST['director']) || empty($_POST['runtime'])){
					echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				}
			else{
				$add_movie_query = "INSERT INTO media (title, year, age_rating, director, runtime, services, description, type) 
				VALUES (?,?,?,?,?,?,?,'movie')";
				
				$add_movie = mysqli_prepare($conn, $add_movie_query);
				mysqli_stmt_bind_param($add_movie, "sississ", $_POST['title'], $_POST['year'], $_POST['age_rating'],
				$_POST['director'], $_POST['runtime'], $_POST['services'], $_POST['description']);
				mysqli_stmt_execute($add_movie);
				
			}
		}
		
		if(isset($_POST['edit-movie'])){
			if(empty($_POST['title']) || empty($_POST['year'])){
					echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				}
			else{
				
				$edit_movie_query = "UPDATE media SET title='".$_POST['title']."',year=".$_POST['year'].", age_rating='".$_POST['age_rating']."',
				director='".$_POST['director']."', runtime=".$_POST['runtime'].", services='".$_POST['services']."',
				description='".$_POST['description']."' WHERE mid=".$_POST['mid'];
				$edit_movie_response = mysqli_query($conn, $edit_movie_query);
				if($edit_movie_response){
					echo '<div class="p-3 mb-2 bg-success text-dark container"><b>Changes successful.</b></div>';
				}
				else{
					echo '<div class="p-3 mb-2 bg-danger text-dark container"><b>Something went wrong.</b></div>';
				}
				
			}
		}
?>	
	<div class="container">
		<h1>Movies</h1>
		<a href="addmovie.php"><b>Add A Movie</b></a>
	</div>
<?php		
		$query = "SELECT * FROM media m WHERE m.type='movie' GROUP BY m.mid ORDER BY year DESC";
		
		$response = mysqli_query($conn, $query);
		if($response){
			echo '<div class="container"><table class="table table-striped table-hover"><thead><tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Runtime (mins)</th>
			<th scope="col">Age Rating</th>
			<th scope="col">Director</th>
			<th scope="col">Services</th></tr></thead>';
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><td align="left"><a href="details.php?id='.$row['mid'].'">' . $row['title'] . '</a></td> 
				<td align="left">' . $row['year'] . '</td>
				<td align="left">' . $row['runtime'] . '</td>
				<td align="left">' . $row['age_rating'] . '</td>
				<td align="left">' . $row['director'] . '</td>
				<td align="left">' . $row['services'] . '</td>
				<form action="movies.php" method="post">
				<input type="hidden" name="title" value="'.$row["title"].'">
				<input type="hidden" name="mid" value="'.$row["mid"].'">
				<td align="left"><button type="submit" name="fav-movie" class="btn btn-link"><i>Favorite</i></button></td>
				</form>';
			}
			echo '</tr></table></div>';
		}
		else{
			echo "problem";
		}
		
		mysqli_close($conn);
?>