<?
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
$en = isset($_GET['en']);
$es = isset($_GET['es']);
if (!$en && !$es)
	$es = true;

require_once('views/head.php');
require_once('views/menu.php');
require_once('views/home.php');
require_once('views/language.php');
require_once('views/clock.php');
require_once('views/foot.php');
?>
