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
    if(isset($_GET["token"])){
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE TOKEN = :token"); //Username überprüfen
        $stmt->bindParam(":token", $_GET["token"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            if(isset($_POST["submit"])){
                if($_POST["pw1"] == $_POST["pw2"]){
                    $hash = password_hash($_POST["pw1"], PASSWORD_BCRYPT);
                    $stmt = $mysql->prepare("UPDATE accounts SET PASSWORD = :pw, TOKEN = null WHERE TOKEN = :token");
                    $stmt->bindParam(":pw", $hash);
                    $stmt->bindParam(":token", $_GET["token"]);
                    $stmt->execute();
                    $info = "The password has been changed";
                    header("Location: ../index.php");

                } else {
                    $info = "The passwords do not match";
                }
            }
            ?>
            <form class="login-box" action="setpassword.php?token=<?php echo $_GET["token"] ?>" method="POST">
            <h1>Change Password</h1>
            <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" name="pw1" placeholder="Password" required>
            </div>
            <div class="textbox">
            <i class="fas fa-lock"></i>
            <input type="password" name="pw2" placeholder="Confirm password" required>
            </div>
            <?php printf("<p>$info</p>") ?>
            <button type="submit" name="submit" class="btn">Set Password</button>
            </form>
            <?php
        } else {
            printf("<form class='login-box'>
            <h1>The token is invalid</h1>
            </form>
            ");
        }
    } else {
        printf("<form class='login-box'>
            <h1>No valid token sent</h1>
            </form>
            ");
    }
    ?>
<footer class="fixedfooter">
  <p>© | Powered by Overkill Security Systems</p>
</footer>
</body>
</html>