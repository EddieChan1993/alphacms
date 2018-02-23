<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 后台应用入口文件 ]
// 定义应用目录
define('ROOT', __DIR__ . "/../");

define('APP_PATH', ROOT . 'app/');

define('UPLOAD_PATH', ROOT . 'upload/');

define('RUNTIME_PATH', ROOT . 'data/runtime/');

// 定义CMF 版本号
define('ALPHACMS_VERSION', '2.5');
//启动模块
define("MODULE", "admin");
// 加载框架引导文件
require ROOT . 'thinkphp/start.php';
