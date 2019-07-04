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

use think\facade\Route;
//设置允许跨域请求
Route::allowCrossDomain(true);

Route::group(':version/demo', function () {
    Route::get('/', 'api/:version.demo/index');
    Route::post('/save', 'api/:version.demo/save');
    Route::post('/update', 'api/:version.demo/update');
    Route::get('/login', 'api/:version.demo/login');
});
