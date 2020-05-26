<?php
// require_once '/php/DB.php';
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
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT id, username, first_name, image_main FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($my_id, $my_username, $my_first_name, $my_image_main);
$stmt->fetch();

if (isset($_GET['id'])) {
$their_id = $_GET['id'];
}

$stmt2 = $con->prepare('SELECT username, first_name, image_main FROM accounts WHERE id = $their_id');
$stmt->execute();
$stmt2->bind_result($their_username, $their_first_name, $their_image_main);
$stmt2->fetch();

$our_names = [strtolower($my_username), strtolower($their_username)];  //strtolower is for lowercase
sort($our_names);
$thread_id = $our_names[0] . "_" . $our_names[1];

//gets the thread of past messages and puts them in order
$stmt3 = "SELECT * FROM messages WHERE thread_id = $thread_id ORDER BY sent_on DESC";
$thread_result = mysqli_query($con, $stmt3);		


if(!empty($_POST)) {
	$token = $_POST['csrf'];
	if(!Token::check($token)) {
		die("Token doesn't match!");
	}
	$date = date("M-d-y H:i:s")  //he did Y-m-d
	$fields = array(
		'thread_id' => $thread_id,
		'msg_from'  => $my_id,
		'msg_to'    => $their_id,
		'msg_body'  => Input::get('message'),
		'sent_on'   => $date,
	);
	$db->insert('messages',$fields);
	Redirect::to('create_message.php?msg=Message+sent!');
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
			<h2>Messages</h2>
			<div>
				<div class="msg_wrapper">
					<div id="prev-msgs">
						<? php	if (mysqli_num_rows($thread_result) > 0) {
					    while($row = mysqli_fetch_assoc($thread_result)) {
					    	if($row["msg_to"] == $my_id) { ?>
					    							    						
									<div class="left-msg">
										<p class="msg-name"><?=$my_first_name?></p>
										<div class="img-sent-div-left">
											<img src="/php/<?php echo $my_image_main; ?>" />
											<p class="sent-text"><?=$thread_result["sent_on"]?></p>
										</div>
										<div class="talk-bubble-left tri-right round left-in">
										  <div class="talktext">
										    <p><?=$thread_result[message]?></p>
										  </div>
										</div>
									</div>

								<? php  } else {  ?>
					    	

									<div class="right-msg">
										<p class="msg-name"><?=$their_name?></p>
										<div class="img-sent-div-right">
											<img src="/php/<?php echo $their_image_main; ?>" />
											<p class="sent-text"><?=$thread_result["sent_on"]?></p>
										</div>
										<div class="talk-bubble-right tri-right round right-in">
										  <div class="talktext">
										    <p><?=$thread_result[message]?></p>
										  </div>
										</div>
									</div>

								<? php  }
							  	}
								} else {
									echo "There are no previous messages";
								}  ?>	
					</div>
					<div class="compose-msg">
						<form name="create-msg" action="create_message.php?id=<?=$id?>" method="post">
							<textarea class="textarea" rows="5" cols="50" name="message" placeholder="Please type a message to send"></textarea>
							<input type="hidden" name="csrf" value="<?=Token::generate();?>" /><br />
							<button class="submit-button" type="submit" name="send_message">Send Messsage</button>
						</form>
					</div>	
				</div>
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