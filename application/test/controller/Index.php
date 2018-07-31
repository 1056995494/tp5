<?php
namespace app\test\controller;
use think\Session;
use think\Request;
use think\Controller;
use think\Cookie;
class Index extends Controller
{
    public function index(Request $request)
    {
		$this->view->replace([
			'__CSS__'=>'/static/test/css',
			'__JS__'=>'/static/test/js'
		]);
		$this->assign('ses',session('user_name'));
		$this->assign('title','测试把标题');
		return $this->fetch();
    }
	public function read($name){
		Session::set('user_name',$name);
		$this->success('Session设置成功','index');
	}
	public function test(){
		//Cookie::set('user','大a头鱼a',20);
		dump( $this->request->cookie());
	}
}
