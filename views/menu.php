<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/
$body = $item['body'];  // hide/show
$nav = $oo->nav($uu->ids);
// $traverse = $oo->traverse($item);
// $nav = $oo->nav_full($traverse);

if($uu->id) { 
    ?><div id='home'><a href="/">Materia Abierta</a></div><?
}
?><div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>
    <ul class="nav-level"><?
        $prevd = $nav[0]['depth'];
        foreach($nav as $n) {
            $d = $n['depth'];
            if($d > $prevd){
                ?><ul class="nav-level"><?
            }
            if(substr($n['o']['name1'],0,1) != '_') {
                ?><li><?
                    if($n['o']['id'] != $uu->id) {
                        ?><a class='active' href='<?= '/' . $n["url"]; ?>'><?= $n['o']['name1']; ?></a><?
                    } else {
                        ?><span class='static'><?= $n['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
            $prevd = $d;
        }
        ?></ul>
    </ul>
</div>    
<div id='xx' class='<?= ($body) ? "" : "hidden"; ?>'>
    <a><img src='/media/svg/hamburger-6-w.svg'></a>
</div>


