<?php
class applicationControllerBASE extends Controller{

static function render(){
	$args=func_get_args();
	$action=$args[0];
	$controller=isset($args[1])?$args[1]:self::controller_name();
	$controllerClass=$controller.'Controller';
	$ContrArgs=isset($args[2])?$args[2]:'';
		if (!is_callable(array($controllerClass, $action))){
			if(is_file('controllers/'.$controller.'_controller.php')){
				include 'controllers/'.$controller.'_controller.php';}
				Registry::set('controller', $controller,true);

					//loading model
					if(is_file('models/'.$controller.'.php'))
					{include ('models/'.$controller.'.php');}
					else{Registry::addDebug('<div class="notice">Notice: No model For: <i>"'.$controller.'"</i> controller</div>');}

				$controllerClass::$action($ContrArgs);
				ob_start();
				include 'views/'.$controller.'/'.$action.'.html.php';
				Registry::set('content',ob_get_contents());
				ob_end_clean();
			
		}
	}
}
?>
