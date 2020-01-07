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

	if(isset($_GET['id'])){ // if hyperlink is clicked, mid is grabbed
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
	
	if(isset($_POST['review-submit'])){
		$username = "rmoo"; // change later to be dynamic
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
		}
	}
	else if(isset($_POST['review-update'])){
		$username = "rmoo"; // change later to be dynamic
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
		}
	}
	else if(isset($_POST['review-delete'])){
		$username = $_POST['username'];
		$mid = $_POST['mid'];
		$delete_query = "DELETE FROM reviews WHERE mid=".$mid." AND username='".$username."'";
		$delete_response = mysqli_query($conn, $delete_query);
		
		if($delete_response){
			echo "<div class='container'><p class='text-success'>Delete successful.</p></div>";
		}
		else if(!$delete_response){
			echo "<div class='container'><p class='text-danger'>An error has occurred.</p></div>";
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
	
	$actors_query = "SELECT *,
		GROUP_CONCAT(a.actor) as actors FROM media m INNER JOIN media_actors ma ON m.mid=ma.mid 
		INNER JOIN actors a ON a.aid=ma.aid
		WHERE m.mid='".$id."'";
	$response = mysqli_query($conn, $actors_query);
	if($response){
		while($row = mysqli_fetch_array($response)){
			$actors = $row['actors'];
			$actors_str = str_replace(",", ", ", $actors);
		}
	}
	
?>
<title>Review It - <?php echo $title ?> </title>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'; ?>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<h1><?php echo $title . ' (' . $year . ')'?></h1>
			<h4><?php echo 'Genre(s): ' . $genres_str ?></h4>
			<h4><?php echo 'Actors/Actresses: ' . $actors_str ?></h4>
			<h6><?php echo $desc ?></h6>
			<a href="edit.php?id=<?php echo $id ?>&type=<?php echo $type ?>"><b>Edit details</b></a> <!-- work on this portion -->
		</div>
	</div>
</div>
<?php
	if($response){
		
		if($type=="movie"){
			
		}
		else if($type=="tv"){
			
		}
		else{
			echo "error - empty";
		}
	}
?>
<div class="container">
	<h3>Recent Reviews</h3>
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
			$rvw_query = "SELECT * FROM reviews WHERE mid=".$id." ORDER BY date_posted DESC";
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
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<h3>Add/Update A Review</h3>
			<form action="review.php" method="post">
				<input type="hidden" name="title" value="<?php echo $title ?>"> <!-- add in user info later-->
				<input type="hidden" name="mid" value="<?php echo $id ?>">
				<input type="submit" name="review" class="btn btn-primary" value="Add/Update">
			</form>
		</div>
	</div>
</div>

<?php 
	mysqli_close($conn);
?>

