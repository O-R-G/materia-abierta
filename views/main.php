<?
$media = $oo->media($uu->id);
$media_captions = array();
$media_props = array();
$body = $item['body'];
$children = $oo->children($uu->id);

if ($body) {

    // show page

    ?><section id="artist-detail">
    <!-- <header id="artist-name" class="centeralign"><? echo nl2br(trim($item['name1'])); ?></header> -->
    <figure id="children" class="centered"></figure><?
    ?></section>
    <div id="cv" class="clear"><?
        echo nl2br($body);
	$counter = 0;
        for($i = 0 ; $i < 2 ; $i++){
		// if odd number of items, then more in left column (round())
		$items = ($items) ? count($media) - $items : round(count($media)/2);
	        ?><div class = "thumb_ctner"><?
	            for($j = $counter; $j < $items + $counter; $j++){
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
	                        <img src="<?= $url; ?>">
	                    </div>
	                    <div class="caption">> <? echo $caption; ?></div>
	                </div><?
		    }
	    $counter = $j;
            ?></div><? 
	}
        ?></div>
    <div id='xx'>
        <a href='<?= $url_back; ?>'><img src='/media/svg/x-6-w.svg'></a>
    </div>
    <script>
    // pass to gallery.js for setting wide or tall css class
    var proportions = <? echo json_encode($media_props); ?>;
    </script>
    <script type="text/javascript" src="/static/js/screenfull.js"></script>
    <script type="text/javascript" src="/static/js/gallery.js"></script><?

} else {

    // show children

    ?><div id="children" class="centered centeralign"><?
        foreach($children as $c) {
            $url = $uu->url."/".$c['url'];
            $tmp = trim(strip_tags($c['name1'], '<i><b>'));
            $name = nl2br($tmp);
            if($tmp == $name) {
                ?><div><a href="<? echo $url; ?>"><? echo $name; ?></a></div><?
            } else {
                ?><div><p><a href="<? echo $url; ?>"><? echo $name; ?></a></p></div><?
            }
        }
    ?></div><?
}
?>
