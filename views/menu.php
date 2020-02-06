<?
// if /en or /es then dont show
if ($uri[2]) {
    $name = $item['name1'];
    $url = $item['url'];
    $url_back = array_slice($uu->urls, 0, count($uu->urls) - 1);    
    ?><div id="back">
        <!-- <a href="<? echo $url_back; ?>"><? echo nl2br($name); ?></a> -->
        <? echo nl2br($name); ?>
    </div><?    
}

