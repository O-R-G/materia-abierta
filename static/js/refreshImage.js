var refreshImage_timer = false;

var order_arr = [];

function refreshImage(interval = 120000, this_order_arr = false){
	// color_arr[i][0] = text color
	// color_arr[i][1] = background color
	var sBlock = document.getElementsByClassName('block');
	if(!this_order_arr)
	{
		var this_order_arr = [];
		for(i = 0; i < sBlock.length; i ++){
			this_order_arr[i] = i;
		}
	}
	var this_order_arr_temp = [];
	shuffle(this_order_arr);
	var color_arr_temp = [];
	[].forEach.call(sBlock, function(el, i){

		var order_to = this_order_arr[i];
		color_arr_temp[order_to] = [];
		color_arr_temp[order_to][0] = el.style.color;
		color_arr_temp[order_to][1] = el.getAttribute('bgColor');
	});
	[].forEach.call(sBlock, function(el, i){
		var this_thumb_ctner = el.querySelectorAll('.thumb_ctner');
		var order_to = this_order_arr[i];	
			var block_to = sBlock[order_to];
			var backgroundImage_to = 'linear-gradient(';
			var backgroundColor_to = color_arr_temp[order_to][1] + ' 50%';
			if(order_to != 0)
			{
				var previous_bgColor = color_arr_temp[order_to - 1][1];
				backgroundColor_to = previous_bgColor + ' -50%, ' + backgroundColor_to;
			}
			if(order_to != sBlock.length - 1)
			{
				var next_bgColor = color_arr_temp[order_to + 1][1];
				backgroundColor_to = backgroundColor_to + ', ' + next_bgColor + ' 150%';
			}

			backgroundImage_to += backgroundColor_to + ')';
			block_to.appendChild(this_thumb_ctner[0]);
			block_to.appendChild(this_thumb_ctner[1]);
			block_to.style.color = color_arr_temp[order_to][0];

			var this_thumbnails = black_to.querySelectorAll('.thumbnail');

			var this_background = block_to.querySelectorAll('.block-background');
			this_background[0].style.backgroundImage = backgroundImage_to;
			block_to.setAttribute('bgColor', color_arr_temp[order_to][1]);
			block_to.classList.add('changing');
			setTimeout(function(){
				this_background[1].style.backgroundImage = backgroundImage_to;
				block_to.classList.remove('changing');
			}, 3000);
		
	});
	color_arr = color_arr_temp;
	refreshImage_timer = setTimeout(function(){refreshImage(interval, this_order_arr)}, interval);
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


