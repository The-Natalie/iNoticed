<?php
// Establishing connection with server by passing "server_name", "user_id", "password".
$connection = mysql_connect("mysql.inoticed.org", "ndhall", "natabata14");
// Selecting Database by passing "database_name" and above connection variable.
mysql_select_db("inoticed_kindness_cards_requests", $connection);
$name2=$_POST['name1']; 
$email2=$_POST['email1'];
$cardsRequested2=$_POST['cardsRequested1'];
$query = mysql_query("INSERT INTO kindness_cards VALUES ($name2, $email2, $cardsRequested2)"); //Insert query
if($query){
echo "Data Submitted succesfully";
}
mysql_close($connection); // Connection Closed.
?>

