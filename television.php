<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - TV</title>
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
		
		if(isset($_POST['watch-show'])){
		$username = $_SESSION['username'];
		$mid = $_POST['mid'];
		$show_title = $_POST['title'];
		
			if(empty($username) || empty($mid)){
				echo "<div class='container'><p class='text-danger'>A problem has occurred. Please login.</p></div>";
			}
			else{
				$w_query = "SELECT * FROM watchlist WHERE username='".$username."' AND mid='".$mid."'";
				$w_response = mysqli_query($conn, $w_query);
				if($w_response){
					$row = mysqli_fetch_array($w_response);
					$watch = $row['watch'];
					
					if(empty($row['watch']) && empty($row['mid']) && empty($row['username'])){
						$insert_w_q = "INSERT INTO watchlist (mid, username, watch) VALUES (?,?,1)"; 
						$insert_w = mysqli_prepare($conn, $insert_w_q);
						mysqli_stmt_bind_param($insert_w, "is", $mid, $username);
						mysqli_stmt_execute($insert_w);
						
						echo "<div class='container'><p class='text-success'>".$show_title." added to watchlist!</p></div>";
					}
					else{
						if($watch == 0){
							$update_w_query = "UPDATE watchlist SET watch=1 WHERE mid=".$mid." AND username='".$username."'"; 
							$update_w_response = mysqli_query($conn, $update_w_query);
							if($update_w_response){
								echo "<div class='container'><p class='text-success'>".$show_title." added to watchlist!</p></div>";
							}
						}
						else if($watch == 1){
							$update_w_query = "UPDATE watchlist SET watch=0 WHERE mid=".$mid." AND username='".$username."'"; 
							$update_w_response = mysqli_query($conn, $update_w_query);
							if($update_w_response){
								echo "<div class='container'><p class='text-success'>".$show_title." removed from watchlist!</p></div>";
							}
						}
					}
				}
				else{
					echo "<div class='container'><p class='text-danger'>A problem has occurred!</p></div>";
				}
			}
			
		}
		else if(isset($_POST['fav-show'])){
			$username = $_SESSION['username'];
			$mid = $_POST['mid'];
			$tv_title = $_POST['title'];
			
			if(empty($username) || empty($mid)){
				echo "<div class='container'><p class='text-danger'>A problem has occurred. Please login.</p></div>";
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
						
						echo "<div class='container'><p class='text-success'>".$tv_title." favorited!</p></div>";
					}
					else{
						if($favorite == 0){
							$update_fav_query = "UPDATE favorites SET favorite=1 WHERE mid=".$mid." AND username='".$username."'"; 
							$update_fav_response = mysqli_query($conn, $update_fav_query);
							if($update_fav_response){
								echo "<div class='container'><p class='text-success'>".$tv_title." favorited!</p></div>";
							}
						}
						else if($favorite == 1){
							$update_fav_query = "UPDATE favorites SET favorite=0 WHERE mid=".$mid." AND username='".$username."'"; 
							$update_fav_response = mysqli_query($conn, $update_fav_query);
							if($update_fav_response){
								echo "<div class='container'><p class='text-success'>".$tv_title." unfavorited!</p></div>";
							}
						}
					}
				}
				else{
					echo "<div class='container'><p class='text-danger'>A problem has occurred.</p></div>";
				}
			}
		}
		
?>

<div class="container">
	<h1>TV</h1>
	<a href="addtv.php"><b>Add A Show</b></a>
</div>

