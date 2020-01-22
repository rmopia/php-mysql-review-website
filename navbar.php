<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-expand"></span> Review It</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="television.php">TV</a></li>
      <li><a href="movies.php">Movies</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
    <form class="navbar-form navbar-right" action="search.php" method="GET">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="..." name="t">
      </div>
      <button type="search" class="btn btn-default">Search</button>
    </form>
	<ul class="nav navbar-nav navbar-right">
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="glyphicon glyphicon-user"></span> Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item" href="profile.php">My Profile</a>
		  <br/>
          <a class="dropdown-item" href="edituser.php">Edit Account</a>
          <br/>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>