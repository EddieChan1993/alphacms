<?php
namespace app\admin\controller\core;

use app\admin\service\ComService;
use app\admin\service\core\LoginService;
use app\common\controller\BaseController;

/**
 * 登录
 */
class Login extends BaseController
{
    function __construct()
    {
        parent::_initialize();
        $comService = new ComService();
        if ($comService->isLogin()) {
            $this->redirect('admin/core.Index/index');
        }
    }

    function show_login()
    {
        return view('core/login/login_page');
    }

    //登陆判断
    function login_in()
    {
        $res = LoginService::loginIn($_POST);
        if (!$res) {
            $this->error(LoginService::getErr());
        }
        $this->success('身份认证成功,即将登陆', url('admin/core.Index/index'));
    }
}