<?php

//REST Константы:
define ('create', 'post');
define ('destroy', 'delete');
define ('edit', 'put');

define ('post','create');
define ('delete','destroy');
define ('put','edit');






class Route{

static function delegate($debug=false) {



//REST система <!-- BEGIN -->
/*global $_PUT;
global $_DELETE;*/
global $_POST;
$_PUT=array();
$_DELETE=array();

if(isset($_POST['_method']) || isset($_POST[0])){
							 //Реристрация Запроса (REQUEST)
							 if(isset($_POST['_method'])){
								 Registry::set('method',strtolower($_POST['_method']));
								 //$_SERVER['REQUEST_METHOD']=strtoupper($_POST['_method']);
								 unset($_POST['_method']);
								 Registry::set('request',$_POST);
								 $_POST=array();
								 /*$temp= "_".$_SERVER["REQUEST_METHOD"];
								 $$temp=$_POST;*/
								 }
							 else{
							 	 Registry::set('method','post');
								 $_SERVER['REQUEST_METHOD']='POST';
								 Registry::set('request',$_POST);
							 }
//REST action decloration
				$action=constant(Registry::get('method'));
			 }
//REST система <!-- END -->


//if($RESTaction){$controller=$RESTaction;echo "KUKARACHJA";}

// Анализируем путь
self::getController($file, $controller, $action, $args);

$controllerClass=$controller.'Controller';

		// Файл доступен?
		if (!is_readable($file)){die ('404 Not Found Error:unreadable');}
		include ($file);
		
		//проверка на наличия правельного контролера
		if (!is_callable(array($controllerClass, $action))){
				array_unshift($args,$action);
				$action = 'index';
				if (!is_callable(array($controllerClass, $action))){die ('404 Not Found Error: uncallable 2');}
				}
Registry::set('controller', $controller,true);//добавлаем в журнал текушей контролер
//вывод стандартной абортки... если неиспользуетса контролер
		if($controllerClass=='applicationController'){
				//Registry::set('controller', 'application',true); //добавлаем в журнал текушей контролер
				applicationController::index($args);
		}

//вывод каковата модалимя и стандартной абортки...

		// Выполняем действие application 
		if(!is_callable(array('applicationController', 'index'))){
				//Registry::set('controller', 'application',true); //добавлаем в журнал текушей контролер
				include 'controllers/application_controller.php';
				applicationController::index($args);}

		// Выполняем действие контродира если не application
		if($controllerClass!='applicationController'){
				//loading model
				if(is_file('models/'.$controller.'.php'))
				{include ('models/'.$controller.'.php');}
				else{Registry::addDebug('<div class="notice">Notice: No model For: <i>"'.$controller.'"</i> controller</div>');}
			
			$controllerClass::$action($args);
			
			//loading VIEW
			if(is_file('views/'.$controller.'/'.$action.'.html.php')){
				ob_start();
				include 'views/'.$controller.'/'.$action.'.html.php';
				$output=ob_get_contents();
				Registry::append('content',ob_get_contents());
				ob_end_clean();}
			else{Registry::addDebug('<div class="notice">Notice: No VIEW For: <i>"'.$controller.'/'.$action.'"</i> controller</div>');}
			}

	}

private static function getController(&$file,&$controller, &$action, &$args){


		$route = (empty($_GET['route'])) ? '' : $_GET['route'];//добавить наварочиный Геттер - а луче двже проверку на наличия класа.
		if (empty($route)) {$route = 'application';}
		$parts = explode('/', $route);
		$cmd_path='controllers/';//isparvitj ubratj 2 tochki

		foreach ($parts as $part){
			$fullpath = $cmd_path . $part;

			// Есть ли папка с таким путём?
			if (is_dir($fullpath)) {
					$cmd_path .= $part . '/';
					array_shift($parts);
					continue;
			}

			// Находим файл
			if (is_file($fullpath . '_controller.php')){
					$controller = $part;
					array_shift($parts);
					break;
			}

		}
		if (empty($controller)) {$controller = 'application'; };
		// Получаем действие
			if(empty($action)){
				$action = array_shift($parts);
				if (empty($action)) { $action = 'index';}
			}
		
		$file = $cmd_path . $controller . '_controller.php';
		$args = $parts;
	}
}


?>
