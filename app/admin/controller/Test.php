<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-12-20
 * Time: 18:03
 */

namespace app\admin\controller;

use app\admin\controller\core\Base;

class Test extends Base
{
    //重写父类homePage()
    function homePage()
    {
        $this->setTitle("测试模块");
        $this->setPanelTitle("panel测试模块");
        $this->model = "test";
        $data = $this->getDataList($_GET);
        return view('home_page', $data);
    }
}