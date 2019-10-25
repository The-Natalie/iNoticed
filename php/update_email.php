<?php
// session_start();

$DATABASE_HOST = 'mysql.inoticed.org';
$DATABASE_USER = 'ndhall';
$DATABASE_PASS = 'natabata14';
$DATABASE_NAME = 'inoticed_dating';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    $php_results = 'Failed to connect to MySQL: ' . mysqli_connect_error();
    exit();
}

$stmt = $con->prepare('SELECT email, id FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($email, $id);
$stmt->fetch();

//Email activation check
// if ($activation_code == '') {
// // user not activated, redirect or display msg
//     header('Location: /please_activate.html');
// }
 
// Define variables and initialize with empty values
$email = "";
$php_results = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // //Verify current password is correct
    // if (password_verify($_POST['password'], $password)) {
        
        // Validate email
        $input_email = trim($_POST["email"]);
        if(empty($input_email)){
          $php_results = "Please enter an email.";
        } elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
            $php_results = "Email is not valid. Please enter a valid email.";
        } else{
            $email = $input_email;
        }

        // Check input errors before inserting in database
        if(empty($php_results)){
            // Prepare an update statement
            $sql = "UPDATE accounts SET email=? WHERE id=?";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "si", $param_email, $param_id);
                
                // Set parameters
                $param_email = $email;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    $php_results = "Change(s) updated successfully.";
                    exit();
                } else { 
                    $php_results = "Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem";
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
                    $email = $row["email"];
                } else{
                    // URL doesn't contain valid id. 
                $php_results = "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem";                    
                exit();
                }
                
            } else{
                $php_results = "Oops! Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. 
        $php_results = "URL doesn't contain id parameter. Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem";
        exit();
    }
}
mysqli_stmt_close($stmt);
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>iNoticed | Dating</title>
    <meta charset="utf-8">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/styles.css"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">  
  </head>
  <body id="loggedin">

      <div class="nav-light">
        <div class="nav-left">
          <div class="title"><a href="/">iNoticed</a></div>
        </div>
        <div class="nav-right">
          <a href="/php/dating_home.php"><i class="fas fa-envelope"></i>Home</a>
          <a href="/php/messages.php"><i class="fas fa-envelope"></i>Messages</a>
          <a href="/php/dating_profile.php"><i class="fas fa-address-card"></i>My Profile</a>
          <a href="/php/account_settings.php"><i class="fas fa-cog"></i>Account Settings</a>
          <a href="/php/dating_logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
        </div>
      </div>

      <div class="content">
      <h2>Home Page</h2>
        <p><?php echo $php_results; ?></p>            
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script language="JavaScript" src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
  </body>
</html>