<?
$sizer = 200;
?><div id='clock'>
    <a href='/'>
        <canvas class='clock' datasrc="/static/pde/clock.pde"
        width="<?= $sizer; ?>" height="<?= $sizer; ?>" tabindex="0"
        style="image-rendering: optimizeQuality !important;">
        </canvas>
    </a>
</div>
<script type="application/javascript">
    var sizer = <?= $sizer ?>;
</script>
