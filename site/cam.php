<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="© Powered by Overkill Security System">
    <meta name="author" content="OSS">
  	<link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
    <script src="../scripts/hls.js@latest"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Welcome to the Security Portal</title>
</head>
<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: ../index.php");
  exit;
}
$ipinfo = getHostByName(getHostName());

 ?>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <a onclick="topFunction()" class="navbar-brand">OSS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a>Cam</a></li>
      <li><a href="motion.php">Motion</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
    <li ><a id="demo"></a></li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>User</a>
        <ul class="dropdown-menu">
			<li><a href="./passwordreset.php">Change password</a></li>
          	<li><a href="register.php">Add user?</a></li>
          	<li><a href="logout.php">Logout</a></li>
        </ul>
    </ul>
  </div>
</nav>
  <?php printf("<img class='center' src='http://$ipinfo:8000/stream.mjpg' width='640' height='480' onContextMenu='return false' />") ?>
<footer class="fixedfooter">
    <p>© | Powered by Overkill Security Systems</p>
</footer>
</body>
</html>
