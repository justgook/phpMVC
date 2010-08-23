<?php

function authenticity_token(){
	$args=func_get_args();
	$test=date('i',time())>29?1:0;
	return md5(date('H',time())+$test);
}

class View{
	static function yield($whot='content'){
		if(Registry::test('content') || Registry::test('default->content')){echo Registry::get($whot);}
		else{Registry::addDebug('<div class="error">ERROR: no Content set for function yield</div>');}
	}
	
	static function flash(){
		if(Registry::test('flash') || Registry::test('default->flash')){echo Registry::get('flash');}
		else{Registry::addDebug('<div class="error">ERROR: no <i>:flash</i> set for function flash</div>');}
	}
	
	static function get($whot='content'){
	echo Registry::get(array(Registry::get('controller'),$whot));
	}
	
	static function render($file){
		if(is_file('views/'.Registry::get('controller').'/_'.$file.'.html.php')){
			include 'views/'.Registry::get('controller').'/_'.$file.'.html.php';}
		else{
				$fileEx=explode('/',$file);
				$fileExLast=array_pop($fileEx);

					if(is_file('views/'.implode('/',$fileEx).'/_'.$fileExLast.'.html.php')){
					include 'views/'.implode('/',$fileEx).'/_'.$fileExLast.'.html.php';
					}
				elseif(is_file('views/'.implode('/',$fileEx).'/'.$fileExLast.'.php')){
					include 'views/'.implode('/',$fileEx).'/'.$fileExLast.'.php';
					}
				else{Registry::addDebug('<div class="error">Error: No file ('.$file.') loading by View::render </div>');}

				}

	}
	static function link($name,$link){ echo '<a href="'.subdir.'/'.$link.'">'.$name.'</a>';}
//Open Form
	static function form(){
////////////build test on DESTRUCT for cloused is all Forms Cloused
		$args=func_get_args();
		$action=$args[0];
		$method=$args[1];

if(isset($method)){$methodInp='<input name="_method" type="hidden" value="'.$method.'"/>';}
		echo '
		<form action="'.subdir.''.$action.'" method="post">
<div style="margin:0;padding:0;display:inline">
'.@$methodInp.'
<input name="authenticity_token" type="hidden" value="'.authenticity_token().'" />
</div>';
	}
//Close Form
	static function _form(){echo "</form>";}

	
	
}

?>
