<?php
class pageController extends Controller{
	
	static function index($args){
	
		if(isset($args)){
			$action=array_shift($args);
			if(is_callable(array('self', $action))){self::render($action,$args);}else{self::set('title','PAGES PAGES PAGES', true);}
			}
		else{self::set('title','PAGES PAGES PAGES', true);}
	}

	static function about($das){
	self::set('title','About', true);
	}

	static function contacts($das){
	self::set('title','contacts', true);
	}
}
?>
