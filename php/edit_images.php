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

if (isset($_POST['btnSubmit'])) {
  $uploadfile = $_FILES["uploadImage"]["tmp_name"];
  $folderPath = "uploads/";
  $value = $_POST["img_value"]; 
  $target_file = $folderPath . $username . "_" . basename($_FILES["uploadImage"]["name"]);


  if (! is_writable($folderPath) || ! is_dir($folderPath)) {
    echo "error";
  }
  if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderPath . $username . "_" . $_FILES["uploadImage"]["name"])) {
    echo '<img src="' . $folderPath . "" . $username . "_" . $_FILES["uploadImage"]["name"] . '">';
          // Processing form data when form is submitted
      if(isset($_POST["id"]) && !empty($_POST["id"])){
        // Get hidden input value
        $id = $_POST["id"];

        // Check input errors before inserting in database
        if(empty($is_error)){
          // Prepare an update statement
          $sql = "UPDATE accounts SET ".$value."=? WHERE id=?";

          if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_target_file, $param_id);
                    
            // Set parameters
            $param_target_file = $target_file;
            $param_id = $id;
                    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              // Records updated successfully. 
              echo "It has been posted sucessfully.";
            } else { 
              echo "It was NOT posted sucessfully. Please try again later. Or let dating@inoticed.org know the details of your problem.";
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
                echo "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";                    
                $is_error = "1";
              }

            } else{
                echo "Oops! Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.";
                $is_error = "1";
            }
          }
              
              // Close statement
              mysqli_stmt_close($stmt);
              
              // Close connection
              mysqli_close($con);
        }  else{
          // URL doesn't contain id parameter. 
          echo "URL doesn't contain id parameter. Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";
          $is_error = "1";
        }
      }
  }
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>