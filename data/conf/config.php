<?php

return [
    'app_debug' => true,
    //异常页面,调试模式关闭的时候显示模板
    //路由找不到获取逻辑错误都会跳转到这个页面
    'exception_tmpl' => ROOT_PATH . 'public' . DS . 'admin/alpha/pages-error-500.html',
    // 关闭URL中控制器和操作名的自动转换
    'url_convert' => false,
    // 默认模块名,控制器
    'default_module' =>MODULE,
    // 视图输出字符串内容替换
    'view_replace_str' => [
        '__ROOT__' => $basename,
        '__PUBLIC__' => $basename ,
        '__UPLOAD__' => $basename . '/upload',
        '__ADMIN__' => $basename . '/admin/alpha',
    ],
    /*====================================*/
];