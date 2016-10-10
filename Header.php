<?php
  function cssHref(){
      $url = "http://" . $_SERVER['SERVER_NAME'] . "/";

      return '<!-- Bootstrap CSS -->
      <link rel="stylesheet" href="'. $url .'css/bootstrap.css">
      <link rel="stylesheet" href="'. $url .'custom.css">
      <link rel="stylesheet" href="'. $url .'css/font-awesome.min.css">';

  }

  function jsHref(){
      $url = "http://" . $_SERVER['SERVER_NAME'] . "/";
      return '<!-- jQuery -->

      <script src="'. $url .'js/jquery.js"></script>

      <!-- Bootstrap JavaScript -->

      <script src="'. $url .'js/bootstrap.js"></script>';

  }


  function hrefUrl(){
      $url = "http://" . $_SERVER['SERVER_NAME'] . "/";
      return $url;
  }


?>
