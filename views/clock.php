<?
// init clocks
$clocks = array(    'ModernArtClock.pde',
                    'ModernArtClockDisplayDispDi.pde',
                    'ModernArtClockDisplayDisplayDisplay.pde',
                    'ModernArtClockDisplayResonator.pde',
                    'ModernArtClockDisplayResonatorResonator.pde',
                    'ModernArtClockPower.pde',
                    'ModernArtClockPowerResonatorDisplay.pde',
                    'ModernArtClockPowerResonatorDisplayAll.pde',
                    'ModernArtClockResonator.pde',
                    'ModernArtClockWorks.pde',
                    'TheServingLibrary.pde');
// pick one
// $clock = $clocks[rand(0, count($clocks)-1)];
// ** fix ** hardcoded for now
$clock = $clocks[3];
// $clock = $clocks[7];

function renderClock($clock) {
    // passed $clock from $clocks[]
    ?><canvas class='clock' datasrc="/static/pde/<?= $clock; ?>"
        width="200" height="200" tabindex="0"
        style="image-rendering: optimizeQuality !important;">
    </canvas><?
}

?><div id='clock'>
    <?
        renderClock($clock); 
    ?>
</div>
<script>
    var sClock = document.getElementById('clock');
    sClock.addEventListener('click', function(){
        refreshImage.pause();
        refreshImage.start();
    }, false);
</script>
