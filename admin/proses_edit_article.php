<?php
session_start();
require_once('../Database.php');
require_once('../Article.php');
require_once('../User.php');
$article = new Article();
$user = new User();
$id = $_GET['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$submit = $_POST['submit'];
	if($submit){
		$article->setTitle($title);
		$article->setcontent($content);
		$article->setId($id);
		$article->edit();
	}
?>