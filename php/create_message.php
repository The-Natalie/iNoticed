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

$my_id = $_SESSION['id'];
$their_first_name = "";
if (isset($_GET['id'])) {
$their_id = $_GET['id'];
}

$stmt = $con->prepare("SELECT username, first_name, image_main FROM accounts WHERE id = ?");
$stmt->bind_param("i", $my_id);
$stmt->execute();
$stmt->bind_result($my_username, $my_first_name, $my_image_main);
$stmt->fetch();
$stmt->bind_param("i", $their_id);
$stmt->execute();
$stmt->bind_result($their_username, $their_first_name, $their_image_main);
$stmt->fetch();
$stmt->close();

if ($my_image_main == '') {
	$my_image_main = "../images/no_image.png";
}

if ($their_image_main == '') {
	$their_image_main = "../images/no_image.png";
}



$our_names = [strtolower($my_username), strtolower($their_username)];  //strtolower is for lowercase
sort($our_names);
$thread_id = $our_names[0] . "_" . $our_names[1];
$msg_read = 1;

$stmt2 = $con->prepare("UPDATE messages SET msg_read = ? WHERE thread_id = ? AND msg_to = ?");
$stmt2->bind_param("isi", $msg_read, $thread_id, $my_id);
$stmt2->execute();
$stmt2->close();

//sees how many messages are unread
$unread_count = "";
if ($unread_result = $con->query("SELECT id FROM messages WHERE msg_to = '$my_id' AND msg_read = 0")) {
    $unread_count = $unread_result->num_rows;
    $unread_result->close();
}

//gets the thread of past messages and puts them in order	
if ($their_first_name !== "") {
  $sql = "SELECT * FROM messages WHERE thread_id = '$thread_id' ORDER BY sent_on DESC";
  $result = mysqli_query($con, $sql);
}

//takes message from form and posts it to database
if (!empty($_POST)) {
	$message = htmlspecialchars($_POST["message"]);
  $message = $con->real_escape_string($message);
  $date = date("Y-m-d H:i:s");  
  $stmt4 = "INSERT INTO messages (thread_id, msg_from, msg_from_name, msg_to, msg_to_name, message, sent_on) VALUES ('$thread_id', '$my_id', '$my_first_name', '$their_id', '$their_first_name', '$message', '$date')";
  if(mysqli_query($con, $stmt4)){
    header('Location: create_message.php?id=' . $their_id);
  } else{
    echo "ERROR: " . mysqli_error($con);
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> 
	</head>
	<body id="loggedin">

		<div class="nav-light dating-signed-in-nav">
		</div>

		<div class="content">
			<h2>Messages</h2>
			<div>
				<div class="msg_wrapper">
					<div class="compose-msg">
						<form name="create-msg" action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])).'?id='.$their_id?>" method="post">
							<div class="msg-text-n-button">
								<textarea class="textarea" id="msg-textarea" rows="3" cols="auto" name="message" placeholder="Please type a message to send"></textarea>
								<button id="msg-button"  class="edit-button" type="submit" name="send_message">Send Messsage</button>
							</div>
						</form>
					</div>	

					<div id="prev-msgs">
						<?php 
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  $left_message =	'		
                    <div class="left-msg">
                      <p class="msg-name">' . $my_first_name . '</p>
                      <div class="img-sent-div-left">
                        <img src="/php/' . $my_image_main . '" />
                        <p class="sent-text">' . $row["sent_on"] . '</p>
                      </div>
                      <div class="talk-bubble-left tri-right round left-in">
                        <div class="talktext">
                          <p id="talktext-p">' . $row[nl2br("message")] . '</p>
                        </div>
                      </div>
                    </div>';
                  $right_message =	'		
                    <div class="right-msg">
                      <p class="msg-name">' . $their_first_name . '</p>
                      <div class="img-sent-div-right">
                        <img src="/php/' . $their_image_main . '" />
                        <p class="sent-text">' . $row["sent_on"] . '</p>
                      </div>
                      <div class="talk-bubble-right tri-right round right-in">
                        <div class="talktext">
                          <p id="talktext-p">' . $row[nl2br("message")] . '</p>
                        </div>
                      </div>
                    </div>';
		              if($row["msg_to"] == $my_id) {     
	                  echo $left_message;
		              } 
		              if($row["msg_from"] == $my_id) { 
	                  echo $right_message;
		              }
	              }
              } else {
                echo "There are no previous messages. This is your only chance to make a first impression. Better make it good, or hope that they get amnesia...";
              }   ?> 		
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