// hide show menu, read url for status

var toggleMenu = function(){
	if (menu.style.display!='block') {
		menu.style.display='block';
		// cv.style.display='none';
		// selected.style.display='none';
		xx.style.opacity='0.5';
	} else {
		menu.style.display='none';
		// cv.style.display='block';
		// selected.style.display='block';
		xx.style.opacity='1.0';
	}
}

var cv = document.getElementById('cv');
var selected = document.getElementById('selected');
var menu = document.getElementById('menu');
var xx = document.getElementById('xx');
xx.addEventListener("click", toggleMenu);
