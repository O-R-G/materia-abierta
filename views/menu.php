<?
$nav = $oo->nav($uu->ids);
$selected = [];
if($uu->id)
	?><div id='home'>
		<a href="/">Materia Abierta</a>
	</div><?
?><div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>
        <div class="nav-level"><?
		$prevd = $nav[0]['depth'];
		foreach($nav as $n) {
		        $d = $n['depth'];
			if($d > $prevd) {
				if ($skipped && $uri[2] != null)
					$selected[] = $n;
	        	}
        		?><div><?
				if (substr($n['o']['name1'],0,1) != '_') {
	                		if($n['o']['id'] != $uu->id) {
						if ($n['o']['name1'] != $selected[0]['name1']) {
					     		?><a class='active' href='<?= '/' . $n["url"]; ?>'><?= $n['o']['name1']; ?></a><?
						}
	        		        } else if (!$skipped) {
						// $selected[] = $n['o'];
						$selected[] = $n;
					}
					$skipped = false;
				}
				else
					$skipped = true;
        		?></div><?
        		$prevd = $d;
		}
	?></div>
</div><?
?><div id='dropdown' class='menu_btn'><?
	foreach ($selected as $s) {
		?><div><a href='/<?= $s['url']; ?>' class='selected'><?= $s['o']['name1']; ?></a></div><?
	}
?></div><?
?><script type = "text/javascript" src = "/static/js/menu.js"></script>

