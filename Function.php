<?php
#short content pertama
	function shortContent($string, $judul){
		$string = strip_tags($string);
		if (strlen($string)  > 300){
			$string = substr($string, 0, 300).'.....<br><br><center><a href="kabar-terbaru/'.$judul.'">Read More</a></center>';
		}
		return $string;
	}
#short content sisanya
	function shortContent2($string){
		$string = strip_tags($string);
		if (strlen($string)  > 200){
			$string = substr($string, 0, 200).'...';
		}
		return $string;
	}
#short content admin list
	function shortContent3($string){
		$string = strip_tags($string);
		if (strlen($string)  > 60){
			$string = substr($string, 0, 60).'...';
		}
		return $string;
	}
#ganti symbol, Upercase ke huruf normal
	function replaceTitle($string){
		// replace non letter or digits by -
		$string = preg_replace('~[^\pL\d]+~u', '-', $string);
		// transliterate
		$string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
		// remove unwanted characters
		$string = preg_replace('~[^-\w]+~', '', $string);
		// trim
		$string = trim($string, '-');
		// remove duplicate -
		$string = preg_replace('~-+~', '-', $string);
		// lowercase
		$string = strtolower($string);
		return $string;
	}
#show image header	
	function showImage($img){
		return 'http://ferdynosopian.local/images/'.$img;
	}
#show image user	
	function showImageUser($userImg){
		return 'http://ferdynosopian.local/admin/user/images/'.$userImg;
	}
#lokasi image user	
	function folderImageUser($nameImg){
		$root =  $_SERVER['DOCUMENT_ROOT'];
		return $root.'/admin/user/images/'.$nameImg;
	}
#random name
	function random_string($length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }
	    return $key;
	}
?>
