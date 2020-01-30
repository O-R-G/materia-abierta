<?
$uri = explode('/', trim($_SERVER['REQUEST_URI'], "/"));

// only html head -- no content
require_once('views/head.php');

// splash page
if(empty($uri[0]))
{
	require_once("views/children-splash.php");
}
else if ($uri[0] == "options")
{
    require_once("views/options.php");
}
// everything else
else
{
	// single exhibition page
	if($uri[1] == "now" && count($uri) > 3)
		require_once("views/main.php");
	elseif($uri[1] == "then" && count($uri) > 2)
		require_once("views/main.php");
	else
	{
		if($uri[1] == "exhibitions" && count($uri) == 2)
 		    require_once("views/children-one-column-collapse.php");
		elseif($uri[1] == "contact" && count($uri) == 2)
		    require_once("views/contact.php");
		elseif($uri[2] == "privacy" && count($uri) == 3)
		    require_once("views/privacy.php");
		elseif(count($uri) == 1)
		    require_once("views/children-one-column.php");
		else
		    require_once("views/children.php");
	}
	
	// bottom menu
	require_once("views/menu.php");
}

require_once("views/clock.php");

// close body, close html
require_once('views/foot.php');
?>
