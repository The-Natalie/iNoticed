<?
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

//Email activation check
$stmt = $con->prepare('SELECT activation_code, password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($activation_code, $password, $email);
$stmt->fetch();
if ($activation_code == '') {
// user not activated, redirect or display msg
    header('Location: /please_activate.html');
}
 
// Define variables and initialize with empty values
$email = $password = "";
// echo "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // //Verify current password is correct
    // if (password_verify($_POST['password'], $password)) {
        
        // Validate email
        $input_email = trim($_POST["email"]);
        if(empty($input_email)){
            $email = $email;
        } else {
            if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
                echo "Email is not valid. Please enter a valid email.";
            } else{
                $email = $input_email;
            }
        }   
        
        // Validate password
        $input_password = password_hash($_POST["password"]);
        if(empty($input_password)){
            $password = $password;
        } else {
            if (strlen($_POST['new-password']) > 25 || strlen($_POST['new-password']) < 5) {
                echo "Password must be between 5 and 25 characters long. Please try again.";
            } else{
                $password = $input_password;
            }
        }   
        
        // Check input errors before inserting in database
        if(empty($php_results)){
            // Prepare an update statement
            $sql = "UPDATE accounts SET email=?, password=? WHERE id=?";
             
            if($stmt = mysqli_prepare($con, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssi", $param_email, $param_password, $param_id);
                
                // Set parameters
                $param_email = $email;
                $param_password = $password;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    echo "Change(s) updated successfully.";
                    exit();
                } else { 
                    echo "Something went wrong. Please try again later.";
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
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
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
                    $password = $row["password"];
                } else{
                    // URL doesn't contain valid id. 
                    echo "Please sign out, sign back in, and try again.";                    
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. 
        echo "URL doesn't contain id parameter. Please sign out, sign back in, and try again.";
        exit();
    }
}
?>
 