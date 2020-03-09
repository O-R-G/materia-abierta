<?
// if /en or /es then dont show
if (count($uri) > 1) {
	// After clicking "Materia Abeirta"
	// the "home" button
	$home = 'Materia Abierta';
	?><div id='home'>
    	<a href = '/'>
        	<!-- <a href="<? echo $url_back; ?>"><? echo nl2br($name); ?></a> -->
        	<? echo nl2br($home); ?>
        </a>
    </div>
    <?
    if(count($uri) > 2){
    	// After entering either "the end of time" or "no future"
    	// the menu
    	$name = $item['name1'];
    	$url = $item['url'];
	    $url_back = array_slice($uu->urls, 0, count($uu->urls) - 1); 
	    $url_back_string = implode('/',$url_back);

    	$ancestors_id = $oo -> ancestors($uu->id);
    	foreach($ancestors_id as &$si)
				$si = intval($si);
		$ancestors_name = $oo -> ids_to_names($ancestors_id);
		array_shift($ancestors_name);

		$siblings_id = $oo -> siblings($uu->id);
		$siblings_id = array_values($siblings_id);
		$siblings_url = $oo -> ids_to_urls($siblings_id);
		foreach($siblings_id as &$si)
			$si = intval($si);
		$siblings_name = $oo -> ids_to_names($siblings_id);
		foreach($siblings_url as &$su)
    		$su = '/'.$url_back_string.'/'.$su;
    ?>
    <div id = 'dropdown'>
    	<?
		foreach ($ancestors_name as $key => $val) {
			?>
			<div id = '' class = 'menu_ancestor menu_btn'>
				<span><? echo $val;  ?></span>
			</div>
			<?
		}
    	?>
		<div id = 'menu_current' class = 'menu_btn'>
    		<span><? echo $name; ?></span>
		</div>
		<? foreach($siblings_name as $key => $val){?>
			<div class = 'menu_sibling'><a href = '<? echo $siblings_url[$key]; ?>'><? echo $val; ?></a></div>
		<? } ?>

	</div>
	<div id = "menu_xx"><a><img src='/media/svg/x-6-k.svg'></a></div>
	<script type = "text/javascript" src = "/static/js/menu.js"></script>
	<?
    }
} ?>
