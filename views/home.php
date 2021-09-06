<?
$lang = isset($_GET['en']) ? 'en' : 'es';
$lang_id = end($oo->urls_to_ids(array($lang)));
$children = $oo->children($lang_id);

foreach($children as $key => $child)
{
    if(substr($child['name1'], 0, 1) == '.')
        unset($children[$key]);
}
$children = array_values($children);

$gallery_id = end($oo->urls_to_ids(array('gallery')));
$gallery_groups_raw = $oo->children($gallery_id);
$gallery_groups = array();
$bracket_pattern = '#\[(.*?)\]#is';

$footer_id = end($oo->urls_to_ids(array('footer')));
$footer_m = $oo->media($footer_id)[0];

foreach($gallery_groups_raw as $key => $group){
    if(substr($group['name1'], 0, 1) == '.' )
        unset($gallery_groups[$key]);
    else
    {
        preg_match_all($bracket_pattern, $group['notes'], $color_arr_temp);
        $this_media = $oo->media($group['id']);
        $this_media_arr = array();
        foreach($this_media as $m)
        {
            if($lang == 'es')
                $caption = explode('///', $m['caption'])[0];
            else
                $caption = explode('///', $m['caption'])[1];
            $this_image = array(
                'src'          => m_url($m),
                'caption'      => $caption
            );
            $size = getimagesize("media/" . m_pad($m['id']).".".$m['type']);
            $media_props[] = $size[0] / $size[1];
            $this_media_arr[] = $this_image;
        }
        $gallery_groups[] = array(
            'group-index'      => $group['name1'],
            'color'            => $color_arr_temp[1][0],
            'background-color' => $color_arr_temp[1][1],
            'media'            => $this_media_arr
        );
    }
}
$gallery_groups = array_values($gallery_groups);
shuffle($gallery_groups);
     
    ?>
    <div id='x' class="gallery-control">
    	<svg version="1.1" fill= "#000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 150 150" style="enable-background:new 0 0 150 150;" xml:space="preserve">
			<path d="M79.3,75.2l37.9,38l-4.2,4.2L75,79.4l-37.9,38l-4.2-4.2l37.9-38l-37.9-38l4.2-4.2L75,71L113,33l4.2,4.2L79.3,75.2z"/>
		</svg>
    </div>
    <div id="next" class="gallery-control">
        <svg version="1.1" fill= "#000"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 150 150" style="enable-background:new 0 0 150 150;" xml:space="preserve">
			<path d="M124.2,75.1l-42.1,42.3l-4.3-4.2l34.9-35.1h-82v-6h82L77.9,37.2l4.2-4.2L124.2,75.1z"/>
		</svg>
    </div>
    <div id="prev" class="gallery-control">
        <svg version="1.1" fill="#000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 150 150" style="enable-background:new 0 0 150 150;" xml:space="preserve">
			<path d="M120,78.1H38l34.9,35.1l-4.3,4.2L26.6,75.1L68.7,33l4.2,4.2L38,72.1h82V78.1z"/>
		</svg>
    </div>
    <div id='gallery-background'></div>
    <div id="cv" class="clear" background_version=<?= $background_version; ?>><?
        foreach($children as $key => $child){
                $this_title = $child['name1'];
                $this_body = $child['body'];
                $this_id = $child['url'];
                $text_color = isset($gallery_groups[$key]['color']) ? $gallery_groups[$key]['color'] : '#000';
                preg_match_all($bracket_pattern, $child['deck'], $max_thumbs_temp);
                $thumb_max = ( empty($max_thumbs_temp[1]) || empty(intval($max_thumbs_temp[1][0])) ) ? 4 : intval($max_thumbs_temp[1][0]);
                $background_color = isset($gallery_groups[$key]['background-color']) ? $gallery_groups[$key]['background-color'] : 'transparent';
                $background_color_temp = $background_color . ' 50%';
                $background_image = 'linear-gradient(';
                if($key != 0)
                {
                    $prev_background_color = isset($gallery_groups[$key-1]['background-color']) ? $gallery_groups[$key-1]['background-color'] : 'transparent';
                    $background_color_temp = $prev_background_color . ' -50%, '.$background_color_temp;
                }
                if( $key != count($children)-1)
                {
                    $next_background_color = isset($gallery_groups[$key+1]['background-color']) ? $gallery_groups[$key+1]['background-color'] : 'transparent';
                    $background_color_temp = $background_color_temp . ', ' . $next_background_color . ' 150%';
                }
                $background_image .= $background_color_temp . ')';
                ?><div id="<?= $this_id; ?>" class="block" bgColor = "<?= $background_color; ?>" style="color: <?= $text_color; ?>;" thumb-max="<?= $thumb_max; ?>"><div class="block-background" style="background-image: <?= $background_image; ?>;"></div><div class="block-background" style="background-image: <?= $background_image; ?>;"></div>
                    <h1 class="block-title"><?= $this_title; ?></h1><br><div class="block-body"><?= $this_body; ?></div><?
                $counter = 0;
                $media = $gallery_groups[$key]['media'];
                $group_index = $gallery_groups[$key]['group-index'];
                if(count($media) > 0)
                {
                    for($i = 0 ; $i < 2 ; $i++){
                    ?><div class = "thumb_ctner <?= $i == 0 ? 'left' : 'right'; ?>"><?
                        $max = ($max) ? count($media) - $max : round(count($media)/2);
                        for($j = $counter; $j < $max + $counter; $j++){
                            $m = $media[$j];
                            if(isset($m)){
                                $url = $m['src'];
                                $caption = $m['caption'];
                                $index = $group_index . '.'. ($j+1);
                                // var_dump($group_index);
                                ?><div class="thumb">
                                    <div class="img-container">
                                        <div class="square">
                                            <div class="controls next white"><img src = "/media/svg/arrow-forward-6-w.svg"></div>
                                            <div class="controls prev white"><img src = "/media/svg/arrow-back-6-w.svg"></div>
                                            <div class="controls close white"><img src = "/media/svg/x-6-w.svg"></div>
                                        </div>
                                        <img src="<?= $url; ?>" alt="<?= $caption; ?>">
                                    </div>
                                    <div class="thumbnail">
                                        <div class="caption-detail">
                                            <p class="thumbnail-index"><?= $index; ?></p>
                                            <div class="caption-column"><?= $caption; ?></div>
                                        </div>
                                        <img group="<?= $group_index; ?>" idx="<?= $j; ?>" src="<?= $url; ?>" alt="<?= $caption; ?>">
                                    </div>
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
    <footer><img src="<?= m_url($footer_m) ?>" ></footer>
    <div id='selected' class='menu_btn'><div class='static_'><a id="menu_toggle">Ni apocalipsis ni paraíso</a></div><?
    ?></div>
    <div id='twothousandtwenty'>
        <a href="https://2019.materiaabierta.com"><img src="/media/svg/arrow-back-6-w.svg">2019</a><br/>
        <a href="https://2020.materiaabierta.com"><img src="/media/svg/arrow-back-6-w.svg">2020</a>
    </div>
<script>
// pass to gallery.js for setting wide or tall css class
var proportions = <? echo json_encode($media_props); ?>;
</script>
<script type="text/javascript" src="/static/js/screenfull.min.js"></script>
<script type = "text/javascript" src = "/static/js/menu.js"></script>
<script type="text/javascript" src="/static/js/windowfull.js"></script>
<script type="text/javascript" src="/static/js/refreshImage.js"></script>
<script>
    
    var imgs = document.querySelectorAll('.thumbnail img:not(.no-windowfull)');
    var i;
    var index;
    var current_img;
    for (i = 0; i < imgs.length; i++) {
        if(!imgs[i].getAttribute('windowfullDisabled')) {
            imgs[i].addEventListener('click', function () {
                current_img = this;
                windowfull.toggle(this);
                refreshImage.pause();
            }, false);
        }
    }
    var sX = document.getElementById('x');
    sX.addEventListener('click', function(){
        windowfull.toggle(current_img);
        refreshImage.resume();
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
    var sMenu_btn = document.getElementsByClassName('menu-btn');
    [].forEach.call(sMenu_btn, function(el, i){
        el.addEventListener('click', toggleMenu, false);
    });
    var image_refresh_interval = 20 * 1000; // 20 secs
    var waiting = 2000; // 5 secs    
   
    var gallery_groups = <?= json_encode($gallery_groups); ?>;
    setTimeout(function(){
    	document.body.classList.remove('waiting');
    	var sClock = document.getElementById('clock');
        if(sClock != undefined)
        {
            sClock.addEventListener('click', function(){
                refreshImage.pause();
                refreshImage.start();
            }, false);
        }
    	refreshImage.init(gallery_groups, image_refresh_interval);
    	refreshImage.start();
    }, waiting);

    function SmoothVerticalScrolling(e, time, where="top") {
        var eTop = e.getBoundingClientRect().top;
        var eAmt = eTop/100;
        var curTime = 0;
        console.log('current scrollY: ' + window.scrollY);
        console.log('scrolling to:    ' + (window.scrollY+eTop));
        while (curTime <= time) {
            window.setTimeout(function(){
                SVS_B(eAmt, where);
            }, curTime);
            curTime += time/100;
        }
    }

    function SVS_B(eAmt, where) {
        console.log('scrolling by '+eAmt);
        if(where == "center" || where == "")
            window.scrollBy(0, eAmt / 2);
        if (where == "top"){
            window.scrollBy(0, eAmt);
            console.log(window.scrollY);
        }
    }
    window.addEventListener('load', function(){
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                var target_id = anchor.getAttribute('href').substr(1); 
                if( target_id != undefined)
                    var target = document.getElementById(target_id);
                else
                    var target = null;
                if(target != null){
                    SmoothVerticalScrolling(target, 350);
                }
            });
        });
    })
</script>

