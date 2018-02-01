<?php
namespace app\common\controller;
use think\Controller;

class BaseController extends Controller
{
    function __construct()
    {
        if (!is_installed() && Request()->module() != 'install') {
            $this->redirect("install/Index/homePage");
            exit;
        }
    }
}