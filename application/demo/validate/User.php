<?php
namespace app\demo\validate;
use think\Validate;
class User extends Validate{
	//定义验证规则
	protected $rule=[
		'name'=>'require|max:25|token',
		'namedouble'=>'equalto:name',
		'age'=>'number|between:1,120',
		'email'=>'email',
		'zip'=>'regex:\d{6}',
	];
	//定义字段名称
	protected $field = [
		'name'  => '名称',
		'age'   => '年龄',
		'email' => '邮箱',	
	];
	protected $message=[
		'name.require'=>'名称必须',
		'name.max'=>'名称最多不能超过25个字符',
		'age.number'=>'年龄必须是数字',
		'age.between'=>'年龄只能在1-120之间',
		'email'=>'邮箱格式错误',
		'zip.regex'=>'zip必须为六位数字'
	];
	//定义验证场景，只验证场景里的内容,定义场景时可以对字段规则重新设置
	protected $scene=[
		'edit'=>['name','age'],
	];
	//自定义验证规则 $value表示验证字段的值，$rule表示验证规则里冒号后面的值 $data表示验证的数组数据 后面可以传入字段名和字段描述
	protected function equalto($value,$rule,$data){
		return $data[$rule]==$value?true:'两次输入不一样';
	}
}