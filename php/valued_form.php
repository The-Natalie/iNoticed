php:

<?php
$name=$_POST['name']; 
$email=$_POST['email'];
$cardsRequested=$_POST['cardsRequested'];
if (!empty($name)){
if (!empty($email)){
if (!empty($cardsRequested)){
  $config = parse_ini_file('../../private/config.ini');
  $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbcards']);

if (mysqli_connect_error()){
	die('Let dating@inoticed.org know the details of this error: Connect Error ('. mysqli_connect_errno() .') '
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
			echo "Let dating@inoticed.org know the details of this error: Error: ". $sql ."
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

