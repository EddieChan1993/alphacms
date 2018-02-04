<?php
namespace app\install\controller;

use app\install\service\InstallService;
use Qiniu\Http\Request;
use think\Controller;
use think\Exception;

/**
 * 安装页面
 */
class Index extends Controller
{
    function _initialize()
    {
        if (is_installed()) {
            $this->redirect(request()->domain());
            exit;
        }
    }

    //安装页面
    public function homePage()
    {
        return view('install');
    }

    //安装逻辑
    public function install()
    {
        try {
            $res = InstallService::importDbData($_POST);
            if (!$res) {
                throw new Exception(InstallService::getErr());
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success("alphaCMS,安装成功");
    }
}