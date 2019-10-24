<?php
// Include config file
require_once "dating_config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$php_results = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    //Verify current password is correct
    if (password_verify($_POST['password'], $password)) {
        
        // Validate email
        $input_email = trim($_POST["email"]);
        if(empty($input_email)){
            $email = $email;
        } else {
            if(!filter_var($input_email, FILTER_VALIDATE_EMAIL)){
                header("location: /php/account_settings.php");
                $php_results = "Email is not valid. Please enter a valid email.";
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
                header("location: /php/account_settings.php");
                $php_results = "Password must be between 5 and 25 characters long. Please try again.";
            } else{
                $password = $input_password;
            }
        }   
        
        // Check input errors before inserting in database
        if(empty($php_results)){
            // Prepare an update statement
            $sql = "UPDATE accounts SET email=?, password=? WHERE id=?";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssi", $param_email, $param_password, $param_id);
                
                // Set parameters
                $param_email = $email;
                $param_password = $password;
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: /php/account_settings.php");
                    $php_results = "Change(s) updated successfully.";
                    exit();
                } else { 
                    header("location: /php/account_settings.php");
                    $php_results = "Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($link);

    } else {
         header("location: /php/account_settings.php");
        $php_results = "Your current password is incorrect.";
    }

} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM accounts WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
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
                    header("location: /php/account_settings.php");
                    $php_results = "Please sign out, sign back in, and try again.";                    
                    exit();
                }
                
            } else{
                header("location: /php/account_settings.php");
                $php_results = "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. 
        header("location: /php/account_settings.php");
        $php_results = "Please sign out, sign back in, and try again.";
        exit();
    }
}
?>
 