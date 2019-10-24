<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /dating_sign_in.html');
	exit();
} 

if(isset($_POST['update-info'])) {

$host = "mysql.inoticed.org";
$dbusername = "ndhall";
$dbpassword = "natabata14";
$dbname = "inoticed_cards_requests";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_error()){
		die($param='Connect Error ('. mysqli_connect_errno() .') '
		. mysqli_connect_error());
	}
		else{

		$id=$_SESSION['id']; 
		$email=$_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		if (!empty($email)){
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				die ($param ='Email is not valid. Please enter a valid email.');
			} else {
				$sql = "UPDATE accounts SET email='$email' WHERE id='$id'";
				$param = 'Email updated successfully';
				$param2 = '';
			} 
		} elseif (!empty($password)) {
				if (strlen($_POST['password']) > 25 || strlen($_POST['password']) < 5) {
					die ($param2 ='Password must be between 5 and 25 characters long. Please try again.');
				} else { 
					$sql = "UPDATE accounts SET password='$password' WHERE id='$id'";
					$param2 = 'Password updated successfully ';
				}
		} else {
		       $param = 'Data not updated, try again.';
		       $param2 = '';
		  }
		   mysqli_close($connect);
		}
}
?>






<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>iNoticed | Dating</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/css/styles.css"> 
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
	</head>
	<body class="loggedin">

		<div class="nav-light">
			<div class="nav-left">
				<div class="title"><a href="/">iNoticed</a></div>
			</div>
			<div class="nav-right">
				<a href="/php/dating_home.php"><i class="fas fa-envelope"></i>Home</a>
				<a href="/php/messages.php"><i class="fas fa-envelope"></i>Messages</a>
				<a href="/php/dating_profile.php"><i class="fas fa-address-card"></i>My Profile</a>
				<a href="/php/account_settings.php"><i class="fas fa-cog"></i>Account Settings</a>
				<a href="/php/dating_logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
			</div>
		</div>

		<div class="content">
			<h2>Update Results</h2>
			<p><?php echo $param; ?></p>
			<p><?php echo $param2; ?></p>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
		<script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/js/scripts.js"></script>
	</body>
</html>