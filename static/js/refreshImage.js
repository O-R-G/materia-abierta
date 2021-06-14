var refreshImage_timer = false;
var timer_begin;
var timer_remaining;
var thumb_template = document.querySelector('.thumb');
if(thumb_template == null)
{
	// based on windowfull.js
	thumb_template = document.createElement('DIV');
	thumb_template.className = 'thumb';
	var this_img_container = document.createElement('DIV');
	this_img_container.className = 'img-container';
	var this_square = document.createElement('DIV');
	this_square.className = 'square';
	var this_next = document.createElement('DIV');
	this_next.className = 'controls next white';
	var this_next_img = document.createElement('IMG');
	this_next_img.src = '/media/svg/arrow-forward-6-w.svg';
	this_next.appendChild(this_next_img);
	var this_prev = document.createElement('DIV');
	this_prev.className = 'controls prev white';
	var this_prev_img = document.createElement('IMG');
	this_prev_img.src = '/media/svg/arrow-back-6-w.svg';
	this_prev.appendChild(this_prev_img);
	var this_close = document.createElement('DIV');
	this_close.className = 'controls close white';
	var this_close_img = document.createElement('IMG');
	this_close_img.src = '/media/svg/x-6-w.svg';
	this_close.appendChild(this_close_img);
	var this_img_1 = document.createElement('IMG');
	this_square.appendChild(this_next);
	this_square.appendChild(this_prev);
	this_square.appendChild(this_close);
	this_img_container.appendChild(this_square);
	this_img_container.appendChild(this_img_1);

	var this_thumbnail = document.createElement('DIV');
	this_thumbnail.className = 'thumbnail';
	var this_img_2 = document.createElement('IMG');
	var this_caption_detail = document.createElement('DIV');
	this_caption_detail.className = 'caption-detail';
	var this_thumbnail_index = document.createElement('DIV');
	this_thumbnail_index.className = 'thumbnail-index';
	var this_caption_column = document.createElement('DIV');
	this_caption_column.className = 'caption-column';
	this_caption_detail.appendChild(this_thumbnail_index);
	this_caption_detail.appendChild(this_caption_column);
	this_thumbnail.appendChild(this_caption_detail);
	this_thumbnail.appendChild(this_img_2);
	

	var this_caption = document.createElement('DIV');
	this_caption.className = 'caption';

	thumb_template.appendChild(this_img_container);
	thumb_template.appendChild(this_thumbnail);
	thumb_template.appendChild(this_caption);
}

function createThumbs(group){
	// var counter = 0;
	// var max = '';
	var output = [];
	var media = group['media'];
	var group_index = group['group-index'];
	// for(i = 0; i < 2; i++)
	// {
	// 	var this_thumb_ctner = document.createElement('DIV');
	// 	this_thumb_ctner.className = 'thumb_ctner ' + (i == 0 ? 'left' : 'right');
	// 	max = (max === '' ? Math.round(media.length / 2) : media.length - max);
	// 	for (j =counter; j < max + counter; j++)
		for (j =0; j < media.length; j++)
		{
			var m = media[j];
			var url = m['src'];
			var caption = m['caption'];
			var index = group_index + '.'+ (j+1);
			var this_thumb = thumb_template.cloneNode(true);
			var this_img = this_thumb.querySelectorAll('img');
			[].forEach.call(this_img, function(el, i){
				el.src = url;
				el.alt = caption;
				if(el.parentNode.classList.contains('thumbnail')){
					el.setAttribute('group', group_index);
					console.log('idx = '+j);
					el.setAttribute('idx', j);
				}
				el.addEventListener('click', function () {
          current_img = this;
          windowfull.toggle(this);
          if(windowfull.isFullwindow)
          	refreshImage.pause();
          else
          	refreshImage.resume();
        }, false);
			});
			var this_thumbnail_index = this_thumb.querySelector('.thumbnail-index');
			this_thumbnail_index.innerText = index;
			var this_caption_detail = this_thumb.querySelector('.caption-detail');
			var this_caption_column = this_caption_detail.querySelector('.caption-column');
			this_caption_column.innerText = caption;
			var this_caption = this_thumb.querySelector('.caption');
			this_caption.innerText = index;

			// this_thumb_ctner.appendChild(this_thumb);
			output.push(this_thumb);
		}
		// output.push(this_thumb_ctner);
		// counter = j;

	// }
	return output;
};
function createThumbCtners(thumb_arr){
	// shuffle and split thumbs
	var thumb_arr_temp = thumb_arr;
	var shuffled = shuffle(thumb_arr_temp);
	var output = [];
	var max = '';
	var counter = 0;
	for(i = 0; i < 2; i++)
	{
		var this_thumb_ctner = document.createElement('DIV');
		this_thumb_ctner.className = 'thumb_ctner ' + (i == 0 ? 'left' : 'right');
		max = (max === '' ? Math.round(thumb_arr.length / 2) : thumb_arr.length - max);
		for (j =counter; j < max + counter; j++)
			this_thumb_ctner.appendChild(shuffled[j]);

		output.push(this_thumb_ctner);
		counter = j;
	}
	return output;
}

