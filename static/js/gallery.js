// requires screenfull.js
// requires html/css as:
//  .thumb
//    .img-container
//      .square
//        .controls
//      .img centered [wide][tall]
//    .caption

var thumbs = [];
var imgcontainers  = [];
var captions = [];
var imgs = [];
var widetall = [];
var o_src;
var gallery;
var galleryinitindex;
var galleryinitsrc;
var fullscreen;
var fullwindow;
var debug;

// window dimensions

var vieww = window.innerWidth 
	|| document.documentElement.clientWidth 
	|| document.body.clientWidth;
var viewh = window.innerHeight 
	|| document.documentElement.clientHeight
	|| document.body.clientHeight;
var viewproportion = vieww / viewh;
// var proportions[] passed from views/main.php

// index w/closure

// (function()) indicates self-invoking function set counter = 0
// privateindex is wrapped in a closure, init once, adjust many
// index methods: set, adjust, value
// see http://stackoverflow.com/questions/19317466/closures-javascript-help-to-understand-example

var index = ( function() {
    var privateinit = 0;
    var privateindex = 0;
    function changeBy(privatevalue) {
        privateindex += privatevalue;
    }
    function setTo(privatevalue) {
        privateindex = privatevalue;
    }
    return {
        set: function(privatevalue) {
            setTo(privatevalue);
        },
        adjust: function(privatevalue) {
            changeBy(privatevalue);
        },
        value: function() {
            return privateindex;
        }
    };
})();

// desktop or mobile

if (screenfull.enabled && !fullwindow) 
    fullscreen = true;
else 
    fullwindow = true;

// assign handlers    

var thumbs = document.getElementsByClassName('thumb');
var imgcontainers = document.getElementsByClassName('img-container');
var captions = document.getElementsByClassName('caption');

for (var i = 0; i < thumbs.length; i++) {
    ( function () {
        // ( closure ) -- retains state of local variables
        var imgcontainer = imgcontainers[i];
        var caption = captions[i];
        var img = imgcontainer.children[1];          
        var controlsnext = imgcontainer.children[0].children[0];
        var controlsprev = imgcontainer.children[0].children[1];
        var controlsclose = imgcontainer.children[0].children[2];
        var j = i;

	    if (proportions[i] > viewproportion + .1) 
		    img.className = "centered wide";
    	else
	    	img.className = "centered tall";

        caption.addEventListener('click', function() {
            index.set(j);
            launch();
            var thisimgcontainer = this.previousElementSibling;
            thisimgcontainer.style.display="block";
            this.style.display="none";
            this.parentElement.parentElement.className="";  // rm parent "transform"
            if (fullscreen) {
                screenfull.request(thisimgcontainer);
            } else { 
                imgcontainer.className = "img-container-fullwindow";
                readdeviceorientation();
            }
        });
        controlsnext.addEventListener('click', next); 
        controlsprev.addEventListener('click', prev); 
        controlsclose.addEventListener('click', function() {                
            var thisimgcontainer = this.parentElement.parentElement; 
            var thiscaption = thisimgcontainer.nextElementSibling;
            thisimgcontainer.style.display="none";
            this.parentElement.parentElement.parentElement.parentElement.className="centered";
            thiscaption.style.display="block";
            if (fullscreen)
                screenfull.exit();
            debuglog();
        });
        imgs.push(img);
    }());
}

// navigation 

function launch() {
    galleryinitindex = index.value();
    galleryinitsrc = imgs[index.value()].src;
    gallery = imgs[index.value()];
    debuglog();
}

function next() {
    index.adjust(1);
    if (index.value() > imgs.length - 1)
        index.set(0);
    if (index.value() === galleryinitindex)
        gallery.src = galleryinitsrc;
    else 
        gallery.src = imgs[index.value()].src;
    gallery.className = imgs[index.value()].className;
    debuglog();
}

function prev() {
    index.adjust(-1);
    if (index.value() < 0)
        index.set(imgs.length - 1);
    if (index.value() === galleryinitindex)
        gallery.src = galleryinitsrc;
    else 
        gallery.src = imgs[index.value()].src;
    gallery.className = imgs[index.value()].className;
    debuglog();
}

document.onkeydown = function(e) {
    if(screenfull.isFullscreen || fullwindow) {
        e = e || window.event;
        switch(e.which || e.keyCode) {
            case 37: // left
                prev();
                break;
            case 39: // right
                next();
                break;
            case 27: // esc
                // never fires bc screenfull.js catches esc event
                var thisimgcontainer = gallery.parentElement;
                var thiscaption = thisimgcontainer.nextElementSibling;
                thisimgcontainer.style.display="none";
                thisimgcontainer.parentElement.parentElement.className="centered";
                thiscaption.style.display="block";
                if (fullscreen)
                    screenfull.exit();
                debuglog();
                break;
            default: return; // exit this handler for other keys
        }
        e.preventDefault();
     }
}

if (screenfull.enabled) {
    document.addEventListener(screenfull.raw.fullscreenchange, function() {
        if (!screenfull.isFullscreen) {
            resetthumbnail();
        }
    });
}

// iOS device orientation

function readdeviceorientation() {
    var thisimgcontainer = gallery.parentElement;
    if (Math.abs(window.orientation) === 90) {
        thisimgcontainer.style.display="block";
        // document.getElementById("orientation").innerHTML = "LANDSCAPE";
    } else {
        // for the moment, show regular full window
        // would like to instead prompt to rotate phone
        // but perhaps for now this is best
        // thisimgcontainer.style.display="none";
        thisimgcontainer.style.display="block";
        // document.getElementById("orientation").innerHTML = "PORTRAIT";
    }
}

window.onorientationchange = readdeviceorientation;

// utility

function resetthumbnail() {
    for (var i = imgcontainers.length-1; i >= 0; i--)
        imgcontainers[i].style.display="none";
    for (var i = captions.length-1; i >= 0; i--)
        captions[i].style.display="block";
    gallery.parentElement.parentElement.parentElement.className="centered";
    gallery = null;
}

function debuglog() {
    if (debug) {
        console.log("index = " + index.value() + " / " + (imgs.length - 1));
        for (var i = 0; i < imgs.length; i++) {
            console.log("imgs[" + i + "].src = " + imgs[i].src);
        }
        console.log("proportions[index.value()] = " + proportions[index.value()]);
        console.log("gallery.src = " + gallery.src);
        console.log("+");
    }
}
