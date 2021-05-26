<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$config = parse_ini_file('../../private/config.ini');
$con = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbdating']);
 
// Check connection
if($con === false){
    die("Let dating@inoticed.org know the details of this error: ERROR: Could not connect. " . mysqli_connect_error());
}
?>