<?
$children = $oo->children($uu->id);
?><div id="exhibition-list"><?
	foreach($children as $c)
	{
        $url = $uu->url."/".$c['url'];
		$tmp = trim(strip_tags($c['name1'], '<i><b>'));
		$name = nl2br($tmp);
		$grandchildren = $oo->children($c['id']);
		?><section class="exhibition-year">
		    <header><? echo $name; ?></header><?
		    foreach($grandchildren as $gc)
		    {
		        $tmp = trim(strip_tags($gc['name1'], '<i><b><br></br>'));
  		        $name = nl2br($tmp);
                if (substr($name, 0, 1) == ":") 
                    $u = null;
                else 
    		        $u = $url."/".$gc['url'];
                $name = ltrim($name, ":");
                ?><div class="exhibition exhibition-name"><?
                    echo ($u) ? "<a href='" . $u . "'>" . $name . "</a>" : $name; 
                ?></div><?
		    }
		?></section><?
	}
?></div>


