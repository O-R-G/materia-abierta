<?
$children = $oo->children($item['id']);

$gallery_id = end($oo->urls_to_ids(array('gallery')));
$gallery_groups = $oo->children($gallery_id);
shuffle($gallery_groups);

$color_arr = array();
$bracket_pattern = '#\[(.*?)\]#is';
foreach($gallery_groups as $key => $group){
	if(substr($group['name1'], 0, 1) != '.' )
	{
		preg_match_all($bracket_pattern, $group['notes'], $color_arr_temp);
		$color_arr[] = $color_arr_temp[1];
	}
}

    ?><div id="cv" class="clear" background_version='<?= $background_version; ?>'>
    	<?
        foreach($children as $key => $child){
    		$this_title = $child['name1'];
        	$this_body = $child['body'];
        	$this_id = $child['url'];
        	
			$text_color = empty($color_arr[$key][0]) ? '#000' : $color_arr[$key][0];
			
        	?><div id="<?= $this_id; ?>" class="block" style="color: <?= $text_color; ?>;">
        		<? if($key != 0){
        			?><h1 class="block-title"><?= $this_title; ?></h1><br><?
        		} ?>
        		<div class="block-body"><?= $this_body; ?></div></div>
  			<?
        }
        ?><div id="gallery-container"><?
	    foreach($gallery_groups as $key => $group)
	    {
	    	$background_color = empty($color_arr[$key][1]) ? 'transparent' : $color_arr[$key][1] . ' 50%';
			$background_image = 'linear-gradient(';
			if($key != 0)
			{
				$prev_background_color = empty($color_arr[$key-1][1]) ? 'transparent' : $color_arr[$key-1][1];
				$background_color = $prev_background_color . ' -50%, '.$background_color;
			}
			if( $key != count($children)-1)
			{
				$next_background_color = empty($color_arr[$key+1][1]) ? 'transparent' : $color_arr[$key+1][1];
				$background_color = $background_color . ', ' . $next_background_color . ' 150%';
			}
			$background_image .= $background_color . ')';
	    	$media = $oo->media($group['id']);
	    	?><div class="gallery-group" style="background-image: <?= $background_image; ?>;"><?
	    	for($i = 0 ; $i < 2 ; $i++){
				?><div class = "thumb_ctner <?= $i == 0 ? 'left' : 'right'; ?>"><?
					$max = ($max) ? count($media) - $max : round(count($media)/2);
		            for($j = $counter; $j < $max + $counter; $j++){
		                $m = $media[$j];
		                if(isset($m)){
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
			                    <!-- <div class="caption">> <? echo $caption; ?></div> -->
			                </div><?
		                }
				    }
			    $counter = $j;
		        ?></div><?
			}
			$counter = 0;
			unset($max);
			?></div><?
	    }
	    ?></div></div>

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
?>
<script type = "text/javascript" src = "/static/js/menu.js"></script>

