<?php
namespace app\index\model;
use think\Model;
class Profile extends Model
{
	protected $type=[
		'birthday'=>'timestamp:Y-m-d',
	];
	//可以看到Profile模型中并没有定义关联方法。如果你的关联操作都是基于User模型的话，Profile模型中并不需要定义关联方法。

//如果你需要基于Profile模型来进行关联操作，则需要在Profile模型中定义对应的BELONGS_TO关联，
	public function user()
	{
		//档案BELONGS To关联用户
		return $this->belongsTo('User');
	}
}