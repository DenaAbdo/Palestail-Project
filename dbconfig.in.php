<?php 
$host = 'localhost';
$user = 'your_username';
$password = 'your_password';
$db= 'webfinalproject';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    echo"connection failed";
  }
?>
