<?php
require_once('Database.php');
require_once('Function.php');
require_once('Article.php');

class Category{
  public $id;
  public $kategori;
  public $database;

  function koneksi(){
		$this->database = new Database;
		return $this->database->konek;
	}

  function setId($id){
    $this->id = $id;
  }

  function setKategori($kategori){
    $this->id = $kategori;
  }

  function getId(){
    return $this->id;
  }

  function getKategori(){
    return $this->kategori;
  }
  //list on public
  function listCategory(){
    $show = mysqli_query($this->koneksi(),"SELECT * FROM category ");
    $i=0;
    while($dataCategory=mysqli_fetch_array($show)){
      echo '<li><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span><a href="kabar-terbaru/topic/'. $dataCategory['kategori'] .'">'. $dataCategory['kategori'] .'</a></li>';

    }
  }

  //list on private
  function listCategoryPrivate(){
    $show = mysqli_query($this->koneksi(),"SELECT * FROM category ");
    $i=0;
    while($dataCategory=mysqli_fetch_array($show)){
      echo '<li><a href="admin/list-artikel/'. $dataCategory['kategori'] .'">'. $dataCategory['kategori'] .'</a></li>';
    }
  }
}
?>
