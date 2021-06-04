<?
$lang = $uri[1];
$children = $oo->children($item['id']);

$gallery_id = end($oo->urls_to_ids(array('gallery')));
$gallery_groups = $oo->children($gallery_id);
foreach($gallery_groups as $key => $group){
    if(substr($group['name1'], 0, 1) == '.' )
        unset($gallery_groups[$key]);
}
$gallery_groups = array_values($gallery_groups);
shuffle($gallery_groups);

$color_arr = array();
$bracket_pattern = '#\[(.*?)\]#is';
foreach($gallery_groups as $key => $group){
	preg_match_all($bracket_pattern, $group['notes'], $color_arr_temp);
	$color_arr[] = $color_arr_temp[1];
}     
    ?><div id='fullwindow'>
        <div id='x'><img src='/media/svg/x-6-k.svg'></div>
        <div id="next">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 150" style="enable-background:new 0 0 150 150;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:none;stroke:#000000;stroke-width:6;stroke-miterlimit:10;}
                </style>
                <polyline class="st0" points="80,115.3 120,75.1 80,35.1 "/>
                <line class="st0" x1="30.8" y1="75.1" x2="120" y2="75.1"/>
            </svg>
        </div>
        <div id="prev">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 150" style="enable-background:new 0 0 150 150;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:none;stroke:#000000;stroke-width:6;stroke-miterlimit:10;}
                </style>
                <polyline class="st0" points="70.8,35.1 30.8,75.1 70.8,115.3 "/>
                <line class="st0" x1="30.8" y1="75.1" x2="120" y2="75.1"/>
            </svg>
        </div>
    </div>
    <div id="cv" class="clear" background_version=<?= $background_version; ?>><?
        foreach($children as $key => $child){
                $this_title = $child['name1'];
                $this_body = $child['body'];
                if($key == 0){
                    $this_body = explode('///', $this_body);
                    $body0 = removeSpace($this_body[0]);
                    $this_body = $this_body[1];
                }
                $this_id = $child['url'];
                $text_color = empty($color_arr[$key][0]) ? '#000' : $color_arr[$key][0];
                $background_color = empty($color_arr[$key][1]) ? 'transparent' : $color_arr[$key][1];
                $background_color_temp = $background_color . ' 50%';
                $background_image = 'linear-gradient(';
                if($key != 0)
                {
                    $prev_background_color = empty($color_arr[$key-1][1]) ? 'transparent' : $color_arr[$key-1][1];
                    $background_color_temp = $prev_background_color . ' -50%, '.$background_color_temp;
                }
                if( $key != count($children)-1)
                {
                    $next_background_color = empty($color_arr[$key+1][1]) ? 'transparent' : $color_arr[$key+1][1];
                    $background_color_temp = $background_color_temp . ', ' . $next_background_color . ' 150%';
                }
                $background_image .= $background_color_temp . ')';

                
                ?><div id="<?= $this_id; ?>" class="block" bgColor = "<?= $background_color; ?>" style="background-image: <?= $background_image; ?>; color: <?= $text_color; ?>;">
                    <? 
                    if($key == 0){
                    ?><div class="block-body"><?= $body0; ?></div><br><?
                    }
                    ?><h1 class="block-title"><?= $this_title; ?></h1><br><div class="block-body"><?= $this_body; ?></div><?
                    ?>
                    
                <?
                $counter = 0;

                $media = $oo->media($gallery_groups[$key]['id']);
                $index_group = str_replace('group', '', $gallery_groups[$key]['name1']);
                if(count($media) > 0)
                {
                    for($i = 0 ; $i < 2 ; $i++){
                    ?><div class = "thumb_ctner <?= $i == 0 ? 'left' : 'right'; ?>"><?
                        $max = ($max) ? count($media) - $max : round(count($media)/2);
                        for($j = $counter; $j < $max + $counter; $j++){
                            $m = $media[$j];
                            if(isset($m)){
                                $url = m_url($m);
                                if($lang == 'es')
                                    $caption = explode('///', $m['caption'])[0];
                                else
                                    $caption = explode('///', $m['caption'])[1];
                                $media_urls[] = $url;
                                $media_captions[] = $caption;
                                $relative_url = "media/" . m_pad($m['id']).".".$m['type'];
                                $size = getimagesize($relative_url);
                                $media_props[] = $size[0] / $size[1];
                                $index = $index_group . '.'. ($j+1);
                                ?><div class="thumb">
                                    <div class="img-container">
                                        <div class="square">
                                            <div class="controls next white"><img src = "/media/svg/arrow-forward-6-w.svg"></div>
                                            <div class="controls prev white"><img src = "/media/svg/arrow-back-6-w.svg"></div>
                                            <div class="controls close white"><img src = "/media/svg/x-6-w.svg"></div>
                                        </div>
                                        <img src="<?= $url; ?>" alt="<?= $caption; ?>">
                                    </div>
                                    <div class="thumbnail"><img group="<?= $index_group; ?>" src="<?= $url; ?>" alt="<?= $caption; ?>"><div class="caption"><?= $index; ?><br><?= $caption; ?></div></div>
                                    <div class="caption"><?= $index; ?></div>
                                </div><? // close .thumb
                            }
                        }
                    $counter = $j;
                    ?></div><? // close .thumb_ctner
                    }
                    unset($max);
                }
                ?></div><? // close .block
                }
    	?></div>

    <div id='selected' class='menu_btn'><?
        ?><div class='static_'><a id="menu_toggle"><?= $lang == 'es' ? 'Ni apocalipsis ni paraíso' : ''; ?></a></div><?
    ?></div>
        
    <script>
    // pass to gallery.js for setting wide or tall css class
    var proportions = <? echo json_encode($media_props); ?>;
    </script>
    <script type="text/javascript" src="/static/js/screenfull.min.js"></script>
    <!-- <script type="text/javascript" src="/static/js/gallery.js"></script> --><?
?>
<script type = "text/javascript" src = "/static/js/menu.js"></script>
<script type="text/javascript" src="/static/js/windowfull.js"></script>
<script type="text/javascript" src="/static/js/refreshImage.js"></script>
<script>
    <? foreach($color_arr as $key => &$c){
        $c_temp = array(
            'idx' => $key,
            'color' => $c
        );
        $c = $c_temp;
    } 
    unset($c);
    ?>
    var imgs = document.querySelectorAll('.thumbnail img:not(.no-windowfull)');
    var i;
    var index;
    var current_img;
    for (i = 0; i < imgs.length; i++) {
        if(!imgs[i].getAttribute('windowfullDisabled')) {
            imgs[i].addEventListener('click', function () {
                current_img = this;
                windowfull.toggle(this);
            }, false);
        }
    }

    var sX = document.getElementById('x');
    sX.addEventListener('click', function(){
        windowfull.toggle(current_img);
    }, false);

    var sNext = document.getElementById('next');
    sNext.addEventListener('click', function(){
        current_img = windowfull.next(current_img, true);
    }, false);
    var sPrev = document.getElementById('prev');
    sPrev.addEventListener('click', function(){
        current_img = windowfull.prev(current_img, true);
    }, false);

    var sMenu_toggle = document.getElementById('menu_toggle');
    sMenu_toggle.addEventListener('click', toggleMenu, false);

    var color_arr = <?= json_encode($color_arr); ?>;
    var image_refresh_interval = 20 * 1000; // 2mins

    refreshImage_timer = setTimeout(function(){
        refreshImage();
    }, image_refresh_interval);
    window.addEventListener('keydown', function(e){
        if(e.keyCode == 39){
            clearTimeout(refreshImage_timer);
        }
    });
</script>

