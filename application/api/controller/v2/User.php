<?php
namespace app\api\controller\v2;

use app\api\model\User as UserModel;

class User
{
	public function read($id=0)
	{
		try{
		$user=UserModel::get($id,'profile');
		if($user){
			return json($user);
		}else{
			//return json(['error'=>'用户不存在'],404);
			abort(404,'用户不存在');
		}
		}catch(\Exception $e){
			return abort(404,$e->getMessage());
		}
	}
	public function addbook(){
		$list=UserModel::all();
		foreach($list as $user){
			$books=[
				['title'=>'英语','publish_time'=>'2015-12-07'],
				['title'=>'数学','publish_time'=>'2016-12-07'],
			];
			$user->books()->saveAll($books);
		}
		return '批量新增成功';
	}
	public function readbook($id){
		$user=UserModel::get($id);
		$books=$user->books()->where('title="英语"')->select();
		return json($books);
	}
	public function add(){
		$user=new UserModel;
		$user->nickname='小明';
		$user->password='123456';
		if($user->save()){
			$profile['truename']='大明';
			$profile['birthday']='1990-12-07';
			$profile['address']='华盛顿';
			$profile['email']='1059@qq.com';
			$user->profile()->save($profile);
			return $user->nickname.'新增成功';
		}else{
			return $user->getError();
		}
	}
}