<?php

// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

session_start();

if(!isset($_SESSION['username'])) {
    exit;
}

// checking lang value
if(isset($_COOKIE['sy_lang'])) {
    $load_lang_code = $_COOKIE['sy_lang'];
} else {
    $load_lang_code = "en";
}

// including lang files
switch ($load_lang_code) {
    case "en":
        require(__DIR__ . '/lang/en.php');
        break;
    case "pl":
        require(__DIR__ . '/lang/pl.php');
        break;
}

// Including the plugin config file, don't delete the following row!
require(__DIR__ . '/pluginconfig.php');

$info = pathinfo($_FILES["upload"]["name"]);
$ext = $info['extension'];
$target_dir = $useruploadpath;
$ckpath = "ckeditor/plugins/imageuploader/$useruploadpath";
$randomLetters = $rand = substr(md5(microtime()),rand(0,26),6);
$imgnumber = count(scandir($target_dir));
$filename = "$imgnumber$randomLetters.$ext";
$target_file = $target_dir . $filename;
$ckfile = $ckpath . $filename;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["upload"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "<script>alert('".$uploadimgerrors1."');</script>";
    $uploadOk = 0;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<script>alert('".$uploadimgerrors2."');</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "ico" ) {
    echo "<script>alert('".$uploadimgerrors4."');</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('".$uploadimgerrors5."');</script>";
// if everything is ok, try to upload file
} else {
    // resize img
     if($imageFileType == "jpeg" || $imageFileType == "jpg" ){
        $image_create_func = 'imagecreatefromjpeg';
        $image_save_func = 'imagejpeg';
        $new_image_ext = 'jpg';
    }
    elseif($imageFileType == "png"){
        $image_create_func = 'imagecreatefrompng';
        $image_save_func = 'imagepng';
        $new_image_ext = 'png';
    }
    elseif($imageFileType == "gif"){
        $image_create_func = 'imagecreatefromgif';
        $image_save_func = 'imagegif';
        $new_image_ext = 'gif';
    }
    $location = $image_create_func($_FILES["upload"]["tmp_name"]);
    list($width, $height) = getimagesize($_FILES["upload"]["tmp_name"]);
    if($width <= 400){
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            if(isset($_GET['CKEditorFuncNum'])){
                $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$ckfile', '');</script>";
            }
        }else {
            echo "<script>alert('".$uploadimgerrors6." ".$target_file." ".$uploadimgerrors7."');</script>";
        }
    }
    else{
        $newWidth = 400;
        $newHight = ($height / $width) * $newWidth;

        $tmp = imagecreatetruecolor($newWidth, $newHight);
        imagecopyresampled($tmp, $location, 0, 0, 0, 0, $newWidth, $newHight, $width, $height);
        $resize = $image_save_func($tmp, $target_file);

        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $resize)) {
            if(isset($_GET['CKEditorFuncNum'])){
                $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$ckfile', '');</script>";
            }
        }else {
            echo "<script>alert('".$uploadimgerrors6." ".$target_file." ".$uploadimgerrors7."');</script>";
        }
    }
    
}
//Back to previous site
if(!isset($_GET['CKEditorFuncNum'])){
    echo '<script>history.back();</script>';
}