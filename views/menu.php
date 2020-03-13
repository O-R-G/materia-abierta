<br>** fede, this is a work-in-progress! **
<?
// if /en or /es then dont show

$nav = $oo->nav($uu->ids);
?><ul id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>
	<li><?
		if($uu->id) {
			?><a href='/'>Materia Abierta</a><?
		}
        ?></li>
        <ul class="nav-level"><?
		$prevd = $nav[0]['depth'];
		foreach($nav as $n) {
		        $d = $n['depth'];
		        if($d > $prevd) {
			        ?></ul><ul class="nav-level"><?
        		}
        		?><li><?
				if (substr($n['o']['name1'],0,1) != '_') {
	                		if($n['o']['id'] != $uu->id) {
					     	?><a href='<?= $host.$n["url"]; ?>'><?= $n['o']['name1']; ?></a><?
	        		        } else {
		                		?><span><?= $n['o']['name1']; ?></span><?
	                		}
				}
        		?></li><?
        		$prevd = $d;
		}
	?></ul>
</ul>
<script type = "text/javascript" src = "/static/js/menu.js"></script><?

