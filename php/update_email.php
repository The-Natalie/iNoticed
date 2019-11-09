<?php
session_start();

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
$is_error = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // //Verify current password is correct
    // if (password_verify($_POST['password'], $password)) {
        
        // Validate email
        $input_email = trim($_POST["email"]);
        $email = $input_email;
        

        // Check input errors before inserting in database
        if(empty($is_error)){
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
                    header('Location: /email_updated.html');
                    exit();
                } else { 
                    echo "Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.<br><a href='/php/account_settings.php'>Go Back</a>";
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
                    $email = $row["email"];
                } else{
                    // URL doesn't contain valid id. 
                echo "Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.<br><a href='/php/account_settings.php'>Go Back</a>";                    
                $is_error = "1";
                exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later. Or let dating@inoticed.org know the details of your problem.<br><a href='/php/account_settings.php'>Go Back</a>";
                $is_error = "1";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. 
        echo "URL doesn't contain id parameter. Please sign out, sign back in, and try again. Or let dating@inoticed.org know the details of your problem.<br><a href='/php/account_settings.php'>Go Back</a>";
        $is_error = "1";
        exit();
    }
}

?>