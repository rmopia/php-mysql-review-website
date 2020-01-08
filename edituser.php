<!DOCTYPE html>
<html lang="en">
<head>
  <title>Review It - Account</title>
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
          <a class="dropdown-item" href="edituser.php?username=rmoo">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
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
	
	if(isset($_GET['username'])){
		$username = $_GET['username'];
		
		$info_query = 'SELECT * FROM reviewers WHERE username="'.$username.'"';
		$info_response = mysqli_query($conn, $info_query);
		if($info_response){
			while($row = mysqli_fetch_array($info_response)){
				$fname = $row['fname'];
				$lname = $row['lname'];
				$email = $row['email'];
				$portrait = $row['portrait'];
				$password = $row['password']; //encrypt this at some point // separate page for password changing
			}
		}
		
	}
	if(isset($_POST['change-user-pw'])){
		$username = $_POST['username'];
		$oldpw1 = $_POST['oldpw1'];
		$oldpw2 = $_POST['oldpw2'];
		$newpw = $_POST['newpw'];
		
		if(!empty($oldpw1) && !empty($oldpw2) && !empty($newpw)){
			$pw_query = "SELECT password FROM reviewers WHERE username = '".$username."'";
			$pw_response = mysqli_query($conn, $pw_query);
			if($pw_response){
				while($row = mysqli_fetch_array($pw_response)){
					$sqlpw = $row['password'];
				}
			}
			if(($oldpw1 == $oldpw2) && ($oldpw1 == $sqlpw) && ($oldpw1 == $sqlpw)){
				echo "<div class='container'><p class='text-success'>Changes successful.</p></div>";
				$edit_pw_query = "UPDATE reviewers SET password=? WHERE username='".$username."'";
			
				$update_pw = mysqli_prepare($conn, $edit_pw_query);
				mysqli_stmt_bind_param($update_pw, "s", $newpw);
				mysqli_stmt_execute($update_pw);
				$password = $newpw;
			}
			else{
				echo "<div class='container'><p class='text-danger'>Error has occurred. Please try again.</p></div>";
			}
		}
		else{
			echo "<div class='container'><p class='text-danger'>Required fields not filled in. Please try again.</p></div>";
		}
		
	}
	
?>

<div class="container">
	<h1>Edit Account</h1>
	<form action="changepw.php" method="post">
		<input type="hidden" name="username" value="<?php echo $username ?>" />
		<input type="submit" name="change-pw" class="btn btn-link" value="Change Password"><p></p>
	</form>
	<form action="home.php" method="post">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<input type="hidden" name="username" value="<?php echo $username ?>" />
				<label for="fname">First Name</label>
				<input type="text" class="form-control" name="fname" size="2" maxlength="255" value="<?php echo $fname ?>" /><p></p>
				<label for="lname">Last Name</label>
				<input type="text" class="form-control" name="lname" size="2" maxlength="255" value="<?php echo $lname ?>" /><p></p>
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" size="2" maxlength="255" value="<?php echo $email ?>" /><p></p>
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" size="2" maxlength="255" value="<?php echo $password ?>" /><p></p>
				<input type="submit" name="edit-user" class="btn btn-primary" value="Save"><p></p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<label>Profile Picture</label>
				<?php echo '<img src="data:portrait/jpeg;base64,'.base64_encode( $portrait ).'"/>'; ?>
				<div class="input-group mb-3">
				  <div class="custom-file">
					<input type="file" class="custom-file-input" name="profile_pic">
					<label class="custom-file-label" for="profile_pic">Choose file</label>
				  </div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php 
	mysqli_close($conn);
?>