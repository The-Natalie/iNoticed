<?php
$host = "mysql.inoticed.org";
$username = "ndhall";
$password = "natabata14";
$dbname = "inoticed_kindness_cards_requests";
$conn = new mysqli($host, $username, $password, $dbname);

$name=$_POST['name']; 
$email=$_POST['email'];
$cardsRequested=$_POST['cardsRequested'];

$sql = "INSERT INTO kindness_cards (name, email, cardsRequested) values ('$name','$email', '$cardsRequested')";
$stmt   = $conn->prepare($sql);

$stmt->bind_param($name, $email, $cardsRequested);

  if($stmt->execute()){

     $result = 1;

  }

echo $result;

$conn->close();
?>


