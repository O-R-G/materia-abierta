function pad(n)
{
	var padded = (n.toString().length == 1) ? "0" + n : n;
	return padded;
}

function display_time() 
{		
	server_date.setSeconds(server_date.getSeconds()+1);
			
	var h = pad(server_date.getHours());
	var m = pad(server_date.getMinutes());
	var s = pad(server_date.getSeconds());
	var time_str = h + "." + m + "." + s + " (GMT +1)";
	
	document.getElementById("clock").innerHTML = time_str;
}