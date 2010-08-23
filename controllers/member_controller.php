<?php
class memberController extends Controller{
	static function index($das){
	self::set('title','eto budet kakojta tam titul ot MEMBEROV');
	//print_r(Registry::get('request'));
	}
	
	static function _new($das){
	self::set('title','Create new User', true);
	}

	static function create($das){
	self::set('title','CREATED', true);
	self::setflash('<div>USER CREATED</div>');//flash[:success] = "Welcome to the Sample App!"
	self::render('index');//redirect_to @user
	
	//call model function/procedure
	//meber::test1();
	}
}

?>


