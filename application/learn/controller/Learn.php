<?php
namespace app\learn\controller;
use think\Controller;
use my\Database;
class Learn extends Controller{
	public function index(){
		$test=Database::get_instance();
		$data=$test->getMessage('think_user');
		var_dump($data);
		
	}
}