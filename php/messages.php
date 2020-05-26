<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /sign_in.html');
	exit();
} 


$db = DB::getInstance();
$settingsQ = $db->query("SELECT * FROM accounts");
$settings = $settingsQ->first();


// $DATABASE_HOST = 'mysql.inoticed.org';
// $DATABASE_USER = 'ndhall';
// $DATABASE_PASS = 'natabata14';
// $DATABASE_NAME = 'inoticed_dating';
// // Try and connect using the info above.
// $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// if ( mysqli_connect_errno() ) {
// 	// If there is an error with the connection, stop the script and display the error.
// 	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
// }


$messagesQ = $db->query("SELECT * FROM messages WHERE msg_to = ? AND deleted != 1 ORDER BY sent_on DESC",array($user->data()->id));
$messages = messagesQ->results();




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>iNoticed | Dating</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
		<link rel="stylesheet" type="text/css" href="/css/styles.css" /> 
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" /> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" /> 
	</head>
	<body id="loggedin">

		<div class="nav-light dating-signed-in-nav">
		</div>

		<div class="content">
			<h2>Messages</h2>
			<div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>From</th>
							<th>Sent On</th>
							<th>Read Message</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php foreach($messages as $m) { ?>
								<a href="message.php?id=<?=$m->id?>"><td><?php echouser($m->msg_from);?></td></a>
								<td><?=$m->sent_on?></td>
								<td><?php myBin($m->msg_read);?></td>
						</tr>
						<?php	} //end foreach ?> 
					</tbody>
				</table>
			</div>
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
