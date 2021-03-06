// https://api.nasa.gov/planetary/apod?api_key=LgKsCmYzKNPLLSD6q6Me8MluxCLT4hLzVFIrQIoO
function hex (c) {
  var s = "0123456789abcdef";
  var i = parseInt (c);
  if (i == 0 || isNaN (c))
    return "00";
  i = Math.round (Math.min (Math.max (0, i), 255));
  return s.charAt ((i - i % 16) / 16) + s.charAt (i % 16);
}

/* Convert an RGB triplet to a hex string */
function convertToHex (rgb) {
  return hex(rgb[0]) + hex(rgb[1]) + hex(rgb[2]);
}

/* Remove '#' in color hex string */
function trim (s) { return (s.charAt(0) == '#') ? s.substring(1, 7) : s }

/* Convert a hex string to an RGB triplet */
function convertToRGB (hex) {
  var color = [];
  color[0] = parseInt ((trim(hex)).substring (0, 2), 16);
  color[1] = parseInt ((trim(hex)).substring (2, 4), 16);
  color[2] = parseInt ((trim(hex)).substring (4, 6), 16);
  return color;
}

function generateColor(colorStart,colorEnd,colorCount){

	// The beginning of your gradient
	var start = convertToRGB (colorStart);    

	// The end of your gradient
	var end   = convertToRGB (colorEnd);    

	// The number of colors to compute
	var len = colorCount;

	//Alpha blending amount
	var alpha = 0.0;

	var saida = [];
	
	for (i = 0; i < len; i++) {
		var c = [];
		alpha += (1.0/len);
		
		c[0] = start[0] * alpha + (1 - alpha) * end[0];
		c[1] = start[1] * alpha + (1 - alpha) * end[1];
		c[2] = start[2] * alpha + (1 - alpha) * end[2];

		saida.push(convertToHex (c));
		
	}
	
	return saida;
	
}

function adjust_color(color=false, background_color=false){
	if(color && color.length < 2)
	{
		console.log('Error! adjust_color() expects to receive more than two colors.');
		return false;
	}
	else if(!color)
	{
		var color_begin = '#000000';
		var color_end = '#ffffff';
	}
	else if(color.length == 2)
	{
		
		var color_begin = '#' + color[0];
		var color_end = '#' + color[1];
	}

	if(background_color){
		background_color = '#'+background_color;
		document.body.style.backgroundColor=background_color;
	}
	
	window.addEventListener('load', function(){
		var sColor_effect_container = document.getElementsByClassName('color-effect-container');
		console.log(sColor_effect_container);
		if(sColor_effect_container.length > 0)
		{
			[].forEach.call(sColor_effect_container, function(el, i){
				var sGraident_pixel = el.getElementsByClassName('gradient-pixel');
				if(sGraident_pixel.length != 0)
				{
					var gradient_array = generateColor(color_begin,color_end,sGraident_pixel.length);
					[].forEach.call(sGraident_pixel, function(pixel, i){
						pixel.style.color = '#' + gradient_array[i];
					});
				}
			});
		}		
	});
}




