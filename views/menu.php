<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/
// $body = $item['body'];  // hide/show

// $nav_nest = nav_nest($oo, $uu->ids);
$lang = isset($_GET['en']) ? 'en' : 'es';
$lang_id = end($oo->urls_to_ids(array($lang)));
$children = $oo->children($lang_id);
// $children = $oo->children($item['id']);

?><div id='home'><a target='_self' href="/">Materia Abierta</a></div>
<div id='menu' class='centered centeralign <?= ($body) ? "hidden" : ""; ?>'>

    <ul class="nav-level"><?
        $prevd = $nav[0]['depth'];
        foreach($children as $key => $child) {
            if( substr($child['name1'],0,1) != '_' && 
                substr($child['name1'],0,1) != '.' &&
                $key != 0 )
            {
                $item_url = $child['url'];
                $item_name = $child['name1'];
                ?><li><a class='menu-btn' target='_self' href='#<?= $item_url; ?>'><?= $item_name; ?></a></li><?
            }
        }?>
    </ul>
</div>
<div id='xx' class='hidden'>
    <a><img src='/media/svg/hamburger-6-w.svg'></a>
</div>


