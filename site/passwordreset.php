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
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if (isset($_POST["submit"])) {
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count != 0){
            $token = generateRandomString(25);
            $ipinfo = getHostByName(getHostName());
            $stmt = $mysql->prepare("UPDATE accounts SET TOKEN = :token WHERE EMAIL = :email");
            $stmt->bindParam(":token", $token);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "mail.gmx.net";
            $mail->SMTPAuth = false;
            #$mail->SMTPSecure = "ssl";
            $mail->SMTPAutoTLS = false; 
            $mail->port = 530;
            $mail->Username = "oss11@gmx.ch";
            $mail->Password = "OJG7UWG6BYJT7CA6EEIB";
            $mail->setFrom("oss11@gmx.ch", "Noreply Overkill Security Systems");
            $mail->addAddress($_POST["email"], $_POST["email"]);
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->Subject = "Request received for password reset";
            $mail->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <meta name='description' content='© Powered by Overkill Security System'>
                <meta name='author' content='OSS'>
                <title>Welcome to the Security Portal</title>
            </head>
              <style type='text/css'>
            
              @media screen {
                @font-face {
                  font-family: Source Sans Pro;
                  font-style: normal;
                  font-weight: 400;
                  src: local(Source Sans Pro Regular), local(SourceSansPro-Regular), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(woff);
                }
            
                @font-face {
                  font-family: Source Sans Pro;
                  font-style: normal;
                  font-weight: 700;
                  src: local(Source Sans Pro Bold), local(SourceSansPro-Bold), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(woff);
                }
              }
            
              body,
              table,
              td,
              a {
                -ms-text-size-adjust: 100%; /* 1 */
                -webkit-text-size-adjust: 100%; /* 2 */
              }
            
              table,
              td {
                mso-table-rspace: 0pt;
                mso-table-lspace: 0pt;
              }
            
              img {
                -ms-interpolation-mode: bicubic;
              }
            
              a[x-apple-data-detectors] {
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                color: inherit !important;
                text-decoration: none !important;
              }
            
              div[style*='margin: 16px 0;'] {
                margin: 0 !important;
              }
            
              body {
                width: 100% !important;
                height: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                font-family: Source Sans Pro, Helvetica, Arial, sans-serif;
              }
            
              table {
                border-collapse: collapse !important;
              }
            
              a {
                color: #1a82e2;
              }
            
              img {
                height: auto;
                line-height: 100%;
                text-decoration: none;
                border: 0;
                outline: none;
              }
              </style>
            </head>
            <body style='background-color: #e9ecef;'>
            
              <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
                Password Reset Request from your Camera Security System
              </div>
            
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                  <td align='center' bgcolor='#e9ecef'>
            
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                      <tr>
                        <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0;  border-top: 3px solid #d4dadf;'>
                          <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Reset Your Password</h1>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align='center' bgcolor='#e9ecef'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
            
                      <tr>
                        <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px;'>
                          <p style='margin: 0;'>If you click this button, it will be redirected to reset the password portal for your camera security system. Make sure that your device is on the same network as your security system!</p>
                        </td>
                      </tr>
            
                      <tr>
                        <td align='left' bgcolor='#ffffff'>
                          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                              <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                                <table border='0' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td align='center' bgcolor='#1a82e2' style='border-radius: 6px;'>
                                      <a href='http://$ipinfo/secure/site/setpassword.php?token=$token' style='display: inline-block; padding: 16px 36px;  font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;'>Click to Reset this Password!</a>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
            
                      <tr>
                        <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px;'>
                          <p style='margin: 0;'></p>
                        </td>
                      </tr>
            
                      <tr>
                        <td align='left' bgcolor='#ffffff' style='padding: 24px;  font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
                          <p style='margin: 0;'>Cheers,<br> Overkill Security Systems</p>
                        </td>
                      </tr>
            
                    </table>
            
                  </td>
                </tr>
            
                <tr>
                  <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
            
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
            
                      <tr>
                        <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px;  font-size: 14px; line-height: 20px; color: #666;'>
                          <p style='margin: 0;'>You received this email because we received a request for your account. If you didn't request you can safely delete this email.</p>
                        </td>
                      </tr>
            
                      <tr>
                        <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px;  font-size: 14px; line-height: 20px; color: #666;'>
                          <p style='margin: 0;'> © | Overkill Security Systems | Ausstellungsstrasse 70, 8005 Zürich</p>
                        </td>
                      </tr>
            
                    </table>
            
                  </td>
                </tr>
            
              </table>
            
            </body>
            </html>
            ";
            if($mail->send()){
                $info = "Your email was successfully sent.";
                $spam = "If your mail is not in your inbox, check your spam folder!";
            } else {
                $info = "There was an error ".$mail->ErrorInfo;
            }
        } else {
            $info = "This email is not registered";
        }
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>
<form action="passwordreset.php" method="post" class="login-box">
  <h1>Forgot Password?</h1>
    <div class="textbox">
    <i class="fas fa-envelope"></i>
    <input type="email" name="email" placeholder="Email" required>
    </div>
    <?php printf("<p>$info</p>")?>
  <button type="submit" name="submit" class="btn">Reset</button>
</form>
<footer class="fixedfooter">
    <p>© | Powered by Overkill Security Systems</p>
</footer> 
</body>

</html>