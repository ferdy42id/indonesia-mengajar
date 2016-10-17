<?php
	session_start();
	require_once('Database.php');
	require_once('User.php');
	$email = $_POST['email'];
	$password = $_POST['password'];
	$submit = $_POST['submit'];
	$user = new User();
	if($submit){
		$user->setEmail($email);
		$user->setPassword($password);
		$user->logIn();
	}
?>