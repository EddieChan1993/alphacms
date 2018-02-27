<?php
namespace app\common\controller;
use think\Config;
use think\Controller;
use think\Route;

class BaseController extends Controller
{
    protected function _initialize()
    {
        if (!is_installed() && Request()->module() != 'install') {
//            Config::set('default_module','install');
//            define('BIND_MODULE', 'install');
            $this->redirect("Install/Index/homePage");
            exit;
        }
    }
}