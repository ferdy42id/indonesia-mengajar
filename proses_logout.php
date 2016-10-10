<?php
session_start();
require_once('Database.php');
require_once('User.php');
$user = new User();
$user->logOut();
?>