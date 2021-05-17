<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="© Powered by Overkill Security System">
    <meta name="author" content="OSS">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
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
 ?>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a onclick="topFunction()" class="navbar-brand">OSS</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="cam.php">Cam</a></li>
      <li class="active"><a >Motion</a></li>
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
    <!-- (B) LIGHTBOX -->
    <div id="lback" onclick="gallery.hide()">
      <div id="lfront"></div>
    </div>
    <!-- (C) THE GALLERY -->
    <div class="gallery"><?php
    // (C1) READ FILES FROM GALLERY FOLDER
    $dir = __DIR__ . DIRECTORY_SEPARATOR . "../gallery" . DIRECTORY_SEPARATOR;
    $images = glob($dir . "*.{jpg}", GLOB_BRACE);
    usort(
      $images,
      function($file1, $file2) {
        return filemtime($file2) <=> filemtime($file1);
      }
    );
    // (C2) OUTPUT IMAGES  
    foreach ($images as $i) {
      filemtime("$i");
      $filetime = date("d F Y H:i:s.", filemtime("$i"));
      printf("<div class=container><img src='../gallery/%s' onclick='gallery.show(this)' onContextMenu='return false';/><div class=overlay>$filetime</div></div>", basename($i));
    }
    ?></div>
<footer class="normalfooter">
    <p>© | Powered by Overkill Security Systems</p>
</footer> 
</body>
</html>
