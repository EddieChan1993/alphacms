<?php
namespace app\admin\controller\core;

use app\admin\service\core\AuthService;

class Index extends Base
{
    public function index()
    {
        $self = get_users(open_secret(cookie('UID')));
        $role_name = get_role(open_secret(cookie('UID')));
        $role_nav = get_role_nav(open_secret(cookie('UID')));

        $menuAuth = new AuthService();
        $menuAuth=$menuAuth->get_auth_menu(open_secret(cookie('UID')));
        $menuAuth = my_sort($menuAuth, 'listorder', SORT_DESC);

        $menu=get_menu(end($role_nav));
        $url = $menu['module'] . '/' . $menu['controller'] . '/' . $menu['method'];
        $map = [
            'self'=>$self,//登录信息
            'role_name'=>$role_name,
            'menuAuth'=>$menuAuth,//权限菜单
            'url'=>url($url),//默认跳转地址
        ];

        return view('Public/base',$map);
    }

    function two()
    {
        return view('two');
    }

    //退出登陆
    function login_out()
    {
        cookie('UID', null);
        session('SUID', null);
        session('TOKEN_LOGIN', null);
        $this->redirect(url('admin/core.Login/show_login'));
    }

    //php扩展检测
    function get_php_ext()
    {
        if (!extension_loaded('redis')) {
            $this->error('Redis扩展未安装');
        }else{
            $this->success('欢迎使用alphaCMS');
        }
    }
}
