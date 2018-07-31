<?php
namespace app\api\model;

use think\Model;

class User extends Model
{
	public function books(){
		return $this->hasMany('Book');
	}
	public function profile()
	{
		return $this->hasOne('Profile');
	}
}