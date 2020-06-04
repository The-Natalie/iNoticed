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
	die ($param = 'Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}
 
$stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id);
$stmt->fetch();
 
// Define variables and initialize with empty values
$first_name = "";
$age = "";
$gender = "";
$feet = "";
$inches = "";
$eyes = "";
$heir = "";
$smoke = "";
$drugs = "";
$transportation = "";
$intention = "";
$zip = "";
$city = "";
$state = "";
$profession = "";
$education = "";
$ethnicity = "";
$religion = "";
$marital_status = "";
$kids = "";
$want_kids = "";
$about_me = "";
$is_error = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
  // Get hidden input value
  $id = $_POST["id"];
        
  // Validate (I removed validation because html does it, but left the other info)
  $input_first_name = trim($_POST["first_name"]);
  $input_age = trim($_POST["age"]);
  $input_gender = trim($_POST["gender"]);
  $input_feet = trim($_POST["feet"]);
  $input_inches = trim($_POST["inches"]);
  $input_eyes = trim($_POST["eyes"]);
  $input_hair = trim($_POST["hair"]);
  $input_smoke = trim($_POST["smoke"]);
  $input_drugs = trim($_POST["drugs"]);
  $input_transportation = trim($_POST["transportation"]);
  $input_intention = trim($_POST["intention"]);
  $input_zip = trim($_POST["zip"]);
  $input_city = trim($_POST["city"]);
  $input_state = trim($_POST["state"]);
  $input_profession = trim($_POST["profession"]);
  $input_education = trim($_POST["education"]);
  $input_ethnicity = trim($_POST["ethnicity"]);
  $input_religion = trim($_POST["religion"]);
  $input_marital_status = trim($_POST["marital_status"]);
  $input_kids = trim($_POST["kids"]);
  $input_want_kids = trim($_POST["want_kids"]);
  $input_about_me = trim($_POST["about_me"]);

  $first_name = $input_first_name;
  $age = $input_age;
  $gender = $input_gender;
  $feet = $input_feet;
  $inches = $input_inches;
  $eyes = $input_eyes;
  $hair = $input_hair;
  $smoke = $input_smoke;
  $drugs = $input_drugs;
  $transportation = $input_transportation;
  $intention = $input_intention;
  $zip = $input_zip;
  $city = $input_city;
  $state = $input_state;
  $profession = $input_profession;
  $education = $input_education;
  $ethnicity = $input_ethnicity;
  $religion = $input_religion;
  $marital_status = $input_marital_status;
  $kids = $input_kids;
  $want_kids = $input_want_kids;
  $about_me = $input_about_me;

  // Check input errors before inserting in database
  if(empty($is_error)){
    // Prepare an update statement
    $sql = "UPDATE accounts SET first_name=?, age=?, gender=?, feet=?, inches=?, eyes=?, hair=?, smoke=?, drugs=?, transportation=?, intention=?, zip=?, city=?, state=?, profession=?, education=?, ethnicity=?, religion=?, marital_status=?, kids=?, want_kids=?, about_me=? WHERE id=?";
     
    if($stmt = mysqli_prepare($con, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sisssssssssissssssssssi", $param_first_name, $param_age, $param_gender, $param_feet, $param_inches, $param_eyes, $param_hair, $param_smoke, $param_drugs, $param_transportation, $param_intention, $param_zip, $param_city, $param_state, $param_profession, $param_education, $param_ethnicity, $param_religion, $param_marital_status, $param_kids, $param_want_kids, $param_about_me, $param_id);
          
      // Set parameters
      $param_first_name = $first_name;
      $param_age = $age;
      $param_gender = $gender;
      $param_feet = $feet;
      $param_inches = $inches;
      $param_eyes = $eyes;
      $param_hair = $hair;
      $param_smoke = $smoke;
      $param_drugs = $drugs;
      $param_transportation = $transportation;
      $param_intention = $intention;
      $param_zip = $zip;
      $param_city = $city;
      $param_state = $state;
      $param_profession = $profession;
      $param_education = $education;
      $param_ethnicity = $ethnicity;
      $param_religion = $religion;
      $param_marital_status = $marital_status;
      $param_kids = $kids;
      $param_want_kids = $want_kids;
      $param_about_me = $about_me;
      $param_id = $id;
          
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        // Records updated successfully. Redirect to landing page
        $param = "Your profile has been updated sucessfully.";
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


} else{
  // Check existence of id parameter before processing further
  if(isset($_GET["id"])){
    // Get URL parameter
    $id =  trim($_GET["id"]);
      
    // Prepare a select statement
    $sql = "SELECT * FROM accounts WHERE id = ?";
    if($stmt = mysqli_prepare($con, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "i", $param_id);
          
      // Set parameters
      $param_id = $id;
            
      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
    
        if(mysqli_num_rows($result) == 1){
          /* Fetch result row as an associative array. Since the result set
          contains only one row, we don't need to use while loop */
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
          // Retrieve individual field value
          $first_name = $row["first_name"];
        } else{
          // URL doesn't contain valid id. 
          $param = "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";                    
          $is_error = "1";
        }
                
      } else{
        $param = "Oops! Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.";
        $is_error = "1";
      }
    }
        
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($con);
  }  else{
    // URL doesn't contain id parameter. 
    $param = "URL doesn't contain id parameter. Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";
    $is_error = "1";
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
            <h2>Profile Update Results</h2>
            <div>
    			<p><?php echo $param; ?></p>
                <br />
                <a href="/php/profile.php"><button type="button">View my profile  <i class="far fa-edit"></i></button></a>
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