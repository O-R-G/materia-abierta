<?
function set_cookie($name=null, $value=null, $expires=null, $path="/")
{
	if(!empty($value))
	{
		setcookie($name, $value, $expires, $path);
	}
}

function get_cookie($name)
{
	if(isset($_COOKIE[$name]))
		return $_COOKIE[$name];
	else
		return null;
}


function nav_nest($oo, $ids, $root=0)
{
	$nav = array();
	$pass = true;
	
	$top = $oo->children_ids_nav($root);
	$root_index = array_search($root, $ids);
	if($root_index === FALSE)
		$root_index = 0;
	else
		$root_index++;
	
	// every item that locates before kids, including the current page;
	$nav_preThis = array();

	// every item after kids;
	$nav_postThis = array();

	foreach($top as $t)
	{	
		$o = $oo->get($t);
		$d = $root+1;
		$urls = array($o['url']);
		$url = implode("/", $urls);			
		$nav[] = array('depth'=>$d, 'o'=>$o, 'url'=>$url);
		
		if($pass && $t == $ids[$root_index])
		{
			$pass = false; // short-circuit if statement

			$kids = $oo->children_ids_nav(end($ids));
			if(empty($kids) && count($ids) > 1)
			{
				$kids = $oo->children_ids_nav($ids[count($ids)-2]);
				array_pop($ids); // leaf is included in siblings
			}
			for($i = 0 ; $i < count($ids)-1 ; $i++){
				// Starting from _en, _es;
				// count-1 is because there's kids;
				// when i = 0, d = 2;
				$thisRoot_url = implode("/", $urls);
				$d++;
				
				// getting all the children;
				$thisChildren = $oo->children_ids_nav($ids[$i]);

				// The child that is viewed;
				$theRightChild = $ids[$i+1];
				$isPre = true;
				foreach ($thisChildren as $key => $tc) {
					$o = $oo->get($tc);
					if($tc == $theRightChild){
						$urls[] = $o['url'];
						$url = implode("/", $urls);
						array_push($nav_preThis, array('depth'=>$d, 'o'=>$o, 'url'=>$url));
						$isPre = false;
					}else if($isPre){
						$url = $thisRoot_url.$o['url'];
						array_push($nav_preThis, array('depth'=>$d, 'o'=>$o, 'url'=>$url));
					}else{
						$url = $thisRoot_url.$o['url'];
						array_unshift($nav_postThis, array('depth'=>$d, 'o'=>$o, 'url'=>$url));
					}
				}
			}

			$d++;
			foreach($kids as $k)
			{	
				$o = $oo->get($k);
				$urls[] = $o['url'];
				$url = implode("/", $urls);
				$nav[] = array('depth'=>$d, 'o'=>$o, 'url'=>$url);
				array_pop($urls);
			}
		}
	}
	return array($nav_preThis, $nav, $nav_postThis);
}
?>