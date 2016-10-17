<?php  
require_once('Database.php');
require_once('User.php');
$user = new User;
$database = new Database;
$current_email = $_POST['current_email'];
$email = $_POST['email'];
$submit = $_POST['submit'];
if($submit){
	$user->setEmail($email);
	$user->changeEmail($current_email);
}
?>