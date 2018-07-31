<?php
namespace app\demo\controller;
use think\Controller;
use app\demo\model\User as UserModel;
use think\Db;
use think\Cookie;
class Index extends Controller{
	public function index(){
		return view();
	}
	public function add(){
		$user=new UserModel;
		$result=$this->validate(input('post.'),'User');
		if($result!==true){
			$this->error($result,'index');
		}
		$user->allowField(true)->save(input('post.'));
		$this->success($user->nickname.'新增成功','index');
		
	}
	public function read(){
		$user=UserModel::all();
		return view('read',['user'=>$list]);
		
	}
	//我定义的分页
	public function index1($page=1){
		$count=count(UserModel::all());
		$pages=ceil($count/5);
		$cpage=($page-1)*5;
		$list=Db::name('user')->limit($cpage.',5')->select();
		if($page>1){
		$pre=$page-1;
		}else{
			$pre=1;
		}
		if($page<$pages){
			$next=$page+1;
		}else{
			$next=$pages;
		}
		$this->assign('pre',$pre);
		$this->assign('next',$next);
		$this->assign('pages',$pages);
		$this->assign('list',$list);
		$this->assign('count',count($list));
		$this->assign('title','标题');
		return $this->fetch('index/index1');
	}
	//课程里的分页
	public function index2(){
		$list=UserModel::paginate(5,false,['query' => ['keyword'=>'123'] ]);
		$this->assign('list',$list);
		$this->assign('title','标题');
		$this->assign('page', $list->render());
		//$this->view->engine->layout(false);
		return $this->fetch();
	}
	public function add1(){
		$user=new UserModel;
		$user->nickname='西瓜';
		$user->birthday='1990-12-07';
		$user->password='8899332';
		$user->save();
	}
	public function test(){
		Cookie::set('name','thinkphp',3600);
		return Cookie::get('name');
	}
}