<?
header('Content-type: image/png');
$image = (isset($_GET["image"])) ? $_GET["image"] : 0;

$file = "../store/demandgen_images/" . $image . ".png";

if(!file_exists($file)) {

	$file = "img/hosted/blank.png";

}

readfile($file);

?>