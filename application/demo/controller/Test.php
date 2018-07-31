<?php
namespace app\demo\controller;
use think\Controller;
use think\Validate;
class Test extends Controller{
	public function index(){
		$this->assign('title','测试');
		return $this->fetch();
		
	}
	public function test(){
		$validate=validate('User');
		$validate->check(input());
		$error=$validate->getError();
		var_dump($error);
		$this->error($error.'请刷新页面重试','index');
	}
}