<?php
return [
    'app_debug' =>true,
    //异常页面,调试模式关闭的时候显示模板
    'exception_tmpl'         => ROOT_PATH.'public'.DS.'admin/alpha/404.html',
    // 关闭URL中控制器和操作名的自动转换
    'url_convert'    =>  false,
    // 默认模块名,控制器
    'default_module' => 'admin',
    'default_controller' => 'core.Index',

    //自定义日志文件
    'log_path'     => './data/runtime/log/',
    // 视图输出字符串内容替换
    'view_replace_str' => [
        '__ROOT__' => $basename,
        '__ADDONS__' => $basename . '/addons',

        '__PUBLIC__' => $basename . '/public',
        '__UPLOAD__' => $basename . '/data/upload',
        '__ADMIN__' => $basename . '/public/admin/alpha',
        '__HOME__' => $basename . '/public/home',

    ],
    //自定义分页
    'my_page' => [
        'pages_nums' => 15,//分页按钮条数
        'list_nums' =>20,//每页显示条数
    ],

    /*====================================*/
];