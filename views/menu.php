<?
$children = $oo->children($uu->id);
// make back url
$url = "";
$back_urls = array_slice($uu->urls, 0, count($uu->urls) - 1);
$count = count($back_urls);
// exhibitions exception 
if ($back_urls[$count-2] == "exhibitions") {
    // jump back 2 levels
    $menu = "Exhibitions";
    for ($i = 0; $i < count($back_urls) - 1; $i++) 
        $url .= "/" . $back_urls[$i];
} else if ($back_urls[$count-3] == "exhibitions") {
    // display exhibition name, not url
    $menu = $oo->get($oo->ancestors($uu->id)[3])['name1'];
    $url = "/".implode("/", $back_urls);
} else {
    $menu = ucwords(str_ireplace("-", " ", $back_urls[$count-1]));
    $url = "/".implode("/", $back_urls);
}
?><div id="back">
    <a href="<? echo $url; ?>"><? echo nl2br($menu); ?></a>
</div>

