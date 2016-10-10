<?php 	 
require_once('Database.php');
require_once('User.php');
$user = new User;
$images = $_POST['images'];
$submit = $_POST['submit'];
if($submit){
	$user->setFirstName($first_name);
	$user->setSurName($sur_name);
	$user->setBirthDate($birth_date);
	$user->setGender($gender);
	$user->setwebsite($website);
	$user->setFacebook($facebook_profile);
	$user->setEmail($email);
	$user->setUsername($username);
	$user->changeProfile();
}
?>