<!DOCTYPE html>
<html lang="en">
<head>
  <title>503 Movie Reviews</title>
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
      <a class="navbar-brand" href="home.php">Reviews</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="home.php">Movies</a></li>
	  <li><a href="home.php">TV</a></li>
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