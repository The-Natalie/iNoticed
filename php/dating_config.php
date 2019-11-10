<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mysql.inoticed.org');
define('DB_USERNAME', 'ndhall');
define('DB_PASSWORD', 'natabata14');
define('DB_NAME', 'inoticed_dating');
 
/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("Let dating@inoticed.org know the details of this error: ERROR: Could not connect. " . mysqli_connect_error());
}
?>