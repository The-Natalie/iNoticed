<?php

$config = parse_ini_file('../../private/config.ini');
$con = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbdating']);

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}

// First we check if the email and code exists...
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			// Account exists with the requested email and code.
			if ($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
				// Set the new activation code to 'activated', this is how we can check if the user has activated their account.
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				$param = "This account has been activated. You may now sign in.";
			}
		} else {
			$param = "This account is already activated or doesn't exist. If you feel that you've encountered an error, please let dating@inoticed.org know the details of your problem.";
		}
	}
}
mysqli_stmt_close($stmt);
        
$my_id = $_SESSION['id'];

//sees how many messages are unread
$unread_count = "";
if ($unread_result = $con->query("SELECT id FROM messages WHERE msg_to = '$my_id' AND msg_read = 0")) {
    $unread_count = $unread_result->num_rows;
    $unread_result->close();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>iNoticed | Dating</title>
    <meta charset="utf-8">  
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/styles.css"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">  
  </head>
  <body id="loggedin">

      <div class="nav-light dating-signed-out-nav">
      </div>

      <div class="content">
      <h2>Activation Results</h2>
      <p><?php echo $param; ?></p>
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