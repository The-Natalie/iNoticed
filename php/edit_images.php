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
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}


$stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id);
$stmt->fetch();




$fileName = $_FILES['image_main']['name'];
$target = "/user_images/";          
$fileTarget = $target.$fileName;     
$result = move_uploaded_file($fileTarget)
$image_main = "";

if($result) { 
  if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $input_image_main = ($_POST[$fileTarget]);

    $image_main = $input_image_main;

    if(empty($is_error)){
    // Prepare an update statement
    $sql = "UPDATE accounts SET image_main=? WHERE id=?";

      if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_image_main, $param_id);
        
        // Set parameters
        $param_image_main = $image_main;
        $param_id = $id;
        mysqli_stmt_execute($stmt)
      }
    }
  }
}
mysqli_stmt_close($stmt);
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

    <div class="nav-light dating-signed-in-nav">
    </div>

    <div class="content">
      <h2>Add/Edit Image Results</h2>
      <p><?php echo $param; ?></p>
      <br />
      <a href="/php/profile.php"><button class="edit-button" type="button">View my profile  <i class="fas fa-address-card"></i></button></a>
      <br />
      <a href="/php/profile.php"><button class="edit-button" type="button">Edit my profile  <i class="far fa-edit"></i></button></a>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
  </body>
</html>