<?
header('Content-type: image/png');
$image = (isset($_GET["image"])) ? $_GET["image"] : 0;

$file = "../store/resource_img/" . $image . ".png";

if(!file_exists($file)) {

	readfile("../store/resource_img/blank.png");

} else {

	readfile($file);

}
?>