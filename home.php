<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php
		$servername = "localhost";
		$password = "pwdpwd";
		$dbname = "review_site";
		
		$conn = new mysqli($servername, "root", $password, $dbname);
		$conn->select_db($dbname) or die("Unable to connect to database."); 
		
		if(isset($_POST['login-user'])){
			$user = $_POST['username'];
			$pw = $_POST['password'];
			
			$user = stripcslashes($user);
			$pw = stripcslashes($pw);
			
			if(empty($pw) || empty($user)){ //add validator to compare password input and mysql stored password 
				echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
			}
			else{
				$login_query = "SELECT * FROM reviewers WHERE username='".$user."' and password='".$pw."'";
				$login_response = mysqli_query($conn, $login_query);
				if($login_response){
					$row = mysqli_fetch_array($login_response);
					$username = $row['username'];
					$password = $row['password'];
					if(empty($username) || empty($password)){ //validates whether these are in the mysql database to begin with
						echo "<div class='container'><p class='text-danger'>Invalid login. Please try again.</p></div>";
					}
					else{
						echo "<div class='container'><p class='text-success'>Successful login. Welcome ".$username.".</p></div>";
					}
				}
			}
		}
		
		if(isset($_POST['edit-user'])){
			$profile_pic = $_POST['profile_pic'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
		
			if(empty($password)){ //add validator to compare password input and mysql stored password 
				echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
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
				echo "<div class='container'><p class='text-danger'>Error: Required fields not filled out. Please try again.</p></div>";
			}
			else if($pw1 == $pw2){
				$password = $pw1;
				$del_user_query = "DELETE FROM reviewers WHERE password='".$password."' AND username='".$user."'";
				$del_user_response = mysqli_query($conn, $del_user_query);
				
				if($del_user_response){
					echo "<div class='container'><p class='text-success'>User deleted. Farewell.</p></div>";
				}
				else if(!$del_user_response){
					echo "<div class='container'><p class='text-danger'>An error has occurred.</p></div>";
				}
			}
			else{
				echo "<div class='container'><p class='text-danger'>Something went wrong.</p></div>";
			}
		}
?>
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
		  <a class="dropdown-item" href="profile.php?username=<?php echo $username ?>">Profile</a>
          <a class="dropdown-item" href="edituser.php?username=<?php echo $username ?>">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
		<li><form action="search.php" class="form-inline my-2 my-lg-0" method="GET">
			<input class="form-control mr-sm-2" name="t" type="search" placeholder="..." aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form></li>
    </ul>
  </div>
</nav>

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