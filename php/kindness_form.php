<?php
// Establishing connection with server by passing "server_name", "user_id", "password".
$connection = mysql_connect("mysql.inoticed.org", "ndhall", "natabata14");
// Selecting Database by passing "database_name" and above connection variable.
$db = mysql_select_db("inoticed_kindness_cards_requests", $connection);
$name2=$_POST['name1']; 
$email2=$_POST['email1'];
$cards2=$_POST['cards1'];
$query = mysql_query("INSERT INTO 'kindness_cards' ('name', 'email', 'cardsRequested') VALUES ('$name2','$email2','$cards2')"); //Insert query
if($query){
echo "Data Submitted succesfully";
}
mysql_close($connection); // Connection Closed.
?>
