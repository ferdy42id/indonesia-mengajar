<?php
session_start();
require_once('../User.php');
require_once('../Database.php');
require_once('../Article.php');
require_once('../Header.php');
$user = new User();
if(!isset($_SESSION['id'])){
	header('location:../register');
}
else{
	$id = $_SESSION['id'];
	$user->setId($id);
	$user->sessionUser();
	$username = $user->first_name;
	$user->setUsername($username);
	$user->get();
}
if(isset($_GET['success'])){
	if($_GET['success'] == 1){
		echo '
		<script>
			alert("Berhasil membuat artikel anda")
		</script>';
	}elseif ($_GET['success'] == 2) {
		echo '
		<script>
			alert("Gagal membuat artikel anda");
		</script>
		';
	}
	elseif ($_GET['success'] == 3) {
		echo '
		<script>
			alert("Berhasil mengedit artikel anda");
		</script>
		';
	}elseif ($_GET['success'] == 4) {
		echo '
		<script>
			alert("Gagal mengedit artikel anda");
		</script>
		';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="http://ferdynosopian.local/"/>
	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $user->username ?>-Buat Artikel</title>
	<?php
	echo cssHref();
	?>
</head>
<body class="admin">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><b class="glyphicon glyphicon-user"></b> <?php echo $username; ?></a>
			</div>
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active">
						<a href="admin/home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span class="sr-only">(current)</span></a>
					</li>
					<li>
						<a href="admin/list-artikel">List Artikel</a>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav><!-- /.navgigasi -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<center>
					<h1>Selamat Datang, <?php  echo $username; ?></h1>
					<p>di web admin "Indonesia Mengajar", Buat artikel anda disini</p>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="admin/proses_buat_article.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class="form-editor">
					<div class="row">
						<div class="col-md-10">
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="pull-right">Kategori</label>
								<select name="category" id="inputTopic" class="form-control"  required="required">
									<option value="1">Belajar</option>
									<option value="2">Motivasi</option>
									<option value="3">Berita</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Title</label>
								<input name="title" type="text" class="form-control" placeholder="Enter text here ..." maxlength="90" required autofocus />
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea name="content" id="editor" type="text" placeholder="Content..."></textarea>
							</div>
							<div class="form-group">
								<label>Images</label>
								<input type="file" name="images">
								<small>note: This only for header</p>
								</div>
								<div class="form-group">
									<input class="btn btn-lg btn-primary pull-right" name="submit" type="submit" value="submit">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-footer">
				<div class="container">
					<span class="navbar-right">Didukung Oleh:</span>
					<span>© 2016 Yayasan Indonesia Mengajar. Some Rights Reserved.</span>
				</div>
			</div>
		</div>
	</body>
	<?php
	echo jsHref();
	?>
	<script src="js/smooth-scroll.js"></script>
	<!-- ckeditor -->
	<script src="ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editor' );
	</script><!-- /ckeditor -->
	<script></script>
	</html>
