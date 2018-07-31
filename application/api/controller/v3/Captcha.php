<?php
namespace app\api\controller\v3;
use think\Controller;
use think\captcha\Captcha;
class Captcha extends Controller{
	public function index($code=''){
		
		
		if(!captcha_check($code)){
			return '验证失败';
		}else{
			return '验证成功';
		}
		
	}
}