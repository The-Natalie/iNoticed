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
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();
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
		<input id=user-state type="hidden" value="<?php echo $user_state; ?>"/>
		<div class="nav-light">
		</div>

		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<button type="button">View profile</button>
				<br />
				<br />
				<button class="edit-profile-button" type="button">Edit profile  <i class="far fa-edit"></i></button>
				<div id="edit-profile-form">
					<form method="post" action="/php/edit_profile.php">
 						<p>First Name:<input type="text" name="fname" value="<?php echo $fname; ?>"></p>
 						<p>Age:<input type="number" name="age" value="<?php echo $age; ?>"></p>
 						<p>Gender:
	 						<select name="gender" size="1" value="<?php echo $gender; ?>">
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
 						<p>Height:
 							<select name="fheight" size="1" value="<?php echo $fheight; ?>">
						    <option value="f2">2</option>
						    <option value="f3">3</option>
						    <option value="f4">4</option>
						    <option value="f5">5</option>
						    <option value="f6">6</option>
						    <option value="f7">7</option>Feet
					  	</select>
					  	<select name="iheight" size="1" value="<?php echo $iheight; ?>">
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
						    <option value="i12">12</option>Inches
					  	</select>
					  </p>
				  	<p>Eye Color:
							<select name="eyes" size="1" value="<?php echo $eyes; ?>">
						    <option value="blue">Blue</option>
						    <option value="green">Green</option>
						    <option value="brown">Brown</option>
						    <option value="hazel">Hazel</option>
						    <option value="grey">Grey</option>
						    <option value="blue-green">Blue & Green</option>
						    <option value="fake-color">Colored Contacts</option>
				  		</select>
				  	</p>
				  	<p>Hair Color:
							<select name="hair" size="1" value="<?php echo $hair; ?>">
						    <option value="blond">Blond</option>
						    <option value="brown">Brown</option>
						    <option value="red">Red</option>
						    <option value="black">Black</option>
						    <option value="white">White</option>
						    <option value="grey">Grey</option>
						    <option value="fake-color">Unnatural Color</option>
				  		</select>
				  	</p>
				  	<p>What kind of relationship I'm looking for:
							<select name="intention" size="1" value="<?php echo $intention; ?>">
						    <option value="serious">Serious/Long Term</option>
						    <option value="dating">Dating/Short Term</option>
						    <option value="marriage">Marriage</option>
						    <option value="looking">Just Looking</option>
						    <option value="hookup">Hookup</option>
						    <option value="fwb">Friends With Benefits</option>
				  		</select>
				  	</p>
 						<p>About me and what I'm looking for:<input type="text" name="about-me" value="<?php echo $aboutMe; ?>"></p>
						<p>Location (enter your zip and the rest will be completed automatically):
							<fieldset>
								<div id="zipbox" class="control-group">
									<label for="zip">Zip</label>
									<input type="text" class=” pattern="[0-9]*" name="zip" id="zip" value="<?php echo $zip; ?>"/>
								</div>
								<div>
									<div id="citybox" class="control-group">
										<label for="city">City</label>
										<input type="text" name="city" id="city" value="<?php echo $city; ?>">" />
									</div>
									<div id="statebox" class="control-group">
										<label for="state">State</label>
										<input type="text" name="state" id="state" value="<?php echo $state; ?>"/>
									</div>
								</div>
							</fieldset></p>
 						<p>Profession:<input type="text" name="profession" value="<?php echo $profession; ?>"></p>
 						<p>Highest level of education:
 							<select name="education" size="1" value="<?php echo $education; ?>">
						    <option value="pre-highS">Some High School or Lower</option>
						    <option value="highS">High School Degree/GED</option>
						    <option value="pre-coll">Some College</option>
						    <option value="associate">Associate's Degree</option>
						    <option value="bachelor">Bachelor's Degree</option>
						    <option value="master">Master's Degree</option>
						    <option value="doctor">Doctoral Degree</option>
				  		</select>
				  	</p>
				  	<p>Ethnicity:
				  		<select name="ethnicity" size="1" value="<?php echo $ethnicity; ?>">
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
 						<p>Religion<input type="text" name="religion" value="<?php echo $religion; ?>"></p>
 						<p>Marital status:
				  		<select name="marital" size="1" value="<?php echo $marital; ?>">
						    <option value="single">Single</option>
						    <option value="relationship">In a Relationship</option>
						    <option value="engaged">Engaged</option>
						    <option value="married">Married</option>
						    <option value="divorced">Divorced</option>
						    <option value="seperated">Seperated</option>
						    <option value="widowed">Widowed</option>
				  		</select>
				  	</p>
				  	<p>Have kids (if yes, how many)?:
				  		<select name="kids" size="1" value="<?php echo $kids; ?>">
						    <option value="yes1-2">Yes - 1 or 2</option>
						    <option value="yes3-4">Yes - 3 or 4</option>
						    <option value="yes5-6">Yes - 5 or 6</option>
						    <option value="yes7-plus">Yes - 7+</option>
						    <option value="no">No</option>
				  		</select>
				  	</p>
				  	<p>Want kids?:
				  		<select name="want-kids" size="1" value="<?php echo $wantKids; ?>">
						    <option value="yes">Yes</option>
						    <option value="no">No</option>
				  		</select>
				  	</p>
 						<input type="hidden" name="id" value="<?php echo $id; ?>"/>
 						<input style="margin-top: 10px;" type="submit" value="Submit">
					</form>	
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
