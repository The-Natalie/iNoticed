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


$stmt = $con->prepare('SELECT username FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username);
$stmt->fetch();

$target_dir = "uploads/";
$target_file = $target_dir . $username . "_" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$value;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $input_value = trim($_POST["fileToUpload"]);
  $value = $input_value;
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $param2 = "File is not an image.";
      $uploadOk = 0;
  }
}
// Check if file already exists
if (file_exists($target_file)) {
    $param2 = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2097153) {
  $param2 = "Sorry, your file is too large.";
  $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF" ) {
  $param2 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $param1 = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $param1 = "Your photo has been saved as ". basename( $_FILES["fileToUpload"]["name"]). " ";
    
      $is_error = "";

      // Processing form data when form is submitted
      if(isset($_POST["id"]) && !empty($_POST["id"])){
        // Get hidden input value
        $id = $_POST["id"];

        

        // Check input errors before inserting in database
        if(empty($is_error)){
          // Prepare an update statement
          $sql = "UPDATE accounts SET `".$value."` =? WHERE id=?";

          if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_target_file, $param_id);
                    
            // Set parameters
            $param_target_file = $target_file;
            $param_id = $id;
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              // Records updated successfully. 
              $param = "It has been posted sucessfully.";
            } else { 
              $param = "It was NOT posted sucessfully. Please try again later. Or let dating@inoticed.org know the details of your problem.";
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
                $target_file = $row["image_main"];
              } else{
                // URL doesn't contain valid id. 
                $param = "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";                    
                $is_error = "1";
                exit();
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

  } else {
    $param1 = "Sorry, there was an error uploading your file.";
  }
}

// if (isset($_POST['btnSubmit'])) {
//   $uploadfile = $_FILES["uploadImage"]["tmp_name"];
//   $folderPath = "uploads/";

// $target_dir = "uploads/";
// $target_file = $target_dir . $username . "_" . basename($_FILES["fileToUpload"]["name"]);
  
//   if (! is_writable($folderPath) || ! is_dir($folderPath)) {
//     $param = "error";
//   }
//   if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderPath . $_FILES["uploadImage"]["name"])) {
//     $param = '<img src="' . $folderPath . "" . $_FILES["uploadImage"]["name"] . '">';
//   }
// }

// $stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
// $stmt->bind_param('i', $_SESSION['id']);
// $stmt->execute();
// $stmt->store_result();
// $stmt->bind_result($id);
// $stmt->fetch();




// $fileName = $_FILES['image_main']['name'];
// $target = "/user_images/";          
// $fileTarget = $target.$fileName;     
// $result = move_uploaded_file($fileTarget)
// $image_main = "";

// if($result) { 
//   if(isset($_POST["id"]) && !empty($_POST["id"])){
//     // Get hidden input value
//     $id = $_POST["id"];

//     $input_image_main = ($_POST[$fileTarget]);

//     $image_main = $input_image_main;

//     if(empty($is_error)){
//     // Prepare an update statement
//     $sql = "UPDATE accounts SET image_main=? WHERE id=?";

//       if($stmt = mysqli_prepare($con, $sql)){
//         // Bind variables to the prepared statement as parameters
//         mysqli_stmt_bind_param($stmt, "si", $param_image_main, $param_id);
        
//         // Set parameters
//         $param_image_main = $image_main;
//         $param_id = $id;
//         mysqli_stmt_execute($stmt)
//       }
//     }
//   }
// }
// mysqli_stmt_close($stmt);
// mysqli_close($con);

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
      <div>
        <p><?php echo $param2; ?></p>
        <p><?php echo $param1; ?></p>
        <p><?php echo $param; ?></p>
        <p style="color:blue;"><?php echo $value; ?></p>
        <br />
        <a href="/php/profile.php"><button class="edit-button" type="button">View my profile  <i class="fas fa-address-card"></i></button></a>
        <br />
        <a href="/php/edit_profile.php"><button class="edit-button" type="button">Edit my profile  <i class="far fa-edit"></i></button></a>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
  </body>
</html>