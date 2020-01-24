/*

    imgcontroller

    based on videocontroller.js

*/

// init 

var imgs = document.getElementsByClassName("img");
var clocks = document.getElementsByClassName("clock");


// assign events

for (var i = 0; i < imgs.length; i++) {
    imgs[i].onmouseover=fade_in;
    imgs[i].onmouseout=fade_out;
}

for (var i = 0; i < clocks.length; i++) {
    clocks[i].onmouseover=fade_out;
    clocks[i].onmouseout=fade_in;
}

function fade_in() {
    // relys on css transition-duration
    this.style.opacity=1.0;
} 

function fade_out() {
    // relys on css transition-duration
    this.style.opacity=0.0;
} 




/* not using any of this for now */

var index = [];
var timer;
var time_to_start = 500;
var time_to_next  = 10000;

// populate and shuffle videos[] index for play order

for (var i = 0; i < imgs.length; i++) 
   index.push(i);
index = index.sort(function(a, b){return 0.5 - Math.random()});
console.log(imgs.length);
console.log(index.length);
console.log(index);

// start

function start_timer() {
    timer = setTimeout(function(){ play_one_video(index[0]); }, time_to_start);
}


// ** using this only, in views/home handler written inline to img **

// video control

function fade_in_one_img(i) {
    imgs[i].style.opacity=1.0;
    /*
    if (i+1 < imgs.length)
        timer = setTimeout(function(){ play_one_video(index[i+1]); }, time_to_next);
    */
} 

function pause_one_video(i) { 
    videos[i].style.boxShadow = null;
    videos[i].pause();
} 

function play_all_videos() { 
    for (i = 0; i < videos.length; i++) {
        videos[i].style.boxShadow = '0 0px 5px 0 rgba(0,0,255,0.75), 0 0px 15px 0 rgba(0,0,255,0.19)';
        videos[i].play();
    }
    timer = null;
}

function pause_all_videos() { 
    for (i = 0; i < videos.length; i++) {
        videos[i].style.boxShadow = null;
        videos[i].pause();
    }
    timer = null;
}
