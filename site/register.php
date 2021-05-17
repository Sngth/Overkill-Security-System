<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="© Powered by Overkill Security System">
    <meta name="author" content="OSS">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
    <title>Welcome to the Security Portal</title>
  </head>
  <body>
    <?php
    $info ="";
    require("mysql.php");
    $rowCount = $mysql->prepare("SELECT * From accounts");
    $rowCount->execute();
    $infoCount = $rowCount->rowCount();

    if($infoCount >= 1){

        session_start();
        if(!isset($_SESSION["username"])){
            header("Location: ../index.php");
            exit;
        }

    }else{

    }
    if(isset($_POST["submit"])){
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE username = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0){
        //Username ist frei
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE email = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
          if($_POST["pw"] == $_POST["pw2"]){
            //User anlegen
            $stmt = $mysql->prepare("INSERT INTO accounts (username, password, email, token) VALUES (:user, :pw, :email, null)");
            $stmt->bindParam(":user", $_POST["username"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $info = "Your account has been created";
            $info2 = "We have send to your mail";
            header("Location: ../index.php");
          } else {
            $info = "The passwords do not match";
          }
        } else {
          $info = "E-mail have already been used";
        }
      } else {
        $info = "The username is already taken";
      }
    }
     ?>

    <form action="register.php" method="post" class="login-box">
      <h1>Register</h1>
      <div class="textbox">
      <i class="fas fa-user"></i>
      <input type="text" name="username" placeholder="Username" required>
      </div>
      <div class="textbox">
      <i class="fas fa-envelope"></i>
      <input type="text" name="email" placeholder="Email" required><br>
      </div>
      <div class="textbox">
      <i class="fas fa-lock"></i>
      <input type="password" name="pw" placeholder="Password" required>
      </div>
      <div class="textbox">
      <i class="fas fa-lock"></i>
      <input type="password" name="pw2" placeholder="Confirm password" required>
      </div>
      <?php printf("<p>$info</p><p>$info</p>") ?>
      <button type="submit" name="submit" class="btn">Create User</button>
    </form>
    <br>
<footer class="fixedfooter">
  <p>© | Powered by Overkill Security Systems</p>
</footer>
  </body>
</html>
