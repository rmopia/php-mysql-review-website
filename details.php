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
		$query='SELECT * FROM media WHERE mid='.$id;
		$response = mysqli_query($conn, $query);
		
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
?>
<title>Review It - <?php echo $title ?> </title>
<div class="container">
	<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'; ?>
	<h1><?php echo $title . ' (' . $year . ')'?></h1>
	<h6><?php echo $desc ?></h6>
</div>
<?php
	if($response){
		
		if($type=="movie"){
			echo "issa movie";
		}
		else if($type=="tv"){
			
		}
		else{
			echo "error - empty";
		}
	}
?>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<h3>Add A Review</h3>
		</div>
	</div>
</div>
