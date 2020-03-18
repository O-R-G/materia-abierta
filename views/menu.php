<?
// if /en or /es then dont show

$item = $oo->get($uu->id);
// var_dump($uu->id);
var_dump($item['id']);
var_dump($item['name1']);
// $nav = $oo->nav($uu->ids, $item['id']);
// $nav = $oo->nav($uu->ids, 36);
$nav = $oo->nav($uu->ids);

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
			        ?></ul><ul class="nav-level"><?
        		}
        		?><div><?
				if (substr($n['o']['name1'],0,1) != '_') {
	                		if($n['o']['id'] != $uu->id) {
					     	?><a class='active' href='<?= $host.$n["url"]; ?>'><?= $n['o']['name1']; ?></a><?
	        		        } else {
						$selected = $n['o']['name1'];
						?><span class='selected'><?= $selected; ?></span><?
	                		}
				}
        		?></div><?
        		$prevd = $d;
		}
	?></div>
</div><?

// clean up these two divs below into one ** fix **

?>
<div id='dropdown' class=''>
	<div id="menu_current" class="menu_btn">
		<span class='selected'><?= $selected; ?></span>
	</div>
</div>

<script type = "text/javascript" src = "/static/js/menu.js"></script>

