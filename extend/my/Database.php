<?php
namespace my;
define('host','localhost');
define('databaseuser','root');
define('databasepassword','123456');
define('database','learn');
class Database{
	private static $_instance;
	private static $link;
	private function __construct(){
		self::$link=mysqli_connect(host,databaseuser,databasepassword);
	}
	public static function get_instance(){
		if(!isset(self::$_instance)){
			self::$_instance=new self();
		}
		return self::$_instance;
	}
	private function __clone(){
		trigger_error('Clone is not allow',E_USER_ERROR);
	}
	function seldb(){
		mysqli_set_charset(self::$link,'utf8');
		mysqli_select_db(self::$link,database);
	}
	public function getMessage($table){
		$this->seldb($table);
		$sql="select * from ".$table;
		$res=mysqli_query(self::$link,$sql);
		$rows=mysqli_fetch_assoc($res);
		return $rows;
	}
}