<?php 
require_once('Database.php');
require_once('User.php');
$user = new user;
$username = $_POST['username'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['new_password_2'];
$submit = $_POST['submit'];

if($submit){
	$user->setUsername($username);
	$user->setPassword($current_password);
	$user->setNewPassword($new_password);
	$user->changePassword($confirm_password);
}

?>