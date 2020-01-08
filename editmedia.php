<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Edit Media</title>
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
          <a class="dropdown-item" href="edituser.php?username=rmoo">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
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
?>
<div class="container">
	<h1>Edit Details</h1>

	<?php
		if(isset($_GET['id']) && $_GET['type'] == 'tv'){ 
			$id = $_GET['id'];
			$edit_query = "SELECT * FROM media WHERE mid=".$id;
			$edit_response = mysqli_query($conn, $edit_query);
			if($edit_response){
				while($row = mysqli_fetch_array($edit_response)){
					$title = $row['title'];
					$year = $row['year'];
					$description = $row['description'];
					$img = $row['image']; // allow user to modify later
					$age_rating = $row['age_rating'];
					$director = $row['director'];
					$seasons = $row['seasons'];
					$episodes = $row['episodes'];
					$services = $row['services'];
				}
			}
	?>
			<form action="television.php" method="post">
				<div class="col-xs-4">
					<label for="title">Title</label>
					<input type="hidden" name="mid" value="<?php echo $id ?>">
					<input type="text" class="form-control" name="title" size="2" maxlength="255" value="<?php echo $title ?>" /><p></p>
					<label for="year">Year</label>
					<input type="number" class="form-control" name="year" size="28" maxlength="4" value="<?php echo $year ?>" max="2050" /><p></p>
					<label for="age_rating">Age Rating</label>
					<input type="text" class="form-control" name="age_rating" size="28" maxlength="10" value="<?php echo $age_rating ?>"/><p></p>
					<label for="director">Director</label>
					<input type="text" class="form-control" name="director" size="2" maxlength="255" value="<?php echo $director ?>" /><p></p>
					<label for="seasons">Seasons</label>
					<input type="number" class="form-control" name="seasons" size="28" maxlength="4" value="<?php echo $seasons ?>"/><p></p>
					<label for="episodes">Episodes (Total)</label>
					<input type="number" class="form-control" name="episodes" size="28" maxlength="10" value="<?php echo $episodes ?>"/><p></p>
					<label for="services">Services (Where the show is available)</label>
					<input type="text" class="form-control" name="services" size="28" maxlength="50" value="<?php echo $services ?>"/><p></p>
					<label for="description">Description</label>
					<textarea class="form-control" type="text" name="description" value="" rows="6" cols="40"><?php echo $description ?></textarea>
					<p></p>
					<input type="submit" name="edit-show" class="btn btn-primary" value="Finish">
					<p></p>
				</div>
			</form>
		<?php } 
		else if(isset($_GET['id']) && $_GET['type'] == 'movie'){ 
			$id = $_GET['id'];
			$edit_query = "SELECT * FROM media WHERE mid=".$id;
			$edit_response = mysqli_query($conn, $edit_query);
			if($edit_response){
				while($row = mysqli_fetch_array($edit_response)){
					$title = $row['title'];
					$year = $row['year'];
					$description = $row['description'];
					$img = $row['image']; // allow user to modify later
					$age_rating = $row['age_rating'];
					$director = $row['director'];
					$runtime = $row['runtime'];
					$services = $row['services'];
				}
			}
		?>
			<form action="movies.php" method="post">
				<div class="col-xs-4">
					<input type="hidden" name="mid" value="<?php echo $id ?>">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" size="2" maxlength="255" value="<?php echo $title ?>" /><p></p>
					<label for="year">Year</label>
					<input type="number" class="form-control" name="year" size="28" maxlength="4" value="<?php echo $year ?>" max="2050" /><p></p>
					<label for="age_rating">Age Rating</label>
					<input type="text" class="form-control" name="age_rating" size="28" maxlength="10" value="<?php echo $age_rating ?>"/><p></p>
					<label for="director">Director</label>
					<input type="text" class="form-control" name="director" size="2" maxlength="255" value="<?php echo $director ?>" /><p></p>
					<label for="seasons">runtime</label>
					<input type="number" class="form-control" name="runtime" size="28" maxlength="4" value="<?php echo $runtime ?>"/><p></p>
					<label for="episodes">Services (Where the movie is available)</label>
					<input type="text" class="form-control" name="services" size="28" maxlength="50" value="<?php echo $services ?>"/><p></p>
					<label for="description">Description</label>
					<textarea class="form-control" type="text" name="description" value="" rows="6" cols="40"><?php echo $description ?></textarea>
					<p></p>
					<input type="submit" name="edit-movie" class="btn btn-primary" value="Finish">
					<p></p>
				</div>
			</form>
		<?php } ?>
</div>
<?php 
	mysqli_close($conn);
?>