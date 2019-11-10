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

//Get data from database
$stmt = $con->prepare('SELECT id, first_name, age, gender, feet, inches, eyes, hair, smoke, drugs, transportation, intention, zip, city, state, profession, education, ethnicity, religion, marital_status, kids, want_kids, about_me FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $first_name, $age, $gender, $feet, $inches, $eyes, $hair, $smoke, $drugs, $transportation, $intention, $zip, $city, $state, $profession, $education, $ethnicity, $religion, $marital_status, $kids, $want_kids, $about_me);
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
			<h2><?php echo $first_name; ?>'s Profile Page</h2>
			<div class="profile">
				<a href="/php/profile.php"><button type="button">Edit profile  <i class="fas fa-user"></i></button></a>
				<br />
				<br />
				<p>Edit Profile:</p>
				<form method="post" action="/php/edit_profile.php">
						<p>First Name:  <input type="text" name="first_name" size="20" value="<?php echo $first_name; ?>" required></p>
						<p>Age:  <input type="number" name="age" maxlength="3" size="3" value="<?php echo $age; ?>" required></p>
						<p>Gender:&npsb;&npsb;
 						<select name="gender" size="1" value="<?php echo $gender; ?>" required>
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
					<p>Height:&npsb;&npsb;
						<select name="feet" size="1" value="<?php echo $feet; ?>" required>
							<option value="">Feet</option>
					    <option value="f2">2</option>
					    <option value="f3">3</option>
					    <option value="f4">4</option>
					    <option value="f5">5</option>
					    <option value="f6">6</option>
					    <option value="f7">7</option>
				  	</select>
				  	<select name="inches" size="1" value="<?php echo $inches; ?>" required>
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
			  	<p>Eye Color:&npsb;&npsb;
						<select name="eyes" size="1" value="<?php echo $eyes; ?>" required>
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
			  	<p>Hair Color:&npsb;&npsb;
						<select name="hair" size="1" value="<?php echo $hair; ?>" required>
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
			  	<p>What kind of relationship I'm looking for:&npsb;&npsb;
						<select name="intention" size="1" value="<?php echo $intention; ?>" required>
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
								<label for="zip">Zip  </label>
								<input type="text" class=” pattern="[0-9]*" name="zip" id="zip" value="<?php echo $zip; ?>" required/>
							</div>
							<div>
								<div id="citybox" class="control-group">
									<label for="city">City  </label>
									<input type="text" name="city" id="city" value="<?php echo $city; ?>" required>
								</div>
								<div id="statebox" class="control-group">
									<label for="state">State  </label>
									<input type="text" name="state" id="state" value="<?php echo $state; ?>" required/>
								</div>
							</div>
						</fieldset>
					</p>
					<p>Profession:  <input type="text" name="profession" size="25" value="<?php echo $profession; ?>" required></p>
					<p>Highest level of education:&npsb;&npsb;
						<select name="education" size="1" value="<?php echo $education; ?>" required>
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
			  	<p>Ethnicity:&npsb;&npsb;
			  		<select name="ethnicity" size="1" value="<?php echo $ethnicity; ?>" required>
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
						<p>Religion<input type="text" name="religion" size="30" value="<?php echo $religion; ?>" required></p>
						<p>Marital status:&npsb;&npsb;
			  		<select name="marital_status" size="1" value="<?php echo $marital_status; ?>" required>
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
			  	<p>Have kids (if yes, how many)?:&npsb;&npsb;
			  		<select name="kids" size="1" value="<?php echo $kids; ?>" required>
			  			<option value="">[Choose]</option>
					    <option value="yes1-2">Yes, 1 or 2</option>
					    <option value="yes3-4">Yes, 3 or 4</option>
					    <option value="yes5-6">Yes, 5 or 6</option>
					    <option value="yes7-plus">Yes, 7+</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Want kids?:&npsb;&npsb;
			  		<select name="want_kids" size="1" value="<?php echo $want_kids; ?>" required>
			  			<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>About me and what I'm looking for:<input type="text" name="about_me" size="1000" value="<?php echo $about_me; ?>" required></p>
					<input type="hidden" name="id" value="<?php echo $id; ?>"/>
					<input style="margin-top: 10px;" type="submit" value="Submit">
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
