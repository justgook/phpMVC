<?php

class applicationController extends applicationControllerBASE{
	static function index($args){
//	Registry::get('controller');

	//DEFAULTS
	if(Registry::get('controller')=='application'){
		self::set('title','default title');
		self::render('index','page',$args);
		}
	}

 static function title(){echo Registry::test('title')?Registry::get('title'):'Default title';}
}
?>
