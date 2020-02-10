<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /sign_in.html');
	exit();
} 

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

	$dbhost = 'mysql.inoticed.org';
	$dbname = 'inoticed_dating';
	$dbuser = 'ndhall';
	$dbpass = 'natabata14';

	try{
		$db = new PDO("mysql:dbhost=$dbhost;dbname=$dbname", "$dbuser", "$dbpass");
	}catch( PDOException $e ){
		echo $e->getMessage();
	}

switch( $_REQUEST['action'] ) {
	case "sendMessage":

		//global $db;
		session_start();
		$query = $db->prepare("INSERT INTO messages SET username=?, message=?");
		$run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);
		if( $run ) {
			echo 1;
			exit;
		}
	break;
	case "getMessages":
		session_start();
		$query = $db->prepare("SELECT * FROM messages");
		$run = $query->execute();
		$rs = $query->fetchAll(PDO::FETCH_OBJ);
		$chat = '';
		foreach( $rs as $message ) {
			$chat .= '<div class="single-message '.(($_SESSION['username']==$message->username)?'right':'left').'">
						<strong>'.$message->username.': </strong><br /> <p>'.$message->message.'</p>
						<br />
						<span>'.date('h:i a', strtotime($message->date)).'</span>
						</div>
						<div class="clear"></div>
						';
		}
		echo $chat;
	break;
}

?>
