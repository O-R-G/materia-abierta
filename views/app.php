<?
/*
    app onboarding cookie
    show the instructions only once
    then hide the message
    check for cookie in views/head
*/

if ($app == null) {
    ?><div id='app-msg'>
        To install the Materia Abierta app (iOS), click this icon 
        <img src="/media/png/add-to-homescreen.png"> below 
        and choose Add to Home Screen.
    </div><?
} else {
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
    </script><?
}
?>

