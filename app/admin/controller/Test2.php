<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-01-23
 * Time: 11:21
 */

namespace app\admin\controller;
use app\admin\controller\core\Base;

class Test2 extends Base
{
    public function _initialize()
    {
        $this->setTitle("测试模块2");
        $this->setTab1("列表");
        $this->setTab2("添加");
        $this->model = "test";
    }
}