<?

?>

<script type='text/javascript'>
	var color_arr = [];
	window.onload = function() {
	    var canvas = document.createElement("canvas");

	    var pic = new Image(); 
	    
	    pic.onload = function() {
	        canvas.width = pic.width;
	        canvas.height = pic.height;
	        var ctx = canvas.getContext("2d");

	        ctx.drawImage(pic, 0, 0);
	        var c = canvas.getContext('2d');
	        console.log(canvas.width, canvas.height);
	        for(i = 0; i < canvas.width; i++)
	        {
	        	color_arr[i] = [];
	        	// var p = c.getImageData(i, 0, 1, 1).data;
        		// var this_rgb = {
        		// 	'r': p[0],
        		// 	'g': p[1],
        		// 	'b': p[2]
        		// };
        		// color_arr[i][0] = this_rgb; 
	        	for(j = 0; j < canvas.height; j++)
	        	{
	        		var p = c.getImageData(i, j, 1, 1).data;
	        		var this_rgb = {
	        			'r': p[0],
	        			'g': p[1],
	        			'b': p[2]
	        		};
	        		color_arr[i][j] = this_rgb; 
	        		// var hex = "RGB = " + p[0]+", "+p[1]+", "+p[2];
	        		// document.getElementById("output").innerHTML += hex; 
	        	}
	        }
		    console.log(color_arr);
		    

		    
	    }

	    pic.src = 'media/png/24-min.png'; 
	}
</script>
<main>
	<div id = "output"></div>
</main>


