<?php

function shortContent($string, $judul){

	$string = strip_tags($string);





	if (strlen($string)  > 300){

		$string = substr($string, 0, 300).'.....<br><br><center><a href="kabar-terbaru/'.$judul.'">Read More</a></center>';





	}

	return $string;

}



function shortContent2($string){

	$string = strip_tags($string);





	if (strlen($string)  > 200){

		$string = substr($string, 0, 200).'...';





	}

	return $string;

}





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

function showImage($img){



	return 'http://ferdynosopian.local/images/'.$img;



}

function showImageUser($userImg){
	return 'http://ferdynosopian.local/admin/user/images/'.$userImg.'';
}

?>

