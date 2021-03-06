<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /sign_in.html');
	exit();
}
$config = parse_ini_file('../../private/config.ini');
$con = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbdating']);

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, email, id, username FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($password, $email, $id, $username);
$stmt->fetch();
$stmt->close();

$my_id = $_SESSION['id'];

//sees how many messages are unread
$unread_count = "";
if ($unread_result = $con->query("SELECT id FROM messages WHERE msg_to = '$my_id' AND msg_read = 0")) {
    $unread_count = $unread_result->num_rows;
    $unread_result->close();
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body id="loggedin">

		<div class="nav-light dating-signed-in-nav">
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
				<form>
					<input id="get-username" type="hidden" name="id" value="<?php echo $username; ?>"/>
					<button class="generate-url-button" type="button">Generate profile url  <i class="fas fa-sync-alt"></i></button>
				</form>
				<div id="generate-url">
					<p>Your url is:</p>
					<p id="unique-url"></p>
					<p>This url is used on the card you pass out to others, so that they can view your profile.</p>
				</div>
				<br />

				<button class="update-email-button" type="button">Update email  <i class="far fa-edit"></i></button>
				<div id="update-email-form">
					<form method="post" action="/php/update_email.php">
 								<input type="email" name="email" placeholder="New Email" required><br />
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
 						<input class="submit-button" type="submit" value="Submit">
					</form>	
				</div>
				<br />
				<br />

				<button class="update-password-button" type="button">Update password  <i class="far fa-edit"></i></button>
				<div id="update-password-form">				
					<form method="post" action="/php/update_password.php">
 						<input name="new-password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="New Password" required><br />
						<input style="margin-top:10px;" name="password_two" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Confirm New Password" required><br />
						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
 						<input class="submit-button" type="submit" value="Submit">
					</form>	
				</div>
				<br />
				<br />

				<button class="delete-account-button" type="button">Delete account  <i class="fas fa-exclamation-triangle"></i></button>
				<div id="delete-account-form">            
					<form action="/php/delete.php" method="post">
              <p>Are you sure you want to delete your account and profile? Once you click the 'Yes' button below, everything will be erased, and it can't be undone.</p>
            <p>
            	<input type="hidden" name="id" value="<?php echo trim($_POST["id"]); ?>"/>
              <input class="submit-button" type="submit" value="Yes" class="btn btn-danger">
            </p>
           </form>  
         </div>      
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
		<script type="text/javascript">
    	$(document).ready(function(){
        //message notification
				let unread_count = '<?=$unread_count?>';
				if ('<?= isset($_SESSION['loggedin']) ?>' == '1') {
					if (unread_count == '1') {
						$('span.grammar').text(''); 
					}
					if (unread_count > '0') {
						$('sup.msg-notification').text(unread_count);
					}
				}
    	});
  	</script>
	</body>
</html>