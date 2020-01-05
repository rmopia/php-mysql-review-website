<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Add A Movie</title>
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
<div class="container">
	<h1>Add a Movie</h1>
	<form action="movies.php" method="post">
		<input type="text" class="form-control" name="title" size="28" maxlength="20" value="" />
		<input type="text" class="form-control" name="year" size="28" maxlength="20" value="" />
	</form>
</div>