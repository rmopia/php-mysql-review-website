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
    </ul>
  </div>
</nav>
<div class="container">
	<h1>TV</h1>
	<a href="addtv.php"><b>Add A Show</b></a>
</div>

<?php
		$servername = "localhost";
		$username = "root";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
		if(isset($_POST['add-show'])){
			if(empty($_POST['title']) || empty($_POST['year']) || empty($_POST['age_rating'])
				|| empty($_POST['director']) || empty($_POST['seasons']) || empty($_POST['episodes'])){
					echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				}
			else{
				$add_show_query = "INSERT INTO media (title, year, age_rating, director, seasons, episodes, services, description, type) 
				VALUES (?,?,?,?,?,?,?,?,'tv')";
				
				$add_show = mysqli_prepare($conn, $add_show_query);
				mysqli_stmt_bind_param($add_show, "sissiiss", $_POST['title'], $_POST['year'], $_POST['age_rating'],
					$_POST['director'], $_POST['seasons'], $_POST['episodes'], $_POST['services'], $_POST['description']);
				mysqli_stmt_execute($add_show);
				
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
		if($response){
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
				<td align="left">' . $row['services'] . '</td><td align="left">';
			}
			echo '</tr></table></div>';
		}
		else{
			echo "problem";
		}
		
		mysqli_close($conn);
?>