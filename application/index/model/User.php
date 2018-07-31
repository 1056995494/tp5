<?php
namespace app\index\model;
use think\Model;
class User extends Model{
	//读取器，定义数据表中不存的属性，驼峰命名
	/*
	protected function getUserBir1thdayAttr($value,$data)
	{
		return date('Y-m-d',$data['birthday']);
	}
	protected function getUserEmailAttr($value,$data)
	{
		return strtoupper($data['email']);
	}
	*/
	/*定义表中存在的属性，驼峰命名
	protected function getBirthdayAttr($birthday)
	{
		return data('Y-m-d',$birthday);
	}
	*/
	//birthday修改器,驼峰命名
	/*
	protected function setBirthdayAttr($value){
		return strtotime($value);
	}
	*/
	//protected $dateFormat='Y-m-d H:i:s';
	//设置自动写入读取时间戳
	/*protected $type=[
		'birthday'=>'timestamp',
	];
	*/
	//field定义数据库接收的数据属性
	//protected $field=['nickname','email','birthday'];
	//$insert设置自动写入
	protected $insert=['status'=>1];
	/* update_times更新时自动完成+1操作
	protected $update=['update_times'];
	protected function setUpdateTimesAttr($value,$data){
		return $data['update_times']+1;
	}
	*/
	protected $autoWriteTimestamp=true;
	public function profile(){
		return $this->hasOne('profile');
	}
	public function books(){
		return $this->hasMany('Book');
	}
}