<?php
// [ 后台应用入口文件 ]
// 定义应用目录
define('ROOT', __DIR__ . "/../");

define('APP_PATH', ROOT . 'app/');

define('UPLOAD_PATH', ROOT . 'upload/');

define('RUNTIME_PATH', ROOT . 'data/runtime/');

//启动模块
define("MODULE", "home");

// 加载框架引导文件
require ROOT . 'thinkphp/start.php';
