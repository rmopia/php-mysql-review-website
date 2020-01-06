<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Add A Show</title>
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
	<h1>Add a Show</h1>
		<div class="row">
			<form action="television.php" method="post">
				<div class="col-xs-4">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" size="2" maxlength="255" value="" /><p></p>
					<label for="year">Year</label>
					<input type="number" class="form-control" name="year" size="28" maxlength="4" value="" max="2050" /><p></p>
					<label for="age_rating">Age Rating</label>
					<input type="text" class="form-control" name="age_rating" size="28" maxlength="10" value=""/><p></p>
					<label for="director">Director</label>
					<input type="text" class="form-control" name="director" size="2" maxlength="255" value="" /><p></p>
					<label for="seasons">Seasons</label>
					<input type="number" class="form-control" name="seasons" size="28" maxlength="4" value=""/><p></p>
					<label for="episodes">Episodes (Total)</label>
					<input type="number" class="form-control" name="episodes" size="28" maxlength="10" value=""/><p></p>
					<label for="services">Services (Where the show is available)</label>
					<input type="text" class="form-control" name="services" size="28" maxlength="50" value=""/><p></p>
					<label for="description">Description</label>
					<textarea class="form-control" type="text" name="description" value="" rows="6" cols="40"></textarea>
					<p></p>
					<input type="submit" name="add-show" class="btn btn-primary" value="Add Show">
					<p></p>
				</div>
			</form>
		</div>
</div>