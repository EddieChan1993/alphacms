<?php
return [
    'app_debug' =>false,
    //异常页面,调试模式关闭的时候显示模板
    //路由找不到获取逻辑错误都会跳转到这个页面
    'exception_tmpl'         => ROOT_PATH.'public'.DS.'admin/alpha/pages-error-500.html',
    // 关闭URL中控制器和操作名的自动转换
    'url_convert'    =>  false,
    // 默认模块名,控制器
    'default_module' => 'admin',
    'default_controller' => 'core.Index',
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