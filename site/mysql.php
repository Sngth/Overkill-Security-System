<?php
$host = "localhost";
$dbname = "oss";
$user = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    //$info = "Database $dbname created successfully<br>";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        // sql to create table
        $sql = "CREATE TABLE IF NOT EXISTS `accounts` (
            `user_id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `token` varchar(255) DEFAULT NULL,
            `2_fac_auth_code` varchar(16) DEFAULT NULL,
            PRIMARY KEY (user_id)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
      
        // use exec() because no results are returned
        $conn->exec($sql);
        //$info = "Table accounts created successfully";
      } catch(PDOException $e) {
        $info = $sql . "<br>" . $e->getMessage();
      }
  } catch(PDOException $e) {
    $info = $sql . "<br>" . $e->getMessage();
  }
  
$conn = null;

try{
    $mysql = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e){
    $info = "SQL Error: ".$e->getMessage();
}

# CREATE DATABASE oss;

#  CREATE TABLE `accounts` (
#    `user_id` int(11) NOT NULL AUTO_INCREMENT,
#    `username` varchar(255) NOT NULL,
#    `password` varchar(255) NOT NULL,
#    `email` varchar(255) NOT NULL,
#    `token` varchar(255) DEFAULT NULL,
#    `2_fac_auth_code` varchar(16) DEFAULT NULL,
#    PRIMARY KEY (user_id)
#  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
?>

