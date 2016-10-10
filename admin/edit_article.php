<?php

session_start();

require_once('../User.php');

require_once('../Database.php');

require_once('../Article.php');

require_once('../Header.php');

$user = new User();

$article = new Article();

$articleId = $_GET['id'];

$article->setId($articleId);

$article->get();

$article->showValue();

if(!isset($_SESSION['id'])){
	header('location:../register.php');
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

	<title><?php echo $user->username ?>-Edit Artikel</title>

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

					<li>

						<a href="admin/list-artikel">List Artikel</a>

					</li>

				</ul>

			</div><!-- /.navbar-collapse -->

		</div>

	</nav><!-- /.navgigasi -->



	<div class="container">



		<center>

			<h1>Edit Artikel</h1>

		</center>

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-12">

					<form action="admin/proses_edit_article.php?id=<?php echo $_GET['id']; ?>" method="post" class="form-editor">

						<div class="row">

							<div class="col-md-12">

								<div class="form-group">



									<label>Title</label>

									<input name="title" type="text" class="form-control" maxlength="90" placeholder="Title" value="<?php echo $article->getTitle(); ?>" required autofocus />



								</div>

								<div class="form-group">



									<label>Content</label>

									<textarea name="content" id="editor" type="text" placeholder="Content..."><?php echo $article->getContent(); ?></textarea>



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

<script src="ckeditor2/ckeditor.js"></script>

<script>

	CKEDITOR.replace( 'editor' );

</script><!-- /ckeditor -->

<script></script>

</html>

