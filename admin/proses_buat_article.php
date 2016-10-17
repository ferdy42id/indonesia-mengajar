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
$content_encode = htmlspecialchars($content, ENT_QUOTES);
$category = $_POST['category'];
$file_name = $_FILES['images']['name'];
$file_size = $_FILES['images']['size'];
$file_type = $_FILES['images']['type'];
$file_tmp = $_FILES['images']['tmp_name'];//lokasi sementara
// check ext for random name
	if($file_type == "image/jpeg"){
        $ext = 'jpg';
	}
	elseif($file_type == "image/png"){
        $ext = 'png';
	}
	elseif($file_type == "image/gif"){
        $ext = 'gif';
	}
$randomName = random_string(8).'.'.$ext;
$file_location = "../images/" . $randomName;
$date = date('Y-m-d h-i-s');
$submit = $_POST['submit'];
if($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif"){
	if($file_type == "image/jpeg"){
		$image_create_func = 'imagecreatefromjpeg';
        $image_save_func = 'imagejpeg';
        $new_image_ext = 'jpg';
	}
	elseif($file_type == "image/png"){
		$image_create_func = 'imagecreatefrompng';
        $image_save_func = 'imagepng';
        $new_image_ext = 'png';
	}
	elseif($file_type == "image/gif"){
		$image_create_func = 'imagecreatefromgif';
        $image_save_func = 'imagegif';
        $new_image_ext = 'gif';
	}
	$location = $image_create_func($file_tmp);
	list($width, $height) = getimagesize($file_tmp);
	if($width <= 700){
		if(move_uploaded_file($file_tmp, $file_location)){
			$images = $randomName;
		}
	}
	else{
		$newWidth = 700;
		$newHight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHight);
		imagecopyresampled($tmp, $location, 0, 0, 0, 0, $newWidth, $newHight, $width, $height);
		$resize = $image_save_func($tmp, $file_location);
		if(move_uploaded_file($file_tmp, $resize)){
			$images = $randomName;
		}
	}

}else{
	echo 'Tipe Salah<br>';
	echo '<a href="settings/change-profile"><button type="button" class="btn btn-primary">back</button></a>';
}
		if($submit){
				$article->setURL_slug($URL_slug);
				$article->setTitle($title);
				$article->setcontent($content_encode);
				$article->setImages($images);
				$article->setUserId($userid);
				$article->setDate($date);
				$article->setCategory($category);
				$article->insert();
		}
?>
