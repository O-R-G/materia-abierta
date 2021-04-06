<?

$isEspanol = ($uri[1] == 'es');
if($isEspanol)
	$language_id = end($oo->urls_to_ids(array('temp', 'es')));
else
	$language_id = end($oo->urls_to_ids(array('temp', 'en')));
$children = $oo->children($language_id);
$media_arr = array();
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
$column_left_number = round(count($media_arr)/2);
$column_right_number = count($media_arr) - $column_left_number;
$media_count_begin = array(0, $column_left_number);
$media_count_end = array($column_left_number, count($media_arr));

$media_props = array();

for($i = 0 ; $i < 2 ; $i++){
	?><div class="thumb_ctner <?= $i == 0 ? 'left' : 'right'; ?>">
		<? for($j = $media_count_begin[$i] ; $j < $media_count_end[$i] ; $j++){
			$m = $media_arr[$j];
			$url = m_url($m);
            $caption = wysiwygClean($m['caption']);
            $relative_url = "media/" . m_pad($m['id']).".".$m['type'];
            $size = getimagesize($relative_url);
            $media_props[] = $size[0] / $size[1];
			?>
			<div class="thumb">
                <div class="img-container">
                    <div class="square">
                        <div class="controls next white"><img src = "/media/svg/arrow-forward-6-w.svg"></div>
                        <div class="controls prev white"><img src = "/media/svg/arrow-back-6-w.svg"></div>
                        <div class="controls close white"><img src = "/media/svg/x-6-w.svg"></div>
                    </div>
                    <img src="<?= $url; ?>">
                </div>

                <div class="caption">
                	<img class='thumbnail'src="<?= $url; ?>">
                	<br><div class="<?= $includeCaption ? 'color-effect-container' : '';?>">> <? wrap_span($caption); ?></div>
                </div>
            </div>
            <?
		} ?>
	</div><?
}
?>
<script>
// pass to gallery.js for setting wide or tall css class
var proportions = <? echo json_encode($media_props); ?>;
</script>
<script type="text/javascript" src="/static/js/screenfull.js"></script>
<script type="text/javascript" src="/static/js/gallery.js"></script>