<?php
$name=$_POST['name']; 
$email=$_POST['email'];
$cardsRequested=$_POST['cardsRequested'];
if (!empty($name)){
if (!empty($email)){
if (!empty($cardsRequested)){
$host = "mysql.inoticed.org";
$dbusername = "ndhall";
$dbpassword = "natabata14";
$dbname = "inoticed_kindness_cards_requests";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO kindness_cards (name, email, cardsRequested)
values ('$name','$email', '$cardsRequested')";
if ($conn->query($sql)){
echo "New record is inserted sucessfully";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else{
echo "Name should not be empty";
die();
}
}
else{
echo "Email should not be empty";
die();
}
?>

