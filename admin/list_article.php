<?php
session_start();
require_once('../User.php');
require_once('../Database.php');
require_once('../Article.php');
require_once('../Header.php');
require_once('../Category.php');
$user = new User();
$article = new Article();
$category = new Category();
if(isset($_GET['category'])){
	$categoryName = $_GET['category'];
	$article->setCategoryName($categoryName);
}
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
	$article->setUserId($id);
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
	<title><?php echo $user->username ?>-List Artikel</title>
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
					<li>
						<a href="admin/home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><span class="sr-only">(current)</span></a>
					</li>
					<li class="active">
						<a href="admin/list-artikel">List Artikel</a>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav><!-- /.navgigasi -->
	<div class="container">
		<center>
			<h1>List Artikel</h1>
		</center>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-10">
				</div>
				<div class="col-md-2">
					<div class="navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a style="color: #000;" href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori</a>
								<ul class="dropdown-menu">
									<li><a href="admin/list-artikel">All</a></li>
									<?php
										echo $category->listCategoryPrivate();
									?>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover table-color">
						<thead>
							<tr>
								<th>Title</th>
								<th>Content</th>
								<th>Create by</th>
								<th>Create at</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								echo $article->show();
							?>
						</tbody>
					</table>
				</div>
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
<script></script>
</html>
