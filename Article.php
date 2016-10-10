<?php

require_once('Database.php');
require_once('Function.php');
require_once('User.php');



class Article{

	public $id;

	public $userid;

	public $title;

	public $content;

	public $date;

	public $category;

	public $database;

	public $categoryName;

	public $function;

	public $images;

	public $URL_slug;



	function koneksi(){

		$this->database = new Database;

		return $this->database->konek;

	}


	function get(){

		$get = mysqli_query($this->koneksi(), "SELECT * FROM article WHERE id = '$this->id'");

		$checkArticle = mysqli_fetch_array($get);

		$this->setId($checkArticle['id']);

	}



	function setId($id){

		$this->id = $id;

	}



	function setUserId($userid){

		$this->userid = $userid;

	}



	function setTitle($title){

		$this->title = $title;

	}



	function setContent($content){

		$this->content = $content;

	}



	function setDate($date){

		$this->date = $date;

	}



	function setCategory($category){

		$this->category = $category;

	}

	function setCategoryName($categoryName){

		$this->categoryName = $categoryName;

	}



	function setImages($images){

		$this->images = $images;

	}



	function setURL_slug($URL_slug){

		$this->URL_slug = $URL_slug;

	}



	function getId(){

		return $this->id;

	}



	function getUserId(){

		return $this->userid;

	}



	function getTitle(){

		return $this->title;

	}



	function getContent(){

		return $this->content;

	}



	function getDate(){

		return $this->date;

	}



	function getCategory(){

		return $this->category;

	}



	function getCategoryName(){

		return $this->categoryName;

	}



	function getImages(){

		return $this->images;

	}



	function getURL_slug(){

		return $this->URL_slug;

	}



	// Fungsi Masukan artikel

	function insert(){

		$save = mysqli_query($this->koneksi(), "INSERT INTO article(URL_slug, title, content, images, userid, dateUpdate, kategoriID) VALUES('$this->URL_slug','$this->title', '$this->content', '$this->images', '$this->userid' , '$this->date' , '$this->category')");

		if($save){

			header('location:home/1');

		}

		else{

			echo 'gagal<br><a href="home/2">back</a>';

		}

	}



	//fungsi edit artikel

	function edit(){

		$update = mysqli_query ($this->koneksi(), "UPDATE article set title='$this->title', content='$this->content' WHERE id = $this->id ");

		if($update){

			header('location:home/3');

		}

		else{

			header('location:home/4');

		}

	}

	//Fungsi Memunculkan value content,title

	function showValue(){

		$getValue = mysqli_query($this->koneksi(), "SELECT * FROM article WHERE id = ".$_GET['id']);

		$show = mysqli_fetch_array($getValue);

		$title = $show['title'];

		$content = $show['content'];

		$date = $show['dateUpdate'];

		$this->setTitle($title);

		$this->setContent($content);

		$this->setDate($date);



	}



	// Fungsi Memunculkan Tabel

	function show(){

		$i = 0;

		if(isset($this->categoryName)){

			$join = mysqli_query($this->koneksi(), "SELECT article.*, user.username, category.kategori FROM article INNER JOIN user ON article.userid = user.id INNER JOIN category ON article.kategoriID = category.id  WHERE category.kategori = '$this->categoryName' AND article.userid = '$this->userid'  ORDER BY article.dateUpdate DESC");

		}else{

			$join = mysqli_query($this->koneksi(), "SELECT article.id, article.userid, article.title, article.content, article.dateUpdate, user.username FROM article INNER JOIN user ON article.userid=user.id WHERE article.userid = '$this->userid' ORDER BY article.dateUpdate DESC");

		}



		while ($dataArtikel = mysqli_fetch_array($join)) {

			$i++;

			echo $this->category;

			echo '

			<tr>

				<td>'. $dataArtikel['title'] .'</td>

				<td>';

						$string = $dataArtikel['content'];

						if (strlen($string)  > 60){

							$stringCut = substr($string, 0, 60);



							$string = substr($stringCut, 0, strrpos($stringCut, ' ')).' ......';





						}

						echo $string;

				echo'</td>

				<td>'. $dataArtikel['username'] .'</td>

				<td>';	$time = strtotime($dataArtikel['dateUpdate']);

						$year = date('Y', $time);

						$month = date('m', $time);

						$day = date('d', $time);

						$hours = date('h', $time);

						$minute = date('i', $time);

						echo $day .'-'. $month .'-'. $year .' <br> '. $hours  .':'. $minute;

				echo'</td>

				<td><a href="admin/edit-artikel/'. $dataArtikel['id'] .'"><button type="button" class="btn btn-edition btn-default">edit</button></a></td>

			</tr>

			';

		}

	}

	// Fungsi detail user

