<?php
namespace my;
class Man{
	private static $_instance;
	private function __construct(){
		echo '我被实力会啊了';
	}
	public static function get_instance(){
		if(!isset(self::$_instance)){
			self::$_instance=new self();
		}
		return self::$_instance;
	}
	public function __clone(){
		trigger_error('Clone is not allow',E_USER_ERROR);
	}
	function test(){
		echo 'test';
	}
}