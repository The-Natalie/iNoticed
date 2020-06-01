<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /sign_in.html');
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

$my_id = $_SESSION['id'];

//most recent message from thread, so that there is only 1 message displayed for each thread/person it's from
//their first name, fist 40 characters of message, time it was sent, their id (explained on next line)
//clicking on the message takes you to the create message page, so we need to grab the id of the person it's from and put it in the url
//message is bolded or something if it hasn't been read yet
//*********** on create message page, when page loads, any messages sent before current time mark as read.

$sql = "SELECT * FROM messages WHERE id IN ( SELECT MAX(id) FROM messages GROUP BY thread_id) ORDER BY sent_on DESC";
$result = mysqli_query($con, $sql);


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
							<th>Message</th>
							<th>Received</th>
						</tr>
					</thead>
					<tbody>
							<?php 
							if (mysqli_num_rows($result) > 0) {
  							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {  
  								if($row["msg_to"] == $my_id && $row["msg_read"] == '0') { ?>
  									<a href="/php/create_message.php?id=<?=$their_id?>" class="msg_not_read"><tr>
  								<?php 
  								} else {  ?>
	  								<a href="/php/create_message.php?id=<?=$their_id?>" class="msg_read"><tr>
	  							<?php }  ?>
		  								<td><?php $row["msg_from_name"]; ?></td>
		  								<td><?php substr($row["message"], 0, 50); ?></td>
		  								<td><?php $row["sent_on"]; ?></td>
									<?php 
								} 	
							} else {
							  echo "You don't have any messages, yet. Don't worry, it's not you, it's me. As the saying goes, right?";
							}   ?>
						</tr></a>
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
