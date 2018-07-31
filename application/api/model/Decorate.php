<?php
namespace app\api\model;
use think\Model;
class Decorate extends Model{
	  protected $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 服务器地址
        'hostname'    => '118.24.76.93',
        // 数据库名
        'database'    => 'demo',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => '123456',
        // 数据库连接端口
        'hostport'    => '',
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'think_',
        // 数据库调试模式
        'debug'       => true,
		// 时间字段取出后的默认时间格式
		'datetime_format' => 'Y-m-d H:i:s',
    ];
	protected $autoWriteTimestamp=true;
	
	protected function setRegionAttr($value){
		return implode('',$value);
	}
	protected function setHouseAttr($houses){
		$house=($houses[0]+1).'室'.($houses[1]+1).'厅'.($houses[2]+1).'厨'.($houses[3]+1).'卫'.($houses[4]+1).'阳台';
		return $house;
	}
}