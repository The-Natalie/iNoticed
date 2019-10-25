<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /dating_sign_in.html');
	exit();
}

$DATABASE_HOST = 'mysql.inoticed.org';
$DATABASE_USER = 'ndhall';
$DATABASE_PASS = 'natabata14';
$DATABASE_NAME = 'inoticed_dating';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, email, id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($password, $email, $id);
$stmt->fetch();

//Email activation check
// if ($activation_code == '') {
// // user not activated, redirect or display msg
// 	header('Location: /please_activate.html');
// }

$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>iNoticed | Dating</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/css/styles.css"> 
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">  
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body id="loggedin">

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
			<h2>Account Settings</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
				<br />

				<button class="update-email-button" type="button">Update email  <i class="far fa-edit"></i></button>
				<div id="update-email-form">
					<form method="post" action="/php/update_email.php">
<!-- 						<p style="font-size: 0.8em;">Your current password is required to change information.</p  -->
 								<input type="email" name="email" placeholder="New Email"><br />
<!-- 						<input id="password" name="password" type="password" placeholder="Current Password" ><br /-->
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
 						<input style="margin-top: 10px;" type="submit" value="Submit">
					</form>	
				</div>
				<br />

				<button class="update-password-button" type="button">Update password  <i class="far fa-edit"></i></button>
				<div id="update-password-form">				
					<form method="post" action="/php/update_password.php">
<!-- 						<p style="font-size: 0.8em;">Your current password is required to change information.</p  -->
 								<input name="new-password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="New Password"><br />
						<input name="password_two" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Confirm New Password"><br />
<!-- 						<input id="password" name="password" type="password" placeholder="Current Password" ><br /-->
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
 						<input type="submit" value="Submit">
					</form>	
				</div>/php/delete.php">
				<br />
				<br />
				<a href="/php/delete.php"><button type="button">Delete account  <i class="far fa-edit"></i></button></a>
				<br />
				<br />
				<p style="font-size: 1em;">If  you'd like to receive a set of cards to pass on to others, fill out the form below, and we'll be in touch with you ASAP.<br>
				A  tiny fee will be required, which we will inform you of before your order is finalized. Of course, if you think the fee is too much, you may choose to opt out.</p>
			</div>
		</div>

		<div id="card-request-form">
			<h1>Dating Card Request</h1>
			<form id="dating-card-form" method="post"> 
				<p><input type="radio" name="cardsRequested" value="20cards" checked> 20 cards</p>
				<p><input type="radio" name="cardsRequested" value="50cards"> 50 cards</p>
				<p style="margin-bottom: 20px;"><input type="radio" name="cardsRequested" value="100cards"> 100 cards</p>
				<label for="name"><i class="fas fa-user"></i></label>
				<input id="form-name" type="text" name="name" placeholder="Name">
				<label for="email"><i class="fas fa-envelope"></i></label>
				<input id="form-email" type="email" name="email" placeholder="Email">	
				<p class="form-submitted"></p>
				<input class="button" type="submit" value="Submit">
			</form>
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