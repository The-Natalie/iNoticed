<?php

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
  die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}    


//remove file from server
if(isset($_POST['path'])){
 $path = $_POST['path']; 
 $path = urldecode($path);

 // Check file exist or not 
 if( file_exists($path) ){ 
  // Remove file 
  unlink($path); 

  // Set status 
  echo 1; 
 }else{ 
  // Set status 
  echo 0; 
 } 
}


//update field to NULL
$stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id);
$stmt->fetch();
 
// Define variables and initialize with empty values
$value = $_POST['value'];
$image = "";
$is_error = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
        
        // Validate image (I removed validation because html does it, but left the other info)
        $input_image = NULL;
        $image = $input_image;
        

        // Check input errors before inserting in database
        if(empty($is_error)){
            // Prepare an update statement
            $sql = "UPDATE accounts SET ".$value."=? WHERE id=?";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_image, $param_id);
                
                // Set parameters
                $param_image = $image;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. 
                    echo "Your image has been removed sucessfully";
                } else { 
                    echo "Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.";
                    $is_error = "1";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($con);

    // } else {
    //      header("location: /php/account_settings.php");
    //     echo "Your current password is incorrect.";
    // }

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
                    $image = $row[$value];
                } else{
                    // URL doesn't contain valid id. 
                echo "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.";                    
                $is_error = "1";
                exit();
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
// Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);

die;

?>