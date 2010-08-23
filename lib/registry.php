<?php
class Registry{

private $vars = array();

static function o(){
			global $Registry;
			if(!isset($Registry)){$Registry= new Registry;}
			return $Registry;
			}

static function set($key, $var,$rewrite=false) {
			if (isset(self::o()->vars[$key]) && !$rewrite) {
			self::addDebug('<div class="error">Error: trying to redeclaret variable <b>'.$key.'/'.(is_array($var)?implode('/',array_keys($var)):'').'</b>, use <i>self:set($key,$var,true)</i></div>');
			}
			else{
				self::o()->vars[$key] = $var;
				return true;
				}
			}
static function add($key, $var,$rewrite=false) {
			if (isset(self::o()->vars[$key]) && !$rewrite) {
			self::addDebug('<div class="error">Error: trying to redeclaret variable <b>'.$key.'/'.(is_array($var)?implode('/',array_keys($var)):'').'</b>, use <i>self:set($key,$var,true)</i></div>');
			}
			else{
				if(isset(self::o()->vars[$key])){self::o()->vars[$key]=array_merge(self::o()->vars[$key],$var);}
				else{self::o()->vars[$key] = $var;}
				return true;
				}
			}
			
static function append($key, $var) {
				@self::o()->vars[$key] .= $var;
				return true;
			}
			
static function addDebug($var){
				@self::o()->vars['debug'] .= $var;
				return true;
			}
static function getDebug(){
				return isset(self::o()->vars['debug'])?self::o()->vars['debug']:'<div class="noerror">no errors</div>';
			}


	static function get($keys) {
		$vars=self::o()->vars;
		if(is_array($keys))
		foreach($keys as $key){
				if (!isset($vars[$key])){
					self::addDebug('<div class="notice">Notice: trying to acces Undefined index <b>'.implode('/',$keys).'</b> in controller: '.self::o()->vars['controller'].'</div>');
					 	return null;
					}
				$vars=$vars[$key];
		}
		else{
				if (!isset($vars[$keys])){
					self::addDebug('<div class="notice">Notice: trying to acces Undefined index <b>'.$keys.'</b> in controller: '.self::o()->vars['controller'].'</div>');
					 	return null;
					}
					$vars=$vars[$keys];}
		return $vars;
	}

static function view($key) {return self::get($key);}
static function show($key) {return self::get($key);}

static function destroy($var){
	unset(self::o()->vars[$key]);
	}

static function test($offset) {
        return isset(self::o()->vars[$offset]);
	}

}

?>
