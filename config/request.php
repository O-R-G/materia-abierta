<?php
// I'm pretty sure this entire class implementation is useless
class Request
{
	public $style;
	
	function __construct()
	{	
		// get variables
		$get = array('style');

		foreach($get as $v)	
			$this->$v = $_GET[$v];
	}
}
?>