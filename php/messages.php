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
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$my_id = $_SESSION['id'];

//sees how many messages are unread
$unread_count = "";
if ($unread_result = $con->query("SELECT id FROM messages WHERE msg_to = '$my_id' AND msg_read = 0")) {
  $unread_count = $unread_result->num_rows;
  $unread_result->close();
}

$sql = "SELECT * FROM messages WHERE msg_to = '$my_id' ORDER BY sent_on DESC";
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
				<table class="table table-striped">
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
  								$ogMessage = $row["message"];
  								if (strlen($ogMessage) > 50) {
							      $newMessage = substr($ogMessage, 0, 50);
								  } else {
							      $newMessage = $ogMessage;
								  }
                  if($row["msg_read"] == '1') { ?>
  									<tr class="msg_not_read" data-value="<?php echo $row['msg_from']; ?>">
  								<?php 
  								} 
                  if  ($row["msg_read"] == '0') {  ?>
	  								<tr class="msg_read" data-value="<?php echo $row['msg_from']; ?>">
								  <?php }  ?>
		  								<td><?php echo $row["msg_from_name"]; ?></td>
		  								<td class="ellipsis"><?php echo $newMessage . "..."; ?></td>
		  								<td><?php echo $row["sent_on"]; ?></td>
                    </tr>    
									<?php 
								} 	
							} else {
							  echo "You don't have any messages, yet. Don't worry, it's not you, it's me. As the saying goes, right?";
							}   ?>
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
    <script type="text/javascript">
    	$(document).ready(function(){
        $('.msg_not_read').click(function() {
          let msgValue = $(this).data('value');
          location.href = '/php/create_message.php?id=' + msgValue;
        })
        $('.msg_read').click(function() {
          let msgValue = $(this).data('value');
          location.href = '/php/create_message.php?id=' + msgValue;
        })

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

        //for only displaying 1 message from each person: if siblings text is the same, display none? make sure to use ids or usernames, because first names can repeat
    	});
  	</script>
	</body>
</html>
