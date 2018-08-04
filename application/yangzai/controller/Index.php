<?php
namespace app\yangzai\controller;
use app\api\model\Decoration;
use think\Controller;
class Index extends Controller
{
	public function index($page=1)
	{
		$count=Decorate::count();
		$p=15;
		$ps=ceil($count/$p);
		$fpage=($page-1)*$p;
		$list=Decorate::limit($page.','.$p)->order('id','desc')->select();
		if($page<$ps)
		{
			$next=$page+1;
		}else{
			$next=$ps;
		}
		if($page>1){
			$pre=$page-1;
		}else{
			$pre=1;
		}
		$this->assign('ps',$ps);
		$this->assign('count',$count);
		$this->assign('pre',$pre);
		$this->assign('next',$next);
		$this->assign('list',$list);
		$this->assign('title','装修计算器后台数据');
		$this->view->replace([
			"__ROOT__"  =>  '/static/decorate/css',
			"__JS__" => '/static/decorate/js',
		]);
		return $this->fetch();
	}
}