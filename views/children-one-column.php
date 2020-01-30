<?
$children = $oo->children($uu->id);
?><div id="children" class="centered centeralign"><?
	foreach($children as $c)
	{
		$url = $uu->url."/".$c['url'];
		$tmp = trim(strip_tags($c['name1'], '<i><b>'));
		$name = nl2br($tmp);
		if($tmp == $name)
		{
		?><div><a href="<? echo $url; ?>"><? echo $name; ?></a></div><?
		}
		else
		{
		?><div><p><a href="<? echo $url; ?>"><? echo $name; ?></a></p></div><?
		}
	}
?></div>
