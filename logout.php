<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Logout</title>
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
<h1>Logout</h1>
</div>
<?php
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != '')) {
		$message = "<div class='container'><p class='text-danger'>Please log in.</p></div>";
		header ("Location: login.php?message=".$message);
		die;
	}
	else{
		$username = $_SESSION['username'];
		session_destroy();
		$message = "<div class='container'><p class='text-success'>Successfully logged out. See you later, ".$username.".</p></div>";
		header ("Location: home.php?message=".$message);
		die;
	}
?>