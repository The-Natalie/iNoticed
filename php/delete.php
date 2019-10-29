<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: /dating_sign_in.html');
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
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
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
            // Records deleted successfully. Redirect to landing page
            header("location: /account_closed.html");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.<br><a href='/php/account_settings.php'>Go Back</a>";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($con);

?>