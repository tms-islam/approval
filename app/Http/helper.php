<?php

//use daynamic url 
if(!function_exists('aurl')){
	function aurl($url = null){
		return url('admin/'.$url);
	}
}

// helper for use guard 

if(!function_exists('admin')){
	function admin(){
		return auth()->guard('admin');
	}
}