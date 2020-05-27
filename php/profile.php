<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// This determines what a visitor can see based on whether or not they're signed in
if (!isset($_SESSION['loggedin'])) {
	$user_state = 'signed-out-nav';
} else {
	$user_state = 'signed-in-nav';
}

$DATABASE_HOST = 'mysql.inoticed.org';
$DATABASE_USER = 'ndhall';
$DATABASE_PASS = 'natabata14';
$DATABASE_NAME = 'inoticed_dating';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}

$their_username = 'a';
if (isset($_GET['user'])) {
    $their_username = $_GET['user'];
}

if ($their_username !== 'a') {
	$stmt = $con->prepare("SELECT id, first_name, age, gender, feet, inches, eyes, hair, smoke, drugs, transportation, intention, zip, city, state, profession, education, ethnicity, religion, marital_status, kids, want_kids, about_me, image_main, image1, image2, image3, image4, image5, image6, image7, image8 FROM accounts WHERE username = '$their_username'");
} else {
	$stmt = $con->prepare('SELECT id, first_name, age, gender, feet, inches, eyes, hair, smoke, drugs, transportation, intention, zip, city, state, profession, education, ethnicity, religion, marital_status, kids, want_kids, about_me, image_main, image1, image2, image3, image4, image5, image6, image7, image8 FROM accounts WHERE id = ?');
}

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $first_name, $age, $gender, $feet, $inches, $eyes, $hair, $smoke, $drugs, $transportation, $intention, $zip, $city, $state, $profession, $education, $ethnicity, $religion, $marital_status, $kids, $want_kids, $about_me, $image_main, $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8);
$stmt->fetch();

$aboutme = nl2br($about_me);

$stmt->close();
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">$(document).ready(function(){
//Show or hide images on profile page****
	var thmbMain = "<?=$image_main?>";   
	var thmb1 = "<?=$image1?>";
	var thmb2 = "<?=$image2?>";
	var thmb3 = "<?=$image3?>";
	var thmb4 = "<?=$image4?>";
	var thmb5 = "<?=$image5?>";
	var thmb6 = "<?=$image6?>";
	var thmb7 = "<?=$image7?>";
	var thmb8 = "<?=$image8?>";

	if (thmbMain == null || thmbMain === "") {
		$('img.thmb-main').css({"display": "none"});
	}

	if (thmb1 == null || thmb1 === "") {
		$('img.thmb-1').css({"display": "none"});
	}

	if (thmb2 == null || thmb2 === "") {
		$('img.thmb-2').css({"display": "none"});
	}

	if (thmb3 == null || thmb3 === "") {
		$('img.thmb-3').css({"display": "none"});
	}

	if (thmb4 == null || thmb4 === "") {
		$('img.thmb-4').css({"display": "none"});
	}

	if (thmb5 == null || thmb5 === "") {
		$('img.thmb-5').css({"display": "none"});
	}

	if (thmb6 == null || thmb6 === "") {
		$('img.thmb-6').css({"display": "none"});
	}

	if (thmb7 == null || thmb7 === "") {
		$('img.thmb-7').css({"display": "none"});
	}

	if (thmb8 == null || thmb8 === "") {
		$('img.thmb-8').css({"display": "none"});
	}

	if ('<?=$user_state?>' === 'signed-out-nav') {
		$('.edit-button').click(function(e) {
			e.preventDefault();
			$('.msg-button p').css({"color": "red"}).html("Please sign up or sign in to send messages.");
		});
	}	

	if ('<?=$their_username?>' === 'a') {
		$('.msg-button').css({"display": "none"});
	}

});</script>



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
	<body>

		<div class="nav-light dating-<?=$user_state?>">
		</div>

		<div class="content">
			<div style="padding: 0;">
				<div class="profile-page row">	
					<div class="profile-left col-md-4">
						<img class="main-profile-img col-md-12" src="/php/<?php echo $image_main; ?>">
						<div class="profile-left-ps">
							<p style="padding: 10px 5px 2px 10px;">Age: <span style="font-weight: normal;"><?=$age?></span></p>
							<p style="padding: 0 5px 2px 10px;">Identifiles as: <span style="font-weight: normal;"><?=$gender?></span></p>
							<p style="padding: 0 5px 2px 10px;">Profession: <span style="font-weight: normal;"><?=$profession?></span></p>
							<p style="padding: 0 5px 2px 10px;">Lives in: <span style="font-weight: normal;"><?=$city?>, <?=$state?></span></p>
							<p style="padding: 0 5px 2px 10px;">Kind of relationship <?=$first_name?> is looking for: <span style="font-weight: normal;"><?=$intention?></span></p>
						</div>
						<div class="profile-thumbnails">
							<table>
							  <tr>
							    <td><img class="thumbnail thmb-1" src="/php/<?php echo $image1; ?>"></td>
							    <td><img class="thumbnail thmb-2" src="/php/<?php echo $image2; ?>"></td>
							  </tr>
							  <tr>
							    <td><img class="thumbnail thmb-3" src="/php/<?php echo $image3; ?>"></td>
							    <td><img class="thumbnail thmb-4" src="/php/<?php echo $image4; ?>"></td>
							  </tr>
							  <tr>
							    <td><img class="thumbnail thmb-5" src="/php/<?php echo $image5; ?>"></td>
							    <td><img class="thumbnail thmb-6" src="/php/<?php echo $image6; ?>"></td>
							  </tr>
							  <tr>
							    <td><img class="thumbnail thmb-7" src="/php/<?php echo $image7; ?>"></td>
							    <td><img class="thumbnail thmb-8" src="/php/<?php echo $image8; ?>"></td>
							  </tr>
							</table>

						</div>
					</div>	
					<div class="profile-right col-md-8">
						<h2 class="profile-name"><?=$first_name?>'s Profile</h2>
						<p>Summary:</p>
						<p class="profile-summary" style=""><?php echo $aboutme; ?></p>
					</div>
				</div>	

				<div class="profile-info row">
					<div class="col-md-6" style="padding: 0;">
						<p>Marital status: <span style="font-weight: normal;"><?=$marital_status?></span></p>
						<p>Highest level of education: <span style="font-weight: normal;"><?=$education?></span></p>	
						<p>Height: <span style="font-weight: normal;"><?=$feet?>' <?=$inches?>"</span></p>
						<p>Eye color: <span style="font-weight: normal;"><?=$eyes?></span></p>
						<p>Smokes: <span style="font-weight: normal;"><?=$smoke?></span></p>
						<p>Has kids: <span style="font-weight: normal;"><?=$kids?></span></p>	
					</div>
					<div class="col-md-6" style="padding: 0;">
						<p>Ethnicity: <span style="font-weight: normal;"><?=$ethnicity?></span></p>
						<p>Religion: <span style="font-weight: normal;"><?=$religion?></span></p>
						<p>Owns a car/truck/etc: <span style="font-weight: normal;"><?=$transportation?></span></p>
						<p>Hair color: <span style="font-weight: normal;"><?=$hair?></span></p>
						<p>Drugs: <span style="font-weight: normal;"><?=$drugs?></span></p>
						<p>Wants kids: <span style="font-weight: normal;"><?=$want_kids?></span></p>
					</div>	
				</div>

				<div class="msg-button"><p ></p>
					<a href="create_message.php?id=<?=$id?>"><button class="edit-button" type="button"><i class="fas fa-envelope"></i> Message <?=$first_name?></button></a>  
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
