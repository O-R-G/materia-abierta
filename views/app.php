<?
$sizer = 400;    
?><div id='app'>
        <canvas class='centered' datasrc="/static/pde/clock.pde"
        width="<?= $sizer; ?>" height="<?= $sizer; ?>" tabindex="0"
        style="image-rendering: optimizeQuality !important;">
        </canvas>
</div>
<script type="application/javascript">
    // use these to modulate size
    // console.log(screen.height);
    // console.log(screen.width);
    var sizer = <?= $sizer ?>;
</script>
