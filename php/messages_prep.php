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

$stmt = $con->prepare('SELECT id, username FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $username);
$stmt->fetch();


$my_message = "Testing 1,2,3";

        // Check input errors before inserting in database
        if(empty($is_error)){
            // Prepare an update statement
            $sql = "UPDATE messages SET message=? WHERE id=1";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_my_message);
                
                // Set parameters
                $param_my_message = $my_message;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. 
                    $param = "Your email has been updated sucessfully.";
                } else { 
                    $param = "Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.";
                    $is_error = "1";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($con);






switch( $_REQUEST['action'] ) {
	case "sendMessage":

		//global $con;
		session_start();
		$query = $con->prepare("INSERT INTO messages SET ".$username."=?, message=?");
		$run = $query->execute([$username, $_REQUEST['message']]);
		if( $run ) {
			echo 1;
			exit;
		}
	break;
	case "getMessages":
		session_start();
		$query = $con->prepare("SELECT * FROM messages");
		$run = $query->execute();
		$rs = $query->fetchAll(PDO::FETCH_OBJ);
		$chat = '';
		foreach( $rs as $message ) {
			$chat .= '<div class="single-message '.(($username==$message->username)?'right':'left').'">
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
$stmt->close();

?>