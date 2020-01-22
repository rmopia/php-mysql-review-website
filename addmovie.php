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
<?php
	session_start();
	include_once("navbar.php");
?>
<div class="container">
	<h1>Add a Movie</h1>
		<div class="row">
			<form action="movies.php" method="post">
				<div class="col-xs-4">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" size="2" maxlength="255" value="" /><p></p>
					<label for="year">Year</label>
					<input type="number" class="form-control" name="year" size="28" maxlength="4" value="" max="2050" /><p></p>
					<label for="age_rating">Age Rating</label>
					<input type="text" class="form-control" name="age_rating" size="28" maxlength="10" value=""/><p></p>
					<label for="director">Director</label>
					<input type="text" class="form-control" name="director" size="2" maxlength="255" value="" /><p></p>
					<label for="seasons">Runtime (minutes)</label>
					<input type="number" class="form-control" name="runtime" size="28" maxlength="4" value=""/><p></p>
					<label for="services">Services (Where the movie is available)</label>
					<select class="form-control" multiple name="services[]">
					  <option value="None" selected></option>
					  <option value="Netflix">Netflix</option>
					  <option value="Disney+">Disney+</option>
					  <option value="Hulu">Hulu</option>
					  <option value="Amazon Prime Video">Amazon Prime Video</option>
					  <option value="HBO">HBO</option>
					  <option value="Crackle">Crackle</option>
					  <option value="Sling TV">Sling TV</option>
					  <option value="In Theatres">In Theatres</option>
					  <option value="Crunchyroll">Crunchyroll</option>
					  <option value="Funimation now">Funimation now</option>
					  <option value="VRV">VRV</option>
					  <option value="Youtube">Youtube</option>
					</select>
					<p></p>
					<label for="description">Description</label>
					<textarea class="form-control" type="text" name="description" value="" rows="6" cols="40"></textarea>
					<p></p>
					<p></p>
				</div>
				<div class="col-xs-3">
					<label for="genres">Genre(s)</label>
					<select class="form-control" multiple name="genres[]">
					  <option value="" disabled selected></option>
					  <option value="1">Western</option>
					  <option value="2">Science Fiction</option>
					  <option value="3">Action</option>
					  <option value="4">Animation</option>
					  <option value="5">Comedy</option>
					  <option value="6">Adventure</option>
					  <option value="7">Fantasy</option>
					  <option value="8">Anime</option>
					  <option value="9">Drama</option>
					</select>
					<p></p>
				</div>
				<div class="col-xs-4">
					<label for="actors">Actors/Actresses</label>
					<p>Please separate each actor/actress with a comma:</p>
					<textarea class="form-control" type="text" name="actors" value="" rows="4" cols="40"></textarea>
					<p></p>
					<input type="submit" name="add-movie" class="btn btn-primary" value="Add Movie">
				</div>
			</form>
		</div>
</div>
