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

    $stmt = $con->prepare('SELECT id FROM accounts WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    $stmt->fetch();

    // Prepare a delete statement
    $sql = "DELETE FROM accounts WHERE id = $id";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($id);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully.
            $param = "Your account has been closed sucessfully. We're sorry to see you go, but we hope it's because you found what you were looking for!"; 
        } else{
            $param = "Oops! Something went wrong. Please sign in and try again. Or let dating@inoticed.org know the details of your problem.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">  
  </head>
  <body id="loggedin">

      <div class="nav-light dating-signed-out-nav">
      </div>

      <div class="content">
      <h2>Close Account Results</h2>
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