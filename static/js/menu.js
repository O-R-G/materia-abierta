

var toggleMenu = function(){
	var sMenu_sibling = document.getElementsByClassName('menu_sibling');
	// Make sure there are siblings to show before toggle menu;
	if(sMenu_sibling.length != 0){
		var sDropdown = document.getElementById('dropdown');
		var sBody = document.body;
		Array.prototype.forEach.call(sMenu_sibling, function(el, i){
		  	el.classList.toggle('hidden');
		});
		// not sure if a class on menu be useful or not
		sDropdown.classList.toggle('expanded');
		// add a class to body to hide the main content; 
		sBody.classList.toggle('viewingMenu');
		return false;
	}
}

var sMenu_btn = document.getElementsByClassName('menu_btn');
Array.prototype.forEach.call(sMenu_btn, function(el, i){
  	el.addEventListener("click", toggleMenu);
});

var sMenu_xx = document.getElementById('menu_xx');
sMenu_xx.addEventListener("click", toggleMenu);
