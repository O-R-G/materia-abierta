<?

$children = $oo->children($item['id']);



// if ($body) {
    ?><div id="cv" class="clear"><?
        foreach($children as $key => $child){
        	$this_title = $child['name1'];
        	$this_body = $child['body'];
        	$this_id = $child['url'];
        	$bracket_pattern = '#\[(.*?)\]#is';
			preg_match_all($bracket_pattern, $child['notes'], $color_arr);
			$text_color = empty($color_arr[1][0]) ? '#000' : $color_arr[1][0];
			$background_color = empty($color_arr[1][1]) ? 'transparent' : $color_arr[1][1];
        	?><div id="<?= $this_id; ?>" class="block" style="background-color: <?= $background_color; ?>; color: <?= $text_color; ?>;">
        		<? if($key != 0){
        			?><h1 class="block-title"><?= $this_title; ?></h1><br><?
        		} ?>
        		<div class="block-body"><?= $this_body; ?></div>
  			<?
    		$counter = 0;
    		$media = $oo->media($child['id']);
    		if(count($media) > 0)
    		{
    			for($i = 0 ; $i < 2 ; $i++){
    			?><div class = "thumb_ctner <?= $i == 0 ? 'left' : 'right'; ?>"><?
	    			$max = ($max) ? count($media) - $max : round(count($media)/2);
		            for($j = $counter; $j < $max + $counter; $j++){
		                $m = $media[$j];
		                $url = m_url($m);
		                $caption = $m['caption'];
		                $media_urls[] = $url;
		                $media_captions[] = $caption;
		                $relative_url = "media/" . m_pad($m['id']).".".$m['type'];
		                $size = getimagesize($relative_url);
		                $media_props[] = $size[0] / $size[1];
		                ?><div class="thumb">
		                    <div class="img-container">
		                        <div class="square">
		                            <div class="controls next white"><img src = "/media/svg/arrow-forward-6-w.svg"></div>
		                            <div class="controls prev white"><img src = "/media/svg/arrow-back-6-w.svg"></div>
		                            <div class="controls close white"><img src = "/media/svg/x-6-w.svg"></div>
		                        </div>
		                        <img src="<?= $url; ?>" alt="<?= $caption; ?>">
		                    </div>
		                    <div class="thumbnail"><img src="<?= $url; ?>" alt="<?= $caption; ?>"></div>
		                    <div class="caption">> <? echo $caption; ?></div>
		                </div><?
				    }
			    $counter = $j;
	            ?></div><?
	    		}
    		}
    		?></div><?
        }
	?></div>

    <div id='selected' class='menu_btn'><?
        // $selected = [];                         // build selected from url
        // $ids = $oo->urls_to_ids($uu->urls);     // get ids
        // foreach($ids as $i)                     // get objects
            // $selected[] = $oo->get($i);
        // array_shift($selected);                 // prune _es, _en
        // var_dump($selected);
        // foreach ($selected as $s) {
        //     ?><div class='static_'><?= $s['name1']; ?></div><?
        // }
    	?><div class='static_'><a href=""><?= $children[0]['name1']; ?></a></div><?
    ?></div>
        
    <script>
    // pass to gallery.js for setting wide or tall css class
    var proportions = <? echo json_encode($media_props); ?>;
    </script>
    <script type="text/javascript" src="/static/js/screenfull.js"></script>
    <script type="text/javascript" src="/static/js/gallery.js"></script><?
// }
?>
<script type = "text/javascript" src = "/static/js/menu.js"></script>

