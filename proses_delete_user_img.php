<?php  
require_once('Database.php');
require_once('User.php');
$user = new User;
$id = $_POST['id'];
$images = $_POST['images'];
$submit = $_POST['submit'];
if($submit){
	$user->setId($id);
	$user->setImages($images);
	$user->deleteImagesUser();
}
?>