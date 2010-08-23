<?php

interface Controller_base{
	static function index($args);
	static function show($args);//отображения контента mVc

	static function _new($args);//отображения создания mVc
	static function create($args);//действия создания Mvc

	static function edit($args);//отображения редактирования mVc
	static function update($args);//действия редактирования Mvc

	static function destroy($args);//действия удоленья Mvc
}

abstract class Controller implements Controller_base{

	static function render(){
			$args=func_get_args();
			$action=$args[0];
			
			$controller=isset($args[1])?$args[1]:self::controller_name();
			$ContrArgs=isset($args[2])?$args[2]:'';
			
			if(isset($args[1])){
				if(is_array($args[1])){$controller=self::controller_name();$ContrArgs=$args[1];}
			}
			$controllerClass=$controller.'Controller';



				Registry::set('controller', $controller,true);
		if (!is_callable(array($controllerClass, $action))){
			if(is_file('controllers/'.$controller.'_controller.php')){
				include 'controllers/'.$controller.'_controller.php';}
					//loading model
					if(is_file('models/'.$controller.'.php')){include ('models/'.$controller.'.php');}
					else{Registry::addDebug('<div class="notice">Notice: No model For: <i>"'.$controller.'"</i> controller</div>');}
		}

				$controllerClass::$action($ContrArgs);
				/* //OLD VIEW LOADING
				ob_start();
				include 'views/'.$controller.'/'.$action.'.html.php';
				Registry::set('content',ob_get_contents(),true);
				ob_end_clean();
				*/
				
				//NEW loading VIEW
				if(is_file('views/'.$controller.'/'.$action.'.html.php')){
					ob_start();
					include 'views/'.$controller.'/'.$action.'.html.php';
					$output=ob_get_contents();
					Registry::set('content',ob_get_contents(),true);
					ob_end_clean();}
				else{Registry::addDebug('<div class="notice">Notice: No VIEW For: <i>"'.$controller.'/'.$action.'"</i> controller</div>');}
				



	}
	////DOBAVITJ ZNACHENIE STATUSA!
	static function setflash($var, $status='success'){Registry::append('flash',$var); return true;}
	static function getflash(){return Registry::get('flash');}

	static function getmethod(){return Registry::get('method');}
	static function getrequest(){return Registry::get('request');}

	static function controller_name(){return Registry::get('controller');}

	static function set($key, $var,$rewrite=false){Registry::set(self::controller_name(), array($key=>$var),$rewrite); return true;}
	static function get($key){ return Registry::get(array(self::controller_name(),$key));}

	static function display($text){Registry::append('content',$text); return true;}

//MVC стандартные методы
	static function index($args){echo 'You are in: '.self::controller_name().'/index';}
	static function show($args){}//отображения контента mVc

	static function _new($args){}//отображения создания mVc
	static function create($args){}//действия создания Mvc

	static function edit($args){}//отображения редактирования mVc
	static function update($args){}//действия редактирования Mvc

	static function destroy($args){}//действия удоленья Mvc

}
?>
