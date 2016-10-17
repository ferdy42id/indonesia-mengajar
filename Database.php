<?php
	class Database{
		public $host;
		public $user;
		public $pass;
		public $db;
		public $konek;
		function __construct(){
			$this->host = 'localhost';
			$this->user = 'root';
			$this->pass = '';
			$this->db = 'projectprakrin';
			$this->konek = mysqli_connect( $this->host, $this->user, $this->pass, $this->db) or die ('Error');
			return $this->konek;
		}
	}
?>