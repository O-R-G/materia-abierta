<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/
$body = $item['body'];  // hide/show

$nav_nest = nav_nest($oo, $uu->ids);

// 3/23 
// nav_pre = every item appears above $kids in the menu, 
// including the current level.
$nav_pre = $nav_nest[0];
// 3/23 
// nav = $kids
$nav = $nav_nest[1];
// 3/23
// nav_pre = every item appears below $kids in the menu, 
$nav_post = $nav_nest[2];




if($uu->id) { 
    ?><div id='home'><a href="/">Materia Abierta</a></div><?
}
?><div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>

    <ul class="nav-level"><?
        $prevd = $nav[0]['depth'];
        foreach($nav_pre as $np) {
            $d = $np['depth'];
            if($d > $prevd){
                ?><ul class="nav-level"><?
            }
            if(substr($np['o']['name1'],0,1) != '_') {
                ?><li><?
                    if($np['o']['id'] != $uu->id) {
                        if($isHome)
                            $url = '/' . $np["url"];
                        else
                            $url = '#' . $np["url"];
                        if(array_search($np['o']['id'], $uu->ids)){
                            
                            ?><a class='active menu_ancestor' href='<?= $url; ?>'><?= $np['o']['name1']; ?></a><?
                        } else {
                            ?><a class='active' href='<?= $url; ?>'><?= $np['o']['name1']; ?></a><?
                        }
                    } else {
                        ?><span class='static'><?= $np['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
            $prevd = $d;
        }?>
        <ul id = 'menu_next' class = "nav-level">
        <?
        foreach ($nav as $n) {
            if(substr($n['o']['name1'],0,1) != '_') {
                ?><li><?
                    if($isHome)
                        $url = '/' . $n["url"];
                    else
                        $url = '#' . $n['o']['url'];
                    if($n['o']['id'] != $uu->id) {
                        ?><a class='active' href='<?= $url; ?>'><?= $n['o']['name1']; ?></a><?
                    } else {
                        ?><span class='static'><?= $n['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
        }
        ?>
        </ul>
        <?
        foreach($nav_post as $np) {
            $d = $np['depth'];
            if($d < $prevd){
                ?></ul><?
            }
            if(substr($np['o']['name1'],0,1) != '_') {
                ?><li><?
                    if($np['o']['id'] != $uu->id) {
                        ?><a class='active' href='<?= '/' . $np["url"]; ?>'><?= $np['o']['name1']; ?></a><?
                    } else {
                        ?><span class='static'><?= $np['o']['name1']; ?></span><?
                    }
                ?></li><?
            }
            $prevd = $d;
        }?>
    </ul>
</div>
<!--
always hide the hamburger for now 

<div id='xx' class='<?= ($body) ? "" : "hidden"; ?>'>
    <a><img src='/media/svg/hamburger-6-w.svg'></a>
</div>
-->
<div id='xx' class='hidden'>
    <a><img src='/media/svg/hamburger-6-w.svg'></a>
</div>


