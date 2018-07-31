<?php
namespace app\test\controller;
use think\Controller;
use think\captcha\Captcha;
class Captcha extends Controller{
	public function index(){
		$this->assign('title','验证码测试');
		$this->view->replace([
			'__CSS__'=>'/static/captcha/css',
			'__JS__'=>'/static/captcha/js'
		]);
		return $this->fetch();
	}
	public function check($code=''){
		$captcha=new Captcha();
		if(!captcha_check($code)){
			$this->error('验证码错误');
		}else{
			$this->success('验证码正确');
		}
	}
	public function test(){
		$captcha=new Captcha();
		return $captcha->entry();
	}
}