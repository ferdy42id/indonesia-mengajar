<?php 
require_once('Database.php');
require_once('User.php');
$user = new user;
$email = $_POST['email'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['new_password_2'];
$submit = $_POST['submit'];
if($submit){
	$user->setEmail($email);
	$user->setPassword($current_password);
	$user->setNewPassword($new_password);
	$user->changePassword($confirm_password);
}
?>