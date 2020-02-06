<?
$uri = explode('/', trim($_SERVER['REQUEST_URI'], "/"));

// only html head -- no content
require_once('views/head.php');

// splash page
if (empty($uri[0]))
	require_once("views/children-splash.php");
else if ($uri[0] == "options")
    require_once("views/options.php");

// everything else
else {
	// single exhibition page
	if (($uri[1] == 'now' || $uri[1] == 'then') && count($uri) > 3)
		require_once("views/main.php");
	else {
		if($uri[1] == "collapse" && count($uri) == 2)
 		    require_once("views/children-one-column-collapse.php");
        // ** fix ** already handled in o-r-g
		elseif ($uri[2] == "contact" && count($uri) == 3)
		    require_once("views/contact.php");
		elseif (count($uri) == 1)
		    require_once("views/children-one-column.php");
		else
		    require_once("views/children.php");
	}
	
	// top menu
	require_once("views/menu.php");
}

if ($uri[0])
    // hide clock on home
    require_once("views/clock.php");

// close body, close html
require_once('views/foot.php');
?>
