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

Route::get('/', function () {
    return 'Hello,worlddd!';
});


Route::get('new', 'index/News/index'); // 定义GET请求路由规则

Route::get('product/arrStrFunction', 'index/Product/arrStrFunction'); // 定义GET请求路由规则
Route::resource('product', 'index/Product'); // 定义GET请求路由规则
Route::get('product/pai', 'index/Product/pai'); // 定义GET请求路由规则
Route::get('nsq/push', 'index/NsqPush/push'); // 定义GET请求路由规则
Route::post('new/:id', 'News/update'); // 定义POST请求路由规则
Route::put('new/:id', 'News/update'); // 定义PUT请求路由规则/
Route::delete('new/:id', 'News/delete'); // 定义DELETE请求路由规则
Route::any('new/:id', 'News/read'); // 所有请求都支持的路由规则
Route::get('redistest/push', 'index/RedisTest/push'); // 定义GET请求路由规则
Route::get('test/testFunciton','index/TestController/testFunciton');//测试面试接口
Route::post('test/upload','index/TestController/upload');//上传图片到本地


Route::get('contentFunction/array', 'index/ContentFunction/arrayFunction'); //内置函数测试
Route::get('contentFunction/string', 'index/ContentFunction/stringFunction'); //内置函数测试
Route::get('index/indexTe', 'index/Index/indexTe');//测试增删改查
Route::get('index/paixuPro', 'index/Index/paixuPro');//排序问题


return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
