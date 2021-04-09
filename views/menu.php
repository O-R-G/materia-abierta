<?
if($es)
    $language_id = end($oo->urls_to_ids(array('es')));
else
    $language_id = end($oo->urls_to_ids(array('en')));
$children = $oo->children($language_id);

?>
<div id='home'><a href="/">Materia Abierta</a></div>
<div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>

<ul class="nav-level">
    <? foreach($children as $child){
        if(substr($child['name1'], 0, 1) !== '.'){
            ?><li><a href="#<?= $child['url']; ?>-block"><?= $child['name1']; ?></a></li><?
        }
    } ?>
</ul>
</div>    
<div id='xx' class='<?= ($body) ? "" : "hidden"; ?>'>
    <a><img src='/media/svg/hamburger-6-w.svg'></a>
</div>


