<?php
namespace app\demo\model;
use think\Model;
class User extends Model{
	protected $dateFormat='Y-m-d';
	protected $autoWriteTimestamp=true;
	protected $type=[
		'birthday'=>'timestamp',
	];
	/*
	protected $insert=['birthday'];
	protected function setBirthdayAttr($value,$data){
		return strtotime($data['birthday1']);
	}
	*/
}