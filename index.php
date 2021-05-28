<?
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
$background_version = isset($_GET['background_version']) ? $_GET['background_version'] : '0';

require_once('views/head.php');

if(!$uri[1])
	require_once('views/home.php');
elseif($uri[1] == 'getImageColor')
	require_once('views/getImageColor.php');
elseif($background_version == 2)
{
	require_once('views/menu.php');
	require_once('views/main-2.php');
}
elseif($background_version == 3)
{
	require_once('views/menu.php');
	require_once('views/main-3.php');
}
else
{
	require_once('views/menu.php');
	require_once('views/main.php');
}
	
require_once('views/language.php');
// require_once('views/clock.php');
require_once('views/foot.php');
?>
