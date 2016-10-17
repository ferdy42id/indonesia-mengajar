<?php
require_once('Database.php');
require_once('User.php');
require_once('Header.php');
$user = new User;
session_start();
if(!isset($_SESSION['id'])){
	header('location:index.php');
}
else{
	$id = $_SESSION['id'];
	$user->setId($id);
	$user->sessionUser();
	$username = $user->first_name;
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
	<title>IndonesiaMengajar-Register</title>
	<?php
	echo cssHref();
	?>
</head>
<body>
	<nav class="navbar navbar-default top">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="row no-margin">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="home"><img class="img-responsive" src="https://indonesiamengajar.org/media/uploads/images/logo.png" alt="Logo Indonesia-Mengajar"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
					<?php
					if(!isset($_SESSION['id'])){
						echo '
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="register">Daftar</a>
							</li>
							<li>
								<a href="register">login</a>
							</li>
						</ul>';
					}
					else{
						echo '
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="glyphicon glyphicon-user"></b> ' . $username . '</a></li>
							<li><a href="settings">Profile</a></li>
							<li><a href="proses_logout.php">Logout</a></li>
						</ul>';
					}
					?>
				</div><!-- /.navbar-collapse -->
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="navbar-collapse">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="glyphicon glyphicon-user"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row no-margin">
			<div class="container">
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span class="sr-only">(current)</span></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tentang Kami <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Visi dan Misi</a></li>
								<li><a href="#">Sejarah</a></li>
								<li><a href="#">Tim Indonesia Mengajar</a></li>
								<li><a href="#">Kemitraan</a></li>
								<li><a href="#">Indonesia Menyala</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">FAQ</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pengajar Muda <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Jejak Pengajar Muda</a></li>
								<li><a href="#">Lokasi Penempatan</a></li>
								<li><a href="#">Profil Pengajar Muda</a></li>
								<li><a href="#">Blog Pengajar Muda</a></li>
								<li><a href="#">Pesan Pendiri Yayasan</a></li>
								<li><a href="#">Galeri Foto</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mari Bergabung <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Jadi Mengajar Muda</a></li>
								<li><a href="#">Jadi Volunteer</a></li>
								<li><a href="#">Ikut Iuran Publik</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="kabar-terbaru">Kabar Terbaru<span class="sr-only">(current)</span></a>
						</li>
						<li>
							<a href="#">Ruang Belajar<span class="sr-only">(current)</span></a>
						</li>
						<li>
							<a href="hubungi-kami">Hubungi Kami<span class="sr-only">(current)</span></a>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</div>
	</nav><!-- /.navgigasi -->
	<div class="container-fluid">
		<div class="container warna4">
			<div class="row batas">
				<div class="col-md-12 ketengah">
					<h1>Profile Anda</h1>
				</div>
			</div>
			<div class="row batas1">
					<?php 	echo $user->showProfileDetail() ?>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="container">
				<div class="col-md-3">
					<h4>Tentang Kami</h4>
					<ul class="drop">
						<li><a href="#">Visi dan Misi</a></li>
						<li><a href="#">Sejarah</a></li>
						<li><a href="#">Tim indonesia mengajar</a></li>
						<li><a href="#">Kemitraan</a></li>
						<li><a href="#">Indonesia Menyala</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Hubungi Kami</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h4>Pengajar Muda</h4>
					<ul class="drop">
						<li><a href="#">Jejak Pengajar Muda</a></li>
						<li><a href="#">Lokasi Penempatan</a></li>
						<li><a href="#">Profil Pengajar Muda</a></li>
						<li><a href="#">Blog Pengajar Muda</a></li>
						<li><a href="#">Indonesia Menyala</a></li>
						<li><a href="#">Pesan Pendiri Yayasan</a></li>
						<li><a href="#">Galeri Foto</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h4>Mari Bergabung</h4>
					<ul class="drop">
						<li><a href="#">Jadi Pengajar Muda</a></li>
						<li><a href="#">Jadi Volunteer</a></li>
						<li><a href="#">Ikut Iuran Publik</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h4>Connect With Us</h4>
					<ul class="drop">
						<li><a 	href="#">@Ind_Mengajar</a></li>
						<li><a href="#">Facebook Page</a></li>
						<li><a href="#">Pinterest</a></li>
						<li><a href="#">Youtube Channel</a></li>
					</ul>
				</div>
			</div>
		</div>
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
<!-- ini untuk input type date di internet exlplorer-->
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
	webshims.setOptions('forms-ext', {types: 'date'});
	webshims.polyfill('forms forms-ext');
</script>
<!-- ini untuk input type date di internet exlplorer-->
<script>
	document.getElementById('birth-date').valueAsDate = new Date();
</script>
</html>
