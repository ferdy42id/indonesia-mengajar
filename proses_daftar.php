<?php

	require_once('Database.php');
	require_once("User.php");
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$submit = $_POST['submit'];
	$user = new User();

	if($submit){
		$user->setEmail($email);
		$user->setFirstName($first_name);
		$user->setPassword($password);
		$user->insert($confirm_password);
	}
?>