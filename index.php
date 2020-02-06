<?
$uri = explode('/', trim($_SERVER['REQUEST_URI'], "/"));

require_once('views/head.php');
require_once('views/children.php');
if ($uri[0] == "es" || !$uri[0])
	require_once("views/home.php");
else {
    require_once("views/main.php");
	require_once("views/menu.php");
}
if ($uri[0])
    require_once("views/clock.php");
require_once('views/language.php');
require_once('views/foot.php');
?>