<?php
		if(isset($_POST['add-show'])){
			if(empty($_POST['title']) || empty($_POST['year']) || empty($_POST['age_rating'])
				|| empty($_POST['seasons']) || empty($_POST['episodes'])){
					echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				}
			else{
				$services = $_POST['services'];
				$services_str = implode(", ",$services);
				
				if(!empty($services)){
					foreach ($services as $service){
						if($service == 'None'){
							$services_str = '';
							break;
						}
					}
				}
				
				$genres = $_POST['genres'];
				
				$add_show_query = "INSERT INTO media (title, year, age_rating, director, seasons, episodes, services, description, type) 
				VALUES (?,?,?,?,?,?,?,?,'tv')";
				
				$add_show = mysqli_prepare($conn, $add_show_query);
				mysqli_stmt_bind_param($add_show, "sissiiss", $_POST['title'], $_POST['year'], $_POST['age_rating'],
					$_POST['director'], $_POST['seasons'], $_POST['episodes'], $services_str, $_POST['description']);
				mysqli_stmt_execute($add_show);
				
				// if the moderator includes genres to the movie
				if(!empty($genres)){
					$get_mid_q = "SELECT mid FROM media WHERE title='".$_POST['title']."' AND year=".$_POST['year']."";
					$get_mid_response = mysqli_query($conn, $get_mid_q);
					if($get_mid_response){
						$row = mysqli_fetch_array($get_mid_response);
						$mid = $row['mid'];
					}
					foreach ($genres as $genre){
						$add_genre_q = "INSERT INTO media_genres (gid, mid) VALUES (".$genre.",".$mid.")"; 
						$add_genre_response = mysqli_query($conn, $add_genre_q);
					}
					echo "<div class='container'><p class='text-success'>TV Show added!</p></div>";
				}
				else{
					echo "<div class='container'><p class='text-success'>TV Show added!</p></div>";
				}	
			}
		}
		
		if(isset($_POST['edit-show'])){
			if(empty($_POST['title']) || empty($_POST['year'])){
					echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				}
			else{
				$edit_show_query = "UPDATE media SET title='".$_POST['title']."',year=".$_POST['year'].", age_rating='".$_POST['age_rating']."',
				director='".$_POST['director']."', seasons=".$_POST['seasons'].", episodes=".$_POST['episodes'].", services='".$_POST['services']."',
				description='".$_POST['description']."' WHERE mid=".$_POST['mid'];
				$edit_show_response = mysqli_query($conn, $edit_show_query);
				
				if($edit_show_response){
					echo '<div class="p-3 mb-2 bg-success text-dark container"><b>Changes successful.</b></div>';
				}
				else{
					echo '<div class="p-3 mb-2 bg-danger text-dark container"><b>Something went wrong.</b></div>';
				}
			}
		}
		
		$query = "SELECT * FROM media m WHERE m.type='tv' GROUP BY m.mid ORDER BY year DESC";
		
		$response = mysqli_query($conn, $query);
		if($response && !empty($_SESSION['username'])){
			echo '<div class="container"><table class="table table-striped table-hover"><thead><tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Seasons</th>
			<th scope="col">Episodes (total)</th>
			<th scope="col">Age Rating</th>
			<th scope="col">Director</th>
			<th scope="col">Services</th></tr></thead>';
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><form action="television.php" method="post">
				<input type="hidden" name="title" value="'.$row["title"].'">
				<input type="hidden" name="mid" value="'.$row["mid"].'">
				<td align="left"><button type="submit" name="watch-show" class="btn btn-link"><span class="glyphicon glyphicon-plus"></span></button></td>
				</form>
				<td align="left"><a href="details.php?id='.$row['mid'].'">' . $row['title'] . '</a></td> 
				<td align="left">' . $row['year'] . '</td>
				<td align="left">' . $row['seasons'] . '</td>
				<td align="left">' . $row['episodes'] . '</td>
				<td align="left">' . $row['age_rating'] . '</td>
				<td align="left">' . $row['director'] . '</td>
				<td align="left">' . $row['services'] . '</td>
				<form action="television.php" method="post">
				<input type="hidden" name="title" value="'.$row["title"].'">
				<input type="hidden" name="mid" value="'.$row["mid"].'">
				<td align="left"><button type="submit" name="fav-show" class="btn btn-link"><i>Favorite</i></button></td>
				</form>';
			}
			echo '</tr></table></div>';
		}
		else{
			echo '<div class="container"><table class="table table-striped table-hover"><thead><tr>
			<th scope="col">Title</th>
			<th scope="col">Year</th>
			<th scope="col">Seasons</th>
			<th scope="col">Episodes (total)</th>
			<th scope="col">Age Rating</th>
			<th scope="col">Director</th>
			<th scope="col">Services</th></tr></thead>';
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><td align="left"><a href="details.php?id='.$row['mid'].'">' . $row['title'] . '</a></td> 
				<td align="left">' . $row['year'] . '</td>
				<td align="left">' . $row['seasons'] . '</td>
				<td align="left">' . $row['episodes'] . '</td>
				<td align="left">' . $row['age_rating'] . '</td>
				<td align="left">' . $row['director'] . '</td>
				<td align="left">' . $row['services'] . '</td>
				<td align="left"><button type="submit" name="fav-show" class="btn btn-link" disabled><i>Favorite</i></button></td>';
			}
			echo '</tr></table></div>';
		}
		
		mysqli_close($conn);
?>