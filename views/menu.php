<?
/*
    simple menu
    adapted from http://www.o-r-g.com
*/
// $body = $item['body'];  // hide/show

// $nav_nest = nav_nest($oo, $uu->ids);
$lang = isset($_GET['en']) ? 'en' : 'es';
$temp = $oo->urls_to_ids(array($lang));
$lang_id = end($temp);
$children = $oo->children($lang_id);
// $children = $oo->children($item['id']);

?><div id='home'><a target='_self' href="/">Materia Abierta</a></div>
