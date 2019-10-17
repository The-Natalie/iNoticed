<?php 
$errors = '';
$myemail = 'kindness@inoticed.org';//<-----Put Your email address here.
if(empty($_POST['name'])  || 
   empty($_POST['email']))
{
    $errors .= "\n Error: all fields are required";
}


if (isset($_POST['Submit'])) {
	$selected_radio = $_POST['cards'];
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$cards = $_POST['cards']

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Kindness cards request from: $name";
	$email_body = "\n Name: $name You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address ".
	" Number of cards requested: \n $cards "; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);

} 
?>