var refreshImage = {
	init: function(gallery_groups, interval){
		this.groups = gallery_groups;
		this.interval = interval;
		timer_begin = Date.now();
		var groups_element = [];
		for(k = 0; k < this.groups.length; k ++){
			var this_group_element = createThumbs(this.groups[k]);
			this.groups[k]['element'] = this_group_element;
		}
	},
	start: function(self = false, isResume=false){
		if(!self)
			self = this;
		timer_begin = Date.now();
		if(!isResume)
			timer_remaining = refreshImage.interval;

		var sBlock = document.getElementsByClassName('block');
		var this_order_arr = [];
		for(i = 0; i < sBlock.length; i ++){
			this_order_arr[i] = i;
		}
		self.groups = shuffle(self.groups);
		var groups = self.groups;
		[].forEach.call(sBlock, function(el, i){
			var backgroundImage_to = 'linear-gradient(';
			var backgroundColor_to = self.groups[i]['background-color'] + ' 50%';
			// console.log(i+'th block');
			if(i != 0)
			{
				var previous_bgColor = self.groups[i - 1]['background-color'];
				backgroundColor_to = previous_bgColor + ' -50%, ' + backgroundColor_to;
				// console.log('prev backgorund color = ' + previous_bgColor);
			}
			// console.log('this backgorund color = ' + backgroundColor_to);
			if(i != sBlock.length - 1)
			{
				var next_bgColor = self.groups[i + 1]['background-color'];
				backgroundColor_to = backgroundColor_to + ', ' + next_bgColor + ' 150%';
				// console.log('next backgorund color = ' + next_bgColor);
			}
			backgroundImage_to += backgroundColor_to + ')';
			el.classList.add('hideThumb_ctner');
			var el_thumb_ctner = el.querySelectorAll('.thumb_ctner');
			var new_thumb_ctners = createThumbCtners(self.groups[i]['element']);
			if(el_thumb_ctner.length == 0)
			{
				el.appendChild(new_thumb_ctners[0]);	
				el.appendChild(new_thumb_ctners[1]);	
			}
			else
			{
				if(i==4)
				{
					console.log(self.groups[i]['element'][0]);
					console.log(self.groups[i]['element'][0].querySelectorAll('.thumb'));
				}
				el.replaceChild(new_thumb_ctners[0], el_thumb_ctner[0]);
				el.replaceChild(new_thumb_ctners[1], el_thumb_ctner[1]);
			}
			el.style.color = self.groups[i]['color'];
			var this_background = el.querySelectorAll('.block-background');
			this_background[0].style.backgroundImage = backgroundImage_to;
			el.setAttribute('bgColor', self.groups[i]['background-color']);
			el.classList.add('changing');
			setTimeout(function(){
				this_background[1].style.backgroundImage = backgroundImage_to;
				el.classList.remove('changing');
			}, 1000);
			setTimeout(function(){
				el.classList.remove('hideThumb_ctner');
			}, 50);
		});

		refreshImage_timer = setTimeout(function(){ self.start(self); }, self.interval);
	},
	pause: function(){
		var pause = Date.now();
		timer_remaining = refreshImage.interval - (pause - timer_begin);
		clearTimeout(refreshImage_timer);
		refreshImage_timer = null;
	},
	resume: function(){
		refreshImage_timer = setTimeout(function(){
			refreshImage.start(false, true);
		}, timer_remaining);
	}

}


function shuffle(array) {
  var currentIndex = array.length,  randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return array;
}


