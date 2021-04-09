<?

if($es)
	$language_id = end($oo->urls_to_ids(array('es')));
else
	$language_id = end($oo->urls_to_ids(array('en')));
$children = $oo->children($language_id);
$media_arr = array();
foreach($children as $child){
	if(substr($child['name1'], 0, 1) !== '.'){
		$media = $oo->media($child['id']);
		foreach($media as $m)
			$media_arr[] = $m;
	}
}
$column_left_number = round(count($media_arr)/2);
$column_right_number = count($media_arr) - $column_left_number;
$media_count_begin = array(0, $column_left_number);
$media_count_end = array($column_left_number, count($media_arr));
$media_props = array();

$video_formats = array('mp4', 'mov', 'wmv');

function print_thumb_ctner($idx){
	global $media_count_begin;
	global $media_count_end;
	global $media_arr;
	global $video_formats;

	?><aside class="thumb_ctner <?= $idx == 0 ? 'left' : 'right'; ?>">
	<? for($i = $media_count_begin[$idx] ; $i < $media_count_end[$idx] ; $i++){
		$m = $media_arr[$i];
		$url = m_url($m);
        $caption = wysiwygClean($m['caption']);
        if(strpos($caption, '///')!==false)
        {
        	$caption = substr( $caption, 0, strpos($caption, '///'));
        }
        if(in_array($m['type'], $video_formats)){
        	$media_props[] = false;
        	$media_html = '<video class="thumbnail-video" controls><source src = "' . $url . '" type="video/' . $m['type'] . '">' . $caption . "</video>";
        }
        else
        {
        	$relative_url = "media/" . m_pad($m['id']).".".$m['type'];
            $size = getimagesize($relative_url);
            $media_props[] = $size[0] / $size[1];
            $media_html = '<img class="thumbnail" src="' .  $url . '" alt="' . $caption . '">';
        }
        ?>
			<div class="thumb">
                <div class="img-container">
                    <div class="square">
                        <div class="controls next white"><img src = "/media/svg/arrow-forward-6-w.svg"></div>
                        <div class="controls prev white"><img src = "/media/svg/arrow-back-6-w.svg"></div>
                        <div class="controls close white"><img src = "/media/svg/x-6-w.svg"></div>
                    </div>
                    <?= $media_html; ?>
                </div>

                <div class="caption">
                	<? if( in_array($m['type'], $video_formats)){
                		?><video class='thumbnail-video' controls><source src = "<?= $url; ?>" type="video/<?= $m['type']; ?>"><?= $caption; ?></video><?
                	}else{
                		?><img class='thumbnail' src="<?= $url; ?>" alt="<?= $caption; ?>"><?
                	} ?>
                	<br><div class="<?= $includeCaption ? 'color-effect-container' : '';?>">> <? wrap_span($caption); ?></div>
                </div>
            </div>
            <?
		} ?>
	</aside><?
}


?>
<section id="main" class="container color-effect-container">
	<? foreach($children as $child){
		if(substr($child['name1'], 0, 1) !== '.'){
			$this_title = wysiwygClean($child['name1']);
			$this_body = wysiwygClean($child['body']);
			$media = $oo->media($child['id']);
			foreach($media as $m)
				$media_arr[] = $m;
		?>
		<div id="<?= $child['url']; ?>-block" class="block">
			<h2 class="block-title" ><? wrap_span($this_title); ?></h2>
			<div class="block-body"><? wrap_span($this_body); ?></div>
		</div>
		<?
		}
	} ?>
</section>
<?
print_thumb_ctner(0);
print_thumb_ctner(1);
?>
<script>
// pass to gallery.js for setting wide or tall css class
var proportions = <? echo json_encode($media_props); ?>;
</script>
<script type="text/javascript" src="/static/js/screenfull.js"></script>
<script type="text/javascript" src="/static/js/gallery.js"></script>