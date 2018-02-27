<?php
/**
 * Created by PhpStorm.
 * User: EVE
 * Date: 2018/1/15
 * Time: 23:51
 */

namespace app\home\controller\v1;

use app\home\controller\Base;
use app\home\service\OneService;

/**
 * 控制器中不要操作逻辑
 * 127.0.0.15/home/v1.one/change
 */
class One extends Base
{
    function __construct()
    {
        parent::__construct();
        //用户身份认证逻辑，调用服务
    }
    public function change()
    {
        $param = [123];
        $res = OneService::ChangeTest($param);
        if (!$res) {
            $this->warning(OneService::getErr());
        }
        $this->output("提交成功");
    }
}