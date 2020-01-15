<!DOCTYPE html>
<html lang="en">
<head>
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

	if(isset($_GET['message'])){
		echo $_GET['message'];
	}

		$servername = "localhost";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, "root", $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 

	if(isset($_GET['id'])){ 
		$id = $_GET['id'];
		
		$find_type_query = "SELECT * FROM media WHERE mid=".$id;
			$type_response = mysqli_query($conn, $find_type_query);
			if($type_response){
				while($row = mysqli_fetch_array($type_response)){
					$title = $row['title'];
					$year = $row['year'];
					$type = $row['type'];
					$desc = $row['description'];
					$img = $row['image'];
				}
			}
	}
	
	if(isset($_POST['fav-media'])){
		$username = $_SESSION['username'];
		$mid = $_POST['mid'];
		$type = $_POST['type'];
		$media_title = $_POST['title'];
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
					
					echo "<div class='container'><p class='text-success'>".$title." favorited!</p></div>";
				}
				else{
					if($favorite == 0){
						$update_fav_query = "UPDATE favorites SET favorite=1 WHERE mid=".$mid." AND username='".$username."'"; 
						$update_fav_response = mysqli_query($conn, $update_fav_query);
						if($update_fav_response){
							echo "<div class='container'><p class='text-success'>".$media_title." favorited!</p></div>";
						}
					}
					else if($favorite == 1){
						$update_fav_query = "UPDATE favorites SET favorite=0 WHERE mid=".$mid." AND username='".$username."'"; 
						$update_fav_response = mysqli_query($conn, $update_fav_query);
						if($update_fav_response){
							echo "<div class='container'><p class='text-success'>".$media_title." unfavorited!</p></div>";
						}
					}
				}
			}
			else{
				echo "<div class='container'><p class='text-danger'>A problem has occurred!</p></div>";
			}
		}
	}
	
	if(isset($_POST['review-submit'])){
		$username = $_POST['username'];
		$r_mid = $_POST['mid'];
		$text = $_POST['review-text'];
		$score = $_POST['score'];
		
		if(empty($text)){
			echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
		}
		else{
			$insert_query = "INSERT INTO reviews (mid, username, score, review, date_posted) 
			VALUES (?,?,?,?,CURDATE())"; 
		
			$insert = mysqli_prepare($conn, $insert_query);
			mysqli_stmt_bind_param($insert, "isis", $r_mid, $username, $score, $text);
			mysqli_stmt_execute($insert);
			echo "<div class='container'><p class='text-success'>Review added!</p></div>";
		}
	}
	else if(isset($_POST['review-update'])){
		$username = $_POST['username'];
		$r_mid = $_POST['mid'];
		$text = $_POST['review-text'];
		$score = $_POST['score'];
		
		if(empty($text)){
			echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
		}
		else{
			$update_query = "UPDATE reviews SET score=?, review=?, date_posted=CURDATE() WHERE mid=".$r_mid." AND username='".$username."'"; 
		
			$update = mysqli_prepare($conn, $update_query);
			mysqli_stmt_bind_param($update, "is", $score, $text);
			mysqli_stmt_execute($update);
			
			echo "<div class='container'><p class='text-success'>Review updated!</p></div>";
		}
	}
	else if(isset($_POST['review-delete'])){
		$username = $_POST['username'];
		$mid = $_POST['mid'];
		$password = $_POST['password'];
		$check_user_query = "SELECT * FROM reviewers WHERE username='".$username."' AND password='".$password."'";
		$check_user_response = mysqli_query($conn, $check_user_query);
			if($check_user_response){
				$row = mysqli_fetch_array($check_user_response);
				$check_username = $row['username'];
				$check_password = $row['password'];
				if(empty($check_username) || empty($check_password)){
					echo "<div class='container'><p class='text-danger'>Invalid deletion. Please try again.</p></div>";
				}
				else{
					$delete_query = "DELETE FROM reviews WHERE mid=".$mid." AND username='".$username."'";
					$delete_response = mysqli_query($conn, $delete_query);
					
					if($delete_response){
						echo "<div class='container'><p class='text-success'>Review deleted.</p></div>";
					}
					else if(!$delete_response){
						echo "<div class='container'><p class='text-danger'>An error has occurred.</p></div>";
					}
				}
			}
	}

	$genres_query = "SELECT *,
		GROUP_CONCAT(g.genre) as genres FROM media m INNER JOIN media_genres mg ON m.mid=mg.mid 
		INNER JOIN genres g ON g.gid=mg.gid
		WHERE m.mid='".$id."'";
	$response = mysqli_query($conn, $genres_query);
	if($response){
		while($row = mysqli_fetch_array($response)){
			$genres = $row['genres'];
			$genres_str = str_replace(",", ", ", $genres);
		}
	}
?>
<title>Review It - <?php echo $title ?> </title>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'; ?>
			<form action="details.php?id=<?php echo $id ?>" method="post">
				<input type="hidden" name="title" value="<?php echo $title ?>">
				<input type="hidden" name="mid" value="<?php echo $id ?>">
				<input type="hidden" name="username" value="rmoo">
				<input type="hidden" name="type" value="<?php echo $type ?>">
				<button type="submit" name="fav-media" class="btn btn-link"><b>Favorite</b></button>
			</form>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h1><?php echo $title . ' (' . $year . ')'?></h1>
			<h4><?php echo 'Genre(s): ' . $genres_str ?></h4>
<?php
	$actors_query = "SELECT *,
		GROUP_CONCAT(a.actor) as actors FROM media m INNER JOIN media_actors ma ON m.mid=ma.mid 
		INNER JOIN actors a ON a.aid=ma.aid
		WHERE m.mid='".$id."'";
	$response = mysqli_query($conn, $actors_query);
	if($response){
		$row = mysqli_fetch_array($response);
		$actors = $row['actors'];
		$actors_str = str_replace(",", ", ", $actors);
		//contain a separate link for each actor ala actors.php?id='' containing info, etc.; 
		/*$arr = explode(", ", $actors_str);
		foreach($arr as $val){
			echo $val . '<br />';
		}*/
	}

?>
			<h4><?php echo 'Actors/Actresses: ' . $actors_str ?></h4>
			<h6><?php echo $desc ?></h6>
			<a href="edit.php?id=<?php echo $id ?>&type=<?php echo $type ?>"><b>Edit details</b></a> <!-- work on this portion -->
		</div>
	</div>
</div>
<div class="container">
	<h3>Recent Reviews</h3>
	<p></p><a href="reviewlist.php?mid=<?php echo $id ?>"><b>View more...</b></a><br />
	<?php
		$check_query = "SELECT * FROM reviews WHERE mid=".$id;
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
			$rvw_query = "SELECT * FROM reviews WHERE mid=".$id." ORDER BY date_posted DESC LIMIT 3";
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
					<td align="right"><a href="updatereview.php?id='.$row['mid'].'&user='.$row['username'].'">Update</td>
					<td align="right"><a href="deletereview.php?id='.$row['mid'].'&user='.$row['username'].'">Delete</a></td><td align="left">';
				}
				echo '</tr></table></div>';
			}
		}
	
	?>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<h3>Add A Review</h3>
			<form action="review.php" method="post">
				<input type="hidden" name="title" value="<?php echo $title ?>"> <!-- add in user info later-->
				<input type="hidden" name="mid" value="<?php echo $id ?>">
				<input type="submit" name="review" class="btn btn-primary" value="Add"><p></p>
			</form>
		</div>
	</div>
</div>

<?php 
	mysqli_close($conn);
?>

