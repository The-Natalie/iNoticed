<?php

$DATABASE_HOST = 'mysql.inoticed.org';
$DATABASE_USER = 'ndhall';
$DATABASE_PASS = 'natabata14';
$DATABASE_NAME = 'inoticed_dating';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ($param = 'Failed to connect to MySQL: ' . mysqli_connect_error());
}
 
// Prepare an update statement
$sql = "UPDATE accounts SET 'first_name'=?, 'age'=?, 'gender'=?, 'feet'=?, 'inches'=?, 'eyes'=?, 'hair'=?, 'smoke'=?, 'drugs'=?, 'transportation'=?, 'intention'=?, 'zip'=?, 'city'=?, 'state'=?, 'profession'=?, 'education'=?, 'ethnicity'=?, 'religion'=?, 'marital_status'=?, 'kids'=?, 'want_kids'=?, 'about_me'=? WHERE 'accounts'.'id'=?";
 
if($stmt = mysqli_prepare($con, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sisssssssssissssssssss", $first_name, $age, $gender, $feet, $inches, $eyes, $hair, $smoke, $drugs, $transportation, $intention, $zip, $city, $state, $profession, $education, $ethnicity, $religion, $marital_status, $kids, $want_kids, $about_me);
    
    // Set parameters
    $first_name = $_REQUEST['first_name'];
    $age = $_REQUEST['age'];
    $gender = $_REQUEST['gender'];
    $feet = $_REQUEST['feet'];
    $inches = $_REQUEST['inches'];
    $eyes = $_REQUEST['eyes'];
    $hair = $_REQUEST['hair'];
    $smoke = $_REQUEST['smoke'];
    $drugs = $_REQUEST['drugs'];
    $transportation = $_REQUEST['transportation'];
    $intention = $_REQUEST['intention'];
    $zip = $_REQUEST['zip'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $profession = $_REQUEST['profession'];
    $education = $_REQUEST['education'];
    $ethnicity = $_REQUEST['ethnicity'];
    $religion = $_REQUEST['religion'];
    $marital_status = $_REQUEST['marital_status'];
    $kids = $_REQUEST['kids'];
    $want_kids = $_REQUEST['want_kids'];
    $about_me = $_REQUEST['about_me'];
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $param = "Your profile has been updated successfully.";
    } else{
        $param = "ERROR: Could not execute query: $sql. " . mysqli_error($con);
    }
} else{
    $param = "ERROR: Could not prepare query: $sql. " . mysqli_error($con);
}
 
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($con);
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
			<h2>Profile Update Results</h2>
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
	</body>
</html>