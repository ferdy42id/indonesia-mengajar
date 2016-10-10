<?php
session_start();
require_once('../Database.php');
require_once('../Article.php');
require_once('../User.php');
require_once('../Function.php');
$article = new Article();
$user = new User();
$userid = $_GET['id'];
$title = $_POST['title'];
$string = $title;
$URL_slug = replaceTitle($string);
$content = $_POST['content'];
$category = $_POST['category'];
$file_name = $_FILES['images']['name'];
$file_size = $_FILES['images']['size'];
$file_type = $_FILES['images']['type'];
$file_tmp = $_FILES['images']['tmp_name'];//lokasi sementara
$file_location = "../images/" . $file_name;
$date = date('Y-m-d h-i-s');
$submit = $_POST['submit'];
if($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif"){
	if(move_uploaded_file($file_tmp, $file_location)){
		$images = $file_name;
	}
}else{
	echo 'tipe salah';
}
echo $images;
		if($submit){
				$article->setURL_slug($URL_slug);
				$article->setTitle($title);
				$article->setcontent($content);
				$article->setImages($images);
				$article->setUserId($userid);
				$article->setDate($date);
				$article->setCategory($category);
				$article->insert();
		}

?>
