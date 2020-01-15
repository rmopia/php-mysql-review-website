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
<?php
	session_start();
	include_once("navbar.php");

	$servername = "localhost";
	$password = "pwdpwd";
	$dbname = "review_site";
	
	$conn = new mysqli($servername, "root", $password, $dbname);
	$conn->select_db($dbname) or die("Unable to connect to database."); 
	
	if(isset($_GET['t'])){
		$search = $_GET['t'];
	}
	
?>
<div class="container">
	<h1>Search Results: '<?php echo $search ?>'</h1>
	<!-- Add search filter options -->
	<?php
	if($_GET['t'] != ''){
		$search_query = "SELECT * FROM media m, reviews r WHERE m.title LIKE '%$search%' OR m.description LIKE '%$search%' OR m.director LIKE '%$search%'
		OR r.username='%$search%' OR r.review='%$search%'";
		$search_response = mysqli_query($conn, $search_query);
			if($search_response){
				while($row = mysqli_fetch_array($search_response)){ //add if else statements to include reviewers/reviews as well
					$title = $row['title'];
					$desc = $row['description'];
					$director = $row['director'];
					$mid = $row['mid'];
					
					echo '<a href=details.php?id='.$mid.'><h2> '.$title.' </h2></a>';
					
					if(!empty($director)){
						echo '<h6> Director(s): '.$director.' </h6>';
					}
					
					if(!empty($desc)){
						echo '<h6> '.$desc.' </h6>';
					}
					
				}
			}
			else{
				echo "<div class='container'><p class='text-danger'>No Results found.</p></div>";
			}
	}
	else if($_GET['t'] == ''){ //if button is clicked and nothing is inputted into search bar redirect to home page
		header('Location: home.php');
	}
	?>
</div>

<?php
	mysqli_close($conn);
?>