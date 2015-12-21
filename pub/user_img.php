<?
header('Content-type: image/png');
$image = (isset($_GET["image"])) ? $_GET["image"] : 0;
$size = (isset($_GET["size"])) ? $_GET["size"] : '';

if($size == 'small'){

	$file = "../store/user_img/" . $image . "-small.png";
	
	if(!file_exists($file)) {
	
		readfile("../store/user_img/icon-user-blank-small.png");
	
	} else {
	
		readfile($file);
	
	}
	
}else{
	
	$file = "../store/user_img/" . $image . ".png";

	if(!file_exists($file)) {
	
		readfile("../store/user_img/icon-user-blank.png");
	
	} else {
	
		readfile($file);
	
	}
	
}
?>