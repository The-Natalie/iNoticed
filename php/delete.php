<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file

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

    // Prepare a delete statement
    $sql = "DELETE FROM accounts WHERE id = ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: inoticed.org");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($con);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        echo "URL doesn't contain id parameter";
        exit();
    }
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
    <body class="loggedin">

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
            <h2>Delete Profile</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert alert-danger fade in">
                    <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                    <p>Are you sure you want to delete your profile? Everything will be erased and it can't be undone.</p><br>
                    <p>
                        <input type="submit" value="Yes" class="btn btn-danger">
                        <a href="account_settings.php" class="btn btn-default">No</a>
                    </p>
                </div>
            </form>        
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