<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="© Powered by Overkill Security System">
    <meta name="author" content="OSS">
    <link rel="stylesheet" href="css/style.css">
    <script src="../js/script.js"></script>
    <title>Welcome to the Security Portal</title>
</head>
<body>
<?php
    $info ="";
    require("./site/mysql.php");
    $rowCount = $mysql->prepare("SELECT * From accounts");
    $rowCount->execute();
    $infoCount = $rowCount->rowCount();

    if($infoCount >= 1){

    }else{
        header("Location: ./site/register.php");
    }
    if(isset($_POST["submit"])){
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 1){
        //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["password"])){
          session_start();
          $_SESSION["username"] = $row["username"];
          header("Location: ./site/cam.php");
        } else {
          $info = "The login has failed";
        }
      } else {
        $info = "The login has failed";
      }
    }
    
?>
<video playsinline autoplay muted loop poster="background.jpg" id="myVideo" onContextMenu="return false";>
  <source src="./img/background.mp4" type="video/mp4">
</video>
<form action="index.php" method="post" class="login-box">
  <h1>Login</h1>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" name="username" placeholder="Username" required>
  </div>
  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" name="pw" placeholder="Password" required>
  </div>
  <?php printf("<p>$info</p>") ?>
  <button type="submit" name="submit" class="btn">Sign in</button>
  <input type="button" onclick="window.location.href='./site/passwordreset.php';" name="pwreset" class="btn" value="Forgot password?">
</form>
<footer class="fixedfooter">
    <p>© | Powered by Overkill Security Systems | Ver. 1.1</p>
</footer>    
</body>
</html>