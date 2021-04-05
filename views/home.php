<?

$isEspanol = ($uri[1] == 'es');
if($isEspanol)
	$language_id = end($oo->urls_to_ids(array('es')));
else
	$language_id = end($oo->urls_to_ids(array('en')));
$children = $oo->children($language_id);
?>
<section id="main" class="main-container">
	<? foreach($children as $child){
		if(substr($child['name1'], 0, 1) !== '.'){
			$this_title = $child['name1'];
			$this_body = $child['body'];
		?>
		<div id="<?= $child['url']; ?>-block"class="block">
			<h2 class="block-title"><?= $this_title; ?></h2>
			<div class="block-body"><?= $this_body; ?></div>
		</div>
		<?
		}
	} ?>
</section>