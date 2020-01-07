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
<div class="container">
	<h1>Movies</h1>
	<a href="addmovie.php"><b>Add A Movie</b></a>
</div>

<?php
		$servername = "localhost";
		$username = "root";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
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
				<td align="left">' . $row['services'] . '</td><td align="left">';
			}
			echo '</tr></table></div>';
		}
		else{
			echo "problem";
		}
		
		mysqli_close($conn);
?>