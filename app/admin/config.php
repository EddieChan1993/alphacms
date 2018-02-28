<?php
//配置文件
return [
    'log'   => [
        //日志保存目录
        'path' =>  RUNTIME_PATH.'log'.DS.'backend'.DS,
    ],
    // 默认模块名,控制器
    'default_controller' => 'core.Index',    //权限配置

    'auth_config' => [
        'auth_on' => true,           // 认证开关
        'auth_type' => 1,            // 认证方式，1为实时认证；2为登录认证。
        'auth_group' => 'role',      // 角色表
        'auth_group_access' => 'role_user', // 用户-角色关系表
        'auth_rule' => 'menu',       // 权限规则表
        'auth_user' => 'users',  // 用户信息表
        'auth_open_id' => [1]        //不需要验证的管理员id
    ],

    //管理员默认首页菜单
    'controller'=>'core.admin',
    'action'=>'home_page',

    //自定义分页
    'my_page' => [
        'pages_nums' => 15,//分页按钮条数
        'list_nums' => 3,//每页显示条数
    ],
];