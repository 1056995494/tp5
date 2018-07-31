<?php
namespace app\api\model;

use think\Model;

class Book extends Model{
	protected $autoWriteTimestamp=true;
	protected $type=[
		'publish_time'=>'timestamp:Y-m-d',
	];
}