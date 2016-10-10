<?php

session_start();

require_once('Database.php');

require_once('User.php');

$user = new User();

$id = $_POST['id'];

$file_name = $_FILES['images']['name'];

$file_size = $_FILES['images']['size'];

$file_type = $_FILES['images']['type'];

$file_tmp = $_FILES['images']['tmp_name'];//lokasi sementara

$file_location = "admin/user/images/" . $file_name;

$submit = $_POST['submit'];

if($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif"){

	if(move_uploaded_file($file_tmp, $file_location)){

		$images = $file_name;

	}

}else{
	echo 'tipe salah';
}

		if($submit){

				$user->setImages($images);

				$user->changeImages($id);

		}



?>

