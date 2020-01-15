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
		  <a class="dropdown-item" href="profile.php?username=<?php echo $_SESSION['username'] ?>">Profile</a>
          <a class="dropdown-item" href="edituser.php?username=<?php echo $_SESSION['username'] ?>">Edit Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
	  <li><form action="search.php" class="form-inline my-2 my-lg-0" method="GET">
			<input class="form-control mr-sm-2" name="t" type="search" placeholder="..." aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form></li>
    </ul>
  </div>
</nav>