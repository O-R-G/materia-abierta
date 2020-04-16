<style>
body {
    padding: 0px;
    -webkit-user-select: none;
}
canvas:focus {
    outline: 0;
}
</style>
<?    
$sizer = 400;
?><script type="application/javascript">
    var sizer = <?= $sizer ?>;
</script>
<div id='app-msg'>
    To install the Materia Abierta app (iOS), click this icon 
    <img src="/media/png/add-to-homescreen.png"> below 
    and choose Add to Home Screen.
</div>
<div id='app'>
    <canvas class='centered' datasrc="/static/pde/clock.pde"
    width="<?= $sizer; ?>" height="<?= $sizer; ?>" tabindex="0"
    style="image-rendering: optimizeQuality !important;">
    </canvas>
</div>
<script type="application/javascript">
    /*
        app onboarding msg
        show the instructions only when not standalone 
        then hide the message
        check for cookie in views/head
    */
    var app = document.getElementById('app');
    var msg = document.getElementById('app-msg');
    if (("standalone" in window.navigator) &&       
        (!window.navigator.standalone)){
        app.style.display='none';
        msg.style.display='block';
    }  
</script>

