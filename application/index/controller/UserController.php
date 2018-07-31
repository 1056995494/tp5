<?php
namespace app\index\controller;
use app\index\model\User;
use think\Controller;
/*
创建think_user数据表
CREATE TABLE IF NOT EXISTS `think_user`(
    `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `nickname` varchar(50) NOT NULL COMMENT '昵称',
    `email` varchar(255) NULL DEFAULT NULL COMMENT '邮箱',
    `birthday` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '生日',
    `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
    `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',    
    `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',    
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
*/


//单个新增 create函数可以直接传入数组参数，可以传入表单提交数据
class UserController extends Controller{
	public function add(){
		$user['nickname']='成龙';
		$user['email']='1056@qq.com';
		//在User模型增加修改器后,可以实现存入时自动转换
		//$user['birthday']=strtotime('2015-04-02');
		$user['birthday']='2015-04-02';
		if($result=User::create($user)){
			return '用户['.$result->nickname.':'.$result->id.']新增成功';
		}else{
			return 新增出错;
		}
	}
	public function add2(){
		var_dump(input('post.'));
		if($user=User::create(input('post.'))){
			return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		}else{
			return $user->getError();
		}
	}
	public function add3(){
		$user=new User;
		if($user->allowField(true)->validate(true)->save(input('post.'))){
			return '用户【'.$user->nickname.':'.$user->id.'】新增成功';
		}else{
			return $user->getError();
		}
	}
	//可以逐项增加参数
	public function add1(){
		$user=new User;
		$user->nickname='张三';
		$user->email='7788@qq.com';
		$user->birthday=strtotime('2000-12-07');
		if($user->save()){
			return '用户['.$user->nickname.':'.$user->id.']新增成功';
		}else{
			return $user->getError();
		}
	}
	//update数据
	public function update1(){
		$user=new User;
		$user->nickname='张三2';
		$user->email='7788@qq.com';
		$user->birthday=strtotime('2000-12-07');
		if($user->isUpdate('where','id=29')->save()){   //设置where可以批量更新
			return '用户['.$user->nickname.':'.$user->email.']更新成功';  //此处不存在主键id属性$user->id
		}else{
			return $user->getError();
		}
	}
	//批量新增
	public function addlist(){
		$user=new User;
		$list=[
			['nickname'=>'张三','email'=>'zhanghsa@qq.com','birthday'=>strtotime('1990-12-07')],
			['nickname'=>'李四','email'=>'zhanghsfffa@qq.com','birthday'=>strtotime('1991-12-07')]
		];
		if($user->saveAll($list)){
			return '用户批量增加成功';
		}else{
			return $user->getError();
		}
	}
	//下面为主键查询
	public function read($id=''){
		$user=User::get($id);
		echo $user->nickname.'<br/>';
		echo $user->email.'<br/>';
		echo $user->birthday.'<br/>';
		echo $user->create_time.'<br/>';
	}
	//修改读取器，定义数据表中不存在的属性
	public function reads($id=''){
		$user=User::get($id);
		echo $user->nickname.'<br/>';
		echo $user->email.'<br/>';
		echo $user->birthday.'<br/>';
		echo $user->user_bir1thday.'<br/>';
		echo $user->user_email.'<br/>';
	}
	
	//也可以当成数列
	public function read1($id=''){
		$user=User::get($id);
		echo $user['nickname'].'<br/>';
		echo $user['email'].'<br>';
		echo date('Y/m/d',$user['birthday']).'<br>';
	}
	//通过其他数据来查询
	public function read2(){
		$user=User::getByEmail('1056@qq.com');
		echo $user['nickname'].'<br/>';
		echo $user['email'].'<br>';
		echo date('Y/m/d',$user['birthday']).'<br>';
	}
	//不用主键的话，可以通过传入数组作为查询条件
	public function read3(){
		$user=User::get(['nickname'=>'宋涛','email'=>'1thinkphp@qq.com']);
		echo $user['nickname'].'<br/>';
		echo $user['email'].'<br>';
		echo date('Y/m/d',$user['birthday']).'<br>';
	}
	//更复杂的函数可以用闭包函数查询构建器完成
	public function read4(){
		$user=User::get(function($query){
			$query->where('nickname','宋涛')->where('id>11')->order('id','desc');
		});
		echo $user['nickname'].'<br/>';
		echo $user['email'].'<br>';
		echo date('Y/m/d',$user['birthday']).'<br>';
	}
	//查询多个数据，使用模型的all方法
	public function readlist(){
		$list=User::all();
			foreach($list as $key=>$user){
				/*
				echo $user->nickname.'<br>';
				echo $user->email.'<br/>';
				echo date('Y/m/d',$user->birthday).'<br/>';
				echo '----------------------<br>';
				*/
				$res[$user->id]['nickname']=$user->nickname;
				$res[$user->id]['email']=$user->email;
				$res[$user->id]['birthday']=$user->birthday;
			}
			var_dump($res);
	}
	//不是使用主键查询的话，可以直接传入数组条件
	public function readlist1(){
		$list=User::all(['status'=>0]);
			foreach($list as $key=>$user){
				/*
				echo $user->nickname.'<br>';
				echo $user->email.'<br/>';
				echo date('Y/m/d',$user->birthday).'<br/>';
				echo '----------------------<br>';
				*/
				$res[$user->id]['nickname']=$user->nickname;
				$res[$user->id]['email']=$user->email;
				$res[$user->id]['birthday']=$user->birthday;
			}
			if(isset($res)){
			var_dump($res);
			}
	}
	//或者使用闭包函数增加查询条件
	public function readlist2(){
		$list=User::all(function($query){
			$query->where('id','<',15)->order('id','desc');
		});
		foreach($list as $key=>$user){
				/*
				echo $user->nickname.'<br>';
				echo $user->email.'<br/>';
				echo date('Y/m/d',$user->birthday).'<br/>';
				echo '----------------------<br>';
				*/
				$res[$user->id]['nickname']=$user->nickname;
				$res[$user->id]['email']=$user->email;
				$res[$user->id]['birthday']=$user->birthday;
			}
			if(isset($res)){
			var_dump($res);
			}
	}
	//可以对查询出来的数据进行更新操作
	public function update2($id){
		$user=User::get($id);
		$user->nickname='刘子成';
		$user->email='105699@qq.com';
		$user->save();
		return '更新成功';
	}
	//批量更新
	public function updatelist(){
		$list=User::all();
			foreach($list as $key=>$user){
				/*
				echo $user->nickname.'<br>';
				echo $user->email.'<br/>';
				echo date('Y/m/d',$user->birthday).'<br/>';
				echo '----------------------<br>';
				*/
				$user->status+=1;
				$user->save();
			}
			return '更新成功';
	}
	//删除数据使用delete()方法,等同于destroy()
	public function delete($id){
			$user=User::get($id);
			if($user){
				$user->delete();
				return '删除用户成功';
			}else{
				return '删除的用户不存在';
			}
		
	}
	public function create(){
		return view();
	}
}