	function showUser(){

		$show = mysqli_query($this->koneksi(),"SELECT article.*, user.username FROM article INNER JOIN user ON article.userid = user.id WHERE article.URL_slug = "."'$this->URL_slug'");

		$dataArtikel = mysqli_fetch_array($show);

		echo $dataArtikel['username'];

	}

	// Fungsi detail

	function showListDetail(){

		$show = mysqli_query($this->koneksi(),"SELECT article.*, user.username FROM article INNER JOIN user ON article.userid = user.id WHERE article.URL_slug = "."'$this->URL_slug'");

		$dataArtikel = mysqli_fetch_array($show);

		$time = strtotime($dataArtikel['dateUpdate']);

		$month = date('M', $time);

		$date = date('d', $time);

		echo '

		<div class="row batas1">

			<div class="col-md-8">

				<div class="row batas">

					<div class="col-md-12">



						<div class="row">

							<div class="col-md-1">

								<h3 class="besarhuruf">

									'. $month .' <strong>'. $date .'</strong>

								</h3>

							</div>



							<div class="col-md-11">

								<a href="kabar-terbaru/';$string = $dataArtikel['title']; echo replaceTitle($string); echo'" class="judul">

									<h1>'. $dataArtikel['title'] .'</h1>

								</a>

								oleh <a href="#" class="nama">'. $dataArtikel['username'] .'</a>

							</div>



						</div>



						<div class="row">

							<div class="col-md-12 padding-content" style="text-align: justify;">';

							if ($dataArtikel['images'] == '' || $dataArtikel['images'] == null ){

								echo '';



							}else{

								echo '<img class="headerImg" src="'; $img = $dataArtikel['images']; echo showImage($img); echo '"/><br>';

							}

								echo $dataArtikel['content'].'

							</div>

						</div>



					</div>

				</div>

				';

	}

	// Fungsi list

	function showList(){

		$i = 0;

		if(isset($this->categoryName)){

			$show = mysqli_query($this->koneksi(), "SELECT article.*, user.username, category.kategori FROM article INNER JOIN user ON article.userid = user.id INNER JOIN category ON article.kategoriID = category.id  WHERE category.kategori = '$this->categoryName' ORDER BY article.dateUpdate DESC");

		}else{

			$show = mysqli_query($this->koneksi(), "SELECT article.id, article.userid, article.title, article.content, article.dateUpdate, user.username FROM article INNER JOIN user ON article.userid=user.id ORDER BY article.dateUpdate DESC");

		}

		while ($dataArtikel = mysqli_fetch_array($show)){

			$i++;

			$time = strtotime($dataArtikel['dateUpdate']);

			$month = date('M', $time);

			$date = date('d', $time);

			if ($i == 1){

				echo '

				<div class="row">

					<div class="col-md-12">

						<h1>Kabar Terbaru Indonesia Mengajar</h1>

					</div>

				</div>
				<hr class="bold">
				<div class="row">

					<div class="col-md-8">



							<div class="col-md-12">



								<div class="row">

									<div class="col-md-1">

										<h3 class="besarhuruf">

											'. $month .' <strong>'. $date .'</strong>

										</h3>

									</div>



									<div class="col-md-11">

										<a href="kabar-terbaru/';$stringTitle = $dataArtikel['title']; $judul = replaceTitle($stringTitle); echo $judul; echo'" class="judul">

											<h1>'. $dataArtikel['title'] .'</h1>

										</a>

										oleh <a href="#" class="nama">'. $dataArtikel['username'] .'</a>

									</div>



								</div>



								<div class="row">

									<div class="col-md-12" style="text-align: justify;">

										';

										$stringContent = $dataArtikel['content'];



											echo shortContent($stringContent, $judul);



										echo '

									</div>

								</div>



							<hr class="drop-shadow">

							</div>

						';

			}

			else{

				echo '

					<div class="col-md-6">

							<div class=" article-min-height">

								<div class="row">

									<div class="col-md-1">

										<h3 class="besarhuruf">

											'. $month .' <strong>'. $date .'</strong>

										</h3>

									</div>

									<div class="col-md-11">

										<a href="kabar-terbaru/';$string = $dataArtikel['title']; echo replaceTitle($string); echo'" class="judul">

											<h3>'.$dataArtikel['title'].'</h3>

										</a>

										oleh <a href="#" class="nama">'. $dataArtikel['username'] .'</a>

									</div>

								</div>

								<br>

								<div class="row">

									<div class="col-md-12" style="text-align: justify;">

										';

										$string = $dataArtikel['content'];



											echo shortContent2($string);



										echo '

									</div>

								</div>

							</div>

								<hr class="bold">

					</div>

				';

			}

			if ($i > 9){

				echo'selanjutnya';

			}

		}

	}

}

?>

