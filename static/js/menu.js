// hide show menu, read url for status

var toggleMenu = function(){
	if (menu.style.display!='block') {
		menu.style.display='block';
		cv.style.display='none';
	} else {
		menu.style.display='none';
		cv.style.display='block';
	}
}

var cv = document.getElementById('cv');
var menu = document.getElementById('menu');
var xx = document.getElementById('xx');
xx.addEventListener("click", toggleMenu);
