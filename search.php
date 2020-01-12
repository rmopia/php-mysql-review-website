<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Search</title>
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
	
	if(isset($_GET['search-thing'])){
		$search = $_GET['search-thing'];

	}
?>
<div class="container">
	<h1>Search Results: <?php  ?></h1>
	<!-- Add search filter options -->
	<?php
	$search_query = "SELECT * FROM media m, reviews r WHERE m.title LIKE '".$search."' OR m.description LIKE '".$search."' OR m.director LIKE '".$search."'
	OR r.username LIKE '".$search."' OR r.review LIKE '".$search."'";
		
		$search_response = mysqli_query($conn, $search_query);
		if($search_response){
			while($row = mysqli_fetch_array($search_response)){
				$title = $row['title'];
				$desc = $row['description'];
				$director = $row['director'];
				$username = $row['username'];
				$review = $row['review'];
				
				echo '<h1> '.$title.' </h1>';
			}
		}
		else{
			echo "No results found.";
		}
	?>
</div>

<?php
	mysqli_close($conn);
?>