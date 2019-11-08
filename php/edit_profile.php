<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
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
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Get data from database
$stmt = $con->prepare('SELECT id, first_name, age, gender, feet, inches, eyes, hair, smoke, drugs, transportation, intention, zip, city, state, profession, education, ethnicity, religion, marital_status, kids, want_kids, about_me FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $first_name, $age, $gender, $feet, $inches, $eyes, $hair, $smoke, $drugs, $transportation, $intention, $zip, $city, $state, $profession, $education, $ethnicity, $religion, $marital_status, $kids, $want_kids, $about_me);
$stmt->fetch();
$stmt->close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">$(document).ready(function(){

	var gender = "<?=$gender?>";   
	var feet = "<?=$feet;?>";
	var inches = "<?=$inches;?>";
	var eyes = "<?=$eyes;?>"; 
	var hair = "<?=$hair;?>"; 
	var smoke = "<?=$smoke;?>";
	var drugs = "<?=$drugs;?>";
	var tranportation = "<?=$tranportation;?>";
	var intention = "<?=$intention;?>"; 
	var education = "<?=$education;?>"; 
	var ethnicity = "<?=$ethnicity;?>";
	var marital_status = "<?=$marital_status;?>"; 
	var kids = "<?=$kids;?>"; 
	var want_kids = "<?=$want_kids;?>"; 

	if (gender == null || gender === "") {
		$("#gender option[value='']").attr('selected', 'selected'); 
	} else {
		$("#gender option[value='" + gender + "']").attr('selected', 'selected'); 
	}

	if (feet == null || feet === "") {
		$("#feet option[value='']").attr('selected', 'selected'); 
		console.log("null = " + feet);
	} else {
		$("#feet option[value='" + feet + "']").attr('selected', 'selected'); 
		console.log("not null = " + feet);
	}

	if (inches == null || inches === "") {
		$("#inches option[value='']").attr('selected', 'selected'); 
	} else {
		$("#inches option[value='" + inches + "']").attr('selected', 'selected'); 
	}

	if (eyes == null || eyes === "") {
		$("#eyes option[value='']").attr('selected', 'selected'); 
	} else {
		$("#eyes option[value='" + eyes + "']").attr('selected', 'selected'); 
	}

	if (hair == null || hair === "") {
		$("#hair option[value='']").attr('selected', 'selected'); 
	} else {
		$("#hair option[value='" + hair + "']").attr('selected', 'selected'); 
	}

	if (smoke == null || smoke === "") {
		$("#smoke option[value='']").attr('selected', 'selected'); 
	} else {
		$("#smoke option[value='" + smoke + "']").attr('selected', 'selected'); 
	}

	if (drugs == null || drugs === "") {
		$("#drugs option[value='']").attr('selected', 'selected'); 
	} else {
		$("#drugs option[value='" + drugs + "']").attr('selected', 'selected'); 
	}

	if (tranportation == null || tranportation === "") {
		$("#tranportation option[value='']").attr('selected', 'selected'); 
	} else {
		$("#tranportation option[value='" + tranportation + "']").attr('selected', 'selected'); 
	}

	if (intention == null || intention === "") {
		$("#intention option[value='']").attr('selected', 'selected'); 
	} else {
		$("#intention option[value='" + intention + "']").attr('selected', 'selected'); 
	}

	if (education == null || education === "") {
		$("#education option[value='']").attr('selected', 'selected'); 
	} else {
		$("#education option[value='" + education + "']").attr('selected', 'selected'); 
	}

	if (ethnicity == null || ethnicity === "") {
		$("#ethnicity option[value='']").attr('selected', 'selected'); 
	} else {
		$("#ethnicity option[value='" + ethnicity + "']").attr('selected', 'selected'); 
	}

	if (marital_status == null || marital_status === "") {
		$("#marital_status option[value='']").attr('selected', 'selected'); 
	} else {
		$("#marital_status option[value='" + marital_status + "']").attr('selected', 'selected'); 
	}

	if (kids == null || kids === "") {
		$("#kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#kids option[value='" + kids + "']").attr('selected', 'selected'); 
	}

	if (want_kids == null || want_kids === "") {
		$("#want_kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#want_kids option[value='" + want_kids + "']").attr('selected', 'selected'); 
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
	<body id="loggedin">

		<div class="nav-light">
			<div class="nav-left">
				<div class="title"><a href="/">iNoticed</a></div>
			</div>
			<div class="nav-right">
				<a href="/php/dating_home.php"><i class="fas fa-envelope"></i>Home</a>
				<a href="/php/messages.php"><i class="fas fa-envelope"></i>Messages</a>
				<a href="/php/profile.php"><i class="fas fa-address-card"></i>My Profile</a>
				<a href="/php/account_settings.php"><i class="fas fa-cog"></i>Account Settings</a>
				<a href="/php/dating_logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
			</div>
		</div>

		<div class="content">
			<h2>Edit Profile</h2>
			<div>
				 <p>Gender = <?=$gender?> <br />
				 first name = <?=$first_name?></p> 
				<form id="edit_profile" method="post" action="/php/updated_profile.php">
					<p>First Name:&nbsp;&nbsp;<input id ="first_name" type="text" name="first_name" size="20" value="<?=$first_name?>" required/></p>
					<p>Age:&nbsp;&nbsp;<input id="age" type="number" name="age" maxlength="3" size="3" value="<?=$age?>" required/></p>
					<p>Gender:&nbsp;&nbsp;
 						<select id="gender" name="gender" size="1" required>
 							<option value="">[Choose Option Below]</option>
					    <option value="female">Female</option>
					    <option value="male">Male</option>
					    <option value="queer">Queer</option>
					    <option value="nonbinary">Nonbinary</option>
					    <option value="genderfluid">Genderfluid</option>
					    <option value="agender">Agender/Gender-Neutral</option>
					    <option value="transgender">Transgender</option>
					    <option value="gender-trans">Gender Transition</option>
					  </select>
					</p>
					<p>Height:&nbsp;&nbsp;
						<select id="feet" name="feet" size="1" required>
							<option value="">Feet</option>
					    <option value="f2">2</option>
					    <option value="f3">3</option>
					    <option value="f4">4</option>
					    <option value="f5">5</option>
					    <option value="f6">6</option>
					    <option value="f7">7</option>
				  	</select>
				  	<select id="inches" name="inches" size="1" required>
				  		<option value="">Inches</option>
				  		<option value="i0">0</option>
				  		<option value="i1">1</option>
					    <option value="i2">2</option>
					    <option value="i3">3</option>
					    <option value="i4">4</option>
					    <option value="i5">5</option>
					    <option value="i6">6</option>
					    <option value="i7">7</option>
					    <option value="i8">8</option>
					    <option value="i9">9</option>
					    <option value="i10">10</option>
					    <option value="i11">11</option>
					    <option value="i12">12</option>
				  	</select>
				  </p>
			  	<p>Eye Color:&nbsp;&nbsp;
						<select id="eyes" name="eyes" size="1" required>
							<option value="">[Choose]</option>
					    <option value="blue">Blue</option>
					    <option value="green">Green</option>
					    <option value="brown">Brown</option>
					    <option value="hazel">Hazel</option>
					    <option value="grey">Grey</option>
					    <option value="blue-green">Blue & Green</option>
					    <option value="fake-color">Colored Contacts</option>
			  		</select>
			  	</p>
			  	<p>Hair Color:&nbsp;&nbsp;
						<select id="hair" name="hair" size="1" required>
							<option value="">[Choose]</option>
					    <option value="blond">Blond</option>
					    <option value="brown">Brown</option>
					    <option value="red">Red</option>
					    <option value="black">Black</option>
					    <option value="white">White</option>
					    <option value="grey">Grey</option>
					    <option value="fake-color">Unnatural Color</option>
			  		</select>
			  	</p>
			  	<p>Do I smoke:&nbsp;&nbsp;
						<select id="smoke" name="smoke" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Do I do drugs:&nbsp;&nbsp;
						<select id="drugs" name="drugs" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Do I own a car/truck/motorcycle/something with a motor to get me around:&nbsp;&nbsp;
						<select id="transportation" name="transportation" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>What kind of relationship I'm looking for:&nbsp;&nbsp;
						<select id="intention" name="intention" size="1" required>
							<option value="">[Choose]</option>
					    <option value="serious">Serious/Long Term</option>
					    <option value="dating">Dating/Short Term</option>
					    <option value="marriage">Marriage</option>
					    <option value="looking">Just Looking</option>
					    <option value="hookup">Hookup</option>
					    <option value="fwb">Friends With Benefits</option>
			  		</select>
			  	</p>
					<p>Location (enter your zip and the rest will be completed automatically):
						<fieldset>
							<div id="zipbox" class="control-group">
								<label for="zip">Zip:&nbsp;&nbsp;</label>
								<input id="zip" type="text" pattern="[0-9]*" name="zip" value="<?=$zip?>" required/>
							</div>
							<div>
								<div id="citybox" class="control-group">
									<label for="city">City:&nbsp;&nbsp;</label>
									<input id="city" type="text" name="city" value="<?=$city?>" required/>
								</div>
								<div id="statebox" class="control-group">
									<label for="state">State:&nbsp;&nbsp;</label>
									<input id="state" type="text" name="state" value="<?=$state?>" required/>
								</div>
							</div>
						</fieldset>
					</p>
					<p>Profession:&nbsp;&nbsp;<input id="profession" type="text" name="profession" size="25" value="<?=$profession?>" required/></p>
					<p>Highest level of education:&nbsp;&nbsp;
						<select id="education" name="education" size="1" required>
							<option value="">[Choose]</option>
					    <option value="pre-highS">Some High School or Lower</option>
					    <option value="highS">High School Degree/GED</option>
					    <option value="pre-coll">Some College</option>
					    <option value="associate">Associate's Degree</option>
					    <option value="bachelor">Bachelor's Degree</option>
					    <option value="master">Master's Degree</option>
					    <option value="doctor">Doctoral Degree</option>
			  		</select>
			  	</p>
			  	<p>Ethnicity:&nbsp;&nbsp;
			  		<select id="ethnicity" name="ethnicity" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="asian">Asian</option>
					    <option value="black">Black/African</option>
					    <option value="white">Caucasian</option>
					    <option value="hispanic">Hispanic/Latino</option>
					    <option value="native">Native American</option>
					    <option value="pacific">Pacific Islander</option>
					    <option value="mixed">Mixed Race</option>
					    <option value="other">Other</option>
			  		</select>
			  	</p>
					<p>Religion:&nbsp;&nbsp;<input id="religion" type="text" name="religion" size="30" value="<?=$religion?>" required/></p>
					<p>Marital status:&nbsp;&nbsp;
			  		<select id="marital_status" name="marital_status" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="single">Single</option>
					    <option value="relationship">In a Relationship</option>
					    <option value="engaged">Engaged</option>
					    <option value="married">Married</option>
					    <option value="divorced">Divorced</option>
					    <option value="seperated">Seperated</option>
					    <option value="widowed">Widowed</option>
			  		</select>
			  	</p>
			  	<p>Have kids (if yes, how many)?:&nbsp;&nbsp;
			  		<select id="kids" name="kids" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="yes1-2">Yes, 1 or 2</option>
					    <option value="yes3-4">Yes, 3 or 4</option>
					    <option value="yes5-6">Yes, 5 or 6</option>
					    <option value="yes7-plus">Yes, 7+</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Want kids?:&nbsp;&nbsp;
			  		<select id="want_kids" name="want_kids" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>About me and what I'm looking for:</p>
			  	<textarea id="about_me" type="text" name="about_me" value="<?=$about_me?>" required style="max-width:75%;" rows="10"></textarea>
					<input type="hidden" name="id" value="<?php echo $id; ?>"/>
					<input style="margin-top: 10px;" type="submit" value="Submit"/>
				</form>	
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
