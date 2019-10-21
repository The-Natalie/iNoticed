php:

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
$dbname = "inoticed_cards_requests";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno() .') '
	. mysqli_connect_error());
}
	else{
		$sql = "INSERT INTO valued_cards (name, email, cardsRequested)
		values ('$name','$email', '$cardsRequested')";
		if ($conn->query($sql)){
			echo "New record is inserted sucessfully";
			$to_email = 'valued@inoticed.org';
			$subject = 'New Valued Card Request';
			$message = "$name would like $cardsRequested. Please contact $name at $email.";
			$headers = 'From: valued@inoticed.org';
			mail($to_email,$subject,$message,$headers);
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
}

?>

