/*
    O-R-G inc.

    windowfull object
    screenfull.js shim for iOS safari
    see https://github.com/sindresorhus/screenfull.js/
*/
var currentImg_idx = 0;
var currentGroup_index = false;
var currentGroup_imgs = false;
var currentLoop_imgs = document.querySelectorAll('.thumbnail img:not(.no-windowfull)');

(function () {
    'use strict';

    var document = typeof window !== 'undefined' && typeof window.document !== 'undefined' ? window.document : {};
    var isCommonjs = typeof module !== 'undefined' && module.exports;
    var fullwindow = document.getElementById('fullwindow')            
    document.body.style.position = 'relative';  /* reqd ios overflow: hidden */

    var windowfull = {
        request: function (element) {
            document.body.style.overflow = 'hidden';
            fullwindow.style.display = 'block';
            element.parentNode.classList.toggle('fullwindow');
            },
        exit: function (element) {
            document.body.style.overflow = 'initial';
            fullwindow.style.display = 'none';
            element.parentNode.classList.toggle('fullwindow');
        },
        toggle: function (element) {
            if(this.isFullwindow)
                document.body.classList.remove('isFullwindow');
            else
                document.body.classList.add('isFullwindow');

            return this.isFullwindow ? this.exit(element) : this.request(element);
        },
        next: function(element, loopGroup=false){
            if(loopGroup)
            {
                var thisGroup_index = element.getAttribute('group');
                if(currentGroup_index !== thisGroup_index)
                {
                    currentGroup_index = thisGroup_index;
                    currentLoop_imgs = document.querySelectorAll('img[group="'+thisGroup_index+'"]');
                    [].forEach.call(currentLoop_imgs, function(el, i){
                        if(el.src == element.src)
                            currentImg_idx = i;
                    });
                }
                if(currentLoop_imgs[currentImg_idx].src != element.src){
                    [].forEach.call(currentLoop_imgs, function(el, i){
                        if(el.src == element.src)
                            currentImg_idx = i;
                    });
                }
            }
            else
            {

            }
            this.exit(currentLoop_imgs[currentImg_idx]);
            currentImg_idx++;
            if(currentImg_idx > currentLoop_imgs.length - 1)
                currentImg_idx = 0;
            this.request(currentLoop_imgs[currentImg_idx]);
            return currentLoop_imgs[currentImg_idx];
        },

        prev: function(element, loopGroup=false){
            if(loopGroup)
            {
                var thisGroup_index = element.getAttribute('group');
                if(currentGroup_index !== thisGroup_index)
                {
                    currentGroup_index = thisGroup_index;
                    currentLoop_imgs = document.querySelectorAll('img[group="'+thisGroup_index+'"]');
                    [].forEach.call(currentLoop_imgs, function(el, i){
                        if(el.src == element.src)
                            currentImg_idx = i;
                    });
                }
                if(currentLoop_imgs[currentImg_idx].src != element.src){
                    [].forEach.call(currentLoop_imgs, function(el, i){
                        if(el.src == element.src)
                            currentImg_idx = i;
                    });
                }
            }
            else
            {

            }
            this.exit(currentLoop_imgs[currentImg_idx]);
            currentImg_idx--;
            if(currentImg_idx < 0)
                currentImg_idx = currentLoop_imgs.length - 1;
            this.request(currentLoop_imgs[currentImg_idx]);
            return currentLoop_imgs[currentImg_idx];
        }
    };

    Object.defineProperties(windowfull, {
        isFullwindow: {
            get: function () {
                // check if currently fullwindow
                // (by presence of class?
                // or presence of div)
                // return true;
                // return Boolean(document[fn.fullscreenElement]);
                // return Boolean(!(document.getElementById('fullwindow')));
                // return Boolean(document.getElementById('fullwindow'));
                return Boolean(fullwindow.style.display == 'block');
            }
        }
    });

    if (isCommonjs) {
        module.exports = windowfull;
    } else {
        window.windowfull = windowfull;
    }
})();
