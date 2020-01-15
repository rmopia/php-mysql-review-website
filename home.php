<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php
		session_start();
		if($_SESSION['loggedin'] == 1){
			$message = "<div class='container'>Logged in as ".$_SESSION['username']."</div>";
		}

		$servername = "localhost";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, "root", $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
		
		if(isset($_POST['edit-user'])){
			$profile_pic = $_POST['profile_pic'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
		
			if(empty($password)){ //add validator to compare password input and mysql stored password 
				$message = "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				header('Location: login.php?message='.$message);
				die;
			}
			else{
				$edit_user_query = "UPDATE reviewers SET fname=?, lname=?, email=?, portrait=? WHERE username='".$_POST['username']."'";
			
				$update_user = mysqli_prepare($conn, $edit_user_query);
				mysqli_stmt_bind_param($update_user, "sssb", $fname, $lname, $email, $profile_pic);
				mysqli_stmt_execute($update_user);
			}
		}
		
		if(isset($_POST['delete-user-confirm'])){
			$user = $_POST['username'];
			$pw1 = $_POST['pw1'];
			$pw2 = $_POST['pw2'];
			
			$user = stripcslashes($user);
			$pw1 = stripcslashes($pw1);
			$pw2 = stripcslashes($pw2);
			
			if(empty($pw1) || empty($pw2) || empty($user)){ //add validator to compare password input and mysql stored password 
				$message = "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				header('Location: login.php?message='.$message);
				die;
			}
			else if($pw1 == $pw2){
				$password = $pw1;
				$del_user_query = "DELETE FROM reviewers WHERE password='".$password."' AND username='".$user."'";
				$del_user_response = mysqli_query($conn, $del_user_query);
				
				if($del_user_response){
					echo "<div class='container'><p class='text-success'>User deleted. Farewell.</p></div>";
				}
				else if(!$del_user_response){
					$message = "<div class='container'><p class='text-danger'>An error has occurred.</p></div>";
					header('Location: login.php?message='.$message);
					die;
				}
			}
			else{
				$message = "<div class='container'><p class='text-danger'>Something went wrong.</p></div>";
				header('Location: login.php?message='.$message);
				die;
			}
		}
		
		if(isset($_POST['login-user'])){
			$user = $_POST['username'];
			$pw = $_POST['password'];
			
			$user = stripcslashes($user);
			$pw = stripcslashes($pw);
			
			if(empty($pw) || empty($user)){ //add validator to compare password input and mysql stored password 
				$message = "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
				header('Location: login.php?message='.$message);
				die;
			}
			else{
				$login_query = "SELECT * FROM reviewers WHERE username='".$user."' and password='".$pw."'";
				$login_response = mysqli_query($conn, $login_query);
				if($login_response){
					$row = mysqli_fetch_array($login_response);
					$username = $row['username'];
					$password = $row['password'];
					if(empty($username) || empty($password)){ //validates whether these are in the mysql database to begin with
						$message = "<div class='container'><p class='text-danger'>Invalid login. Please try again.</p></div>";
						header('Location: login.php?message='.$message);
						die;
					}
					else{
						$_SESSION['loggedin'] = true;
						$_SESSION['username'] = $username;
						$message = "<div class='container'><p class='text-success'>Successful login. Welcome ".$username.".</p></div>";
					}
				}
			}
		}

	include_once("navbar.php");

		if(isset($_GET['message'])){
			echo $_GET['message'];
		}
		else if(!empty($message)){
			echo $message;
		} 
?>
<div class="container">
	<h1>Home</h1>
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/3iXeAwsGhV0" allowfullscreen></iframe>
	</div>
</div>
<p></p>
<?php
		mysqli_close($conn);
?>