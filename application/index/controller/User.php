<?php
namespace app\index\controller;
use app\index\model\Profile;
use app\index\model\User as UserModel;
class User
{
	public function add()
	{
		$user=new UserModel;
		$user->name='thinkphp';
		$user->password='123456';
		$user->nickname='六年';
		if($user->save()){
			$profile=new Profile;
			$profile->truename='刘晨';
			$profile->birthday='1977-03-05';
			$profile->address='中国上海';
			$profile->email="thinkphp@qq.com";
			$user->profile()->save($profile);
		return '用户['.$user->name.'}新增成功';
		}else{
			return $user->getError();
		}
	}
	public function read($id){
		$user=UserModel::get($id,'profile');
		echo $user->name. '<br/>';
		echo $user->nickname. '<br/>';
		echo $user->profile->truename. '<br/>';
		echo $user->profile->email. '<br/>';
	}
	public function update($id){
		$user=Usermodel::get($id);
		$user->name='framword';
		if($user->save()){
			$user->profile->email='liu34@163.com';
			$user->profile->save();
			return '用户[ ' . $user->name . ' ]更新成功';
		}else{
			return $user->getError();
		}
	}
	public function delete($id)
{
    $user = UserModel::get($id);
    if ($user->delete()) {
        // 删除关联数据
        $user->profile->delete();
        return '用户[ ' . $user->name . ' ]删除成功';
    } else {
        return $user->getError();
    }
}
	public function addBook(){
		$user=UserModel::get(11);
		$books=[
			['title'=>'语文','publish_time'=>'2016-05-06'],
			['title'=>'数学','publish_time'=>'2016-09-06'],
		];
		$user->books()->saveAll($books);
		return '添加成功';
	}
	public function readBooks()
{
    $user  = UserModel::get(11);

    // 获取作者写的某本书
    $book  = $user->books()->getByTitle('语文');
    dump($book);
}
	public function read1($id=''){
		$user=UserModel::get($id);
		dump($user->toArray());
	}
}