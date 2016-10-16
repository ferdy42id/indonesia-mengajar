<?php 	 
require_once('Database.php');
require_once('User.php');
$user = new User;
$first_name = $_POST['first_name'];
$sur_name = $_POST['sur_name'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$website = $_POST['website'];
$facebook_profile = $_POST['facebook_profile'];
$email = $_POST['email'];
$username = $_POST['username'];
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