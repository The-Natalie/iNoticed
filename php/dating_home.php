<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /dating_sign_in.html');
	exit();
} 

if ($account['activation_code'] !== 'activated') {
		echo 'Your account hasn\'t been activated. Please check your email to activate your account first.';
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" type="text/css" href="/css/styles.css"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="/php/dating_profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="/php/dating_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>