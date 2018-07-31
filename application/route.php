<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule(':version/user/:id','api/:version.User/read');
//Route::resource('blogs','index/blog');

return [

/*

    '__pattern__' => [
	
        'name' => '\w+',
    ],
    '[mytest]'     => [
		
        ':id'   => ['demo/index/mytest', ['method' => 'get'], ['id' => '\d+']],
		':name' => ['demo/index/mytest', ['method' => 'get']],
        
    ],
*/
	
	
	
];
